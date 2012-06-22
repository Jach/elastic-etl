<?php
/*
   Copyright 2012 DynamoBI

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
 */

class SlavesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
    return array(
      array('allow', // only allow admins for everything
        'actions' => array('index', 'view', 'create', 'update',
          'admin', 'delete', 'launchSingle'),
        'users' => array('admin'),
      ),
      array('allow', // cron actions guarded by other auth
        'actions' => array('launchSlaves', 'watchdog'), 'users' => array('*')
      ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Slaves;
    $model->slave_startup_time = date('Y-m-d H:i:s');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Slaves']))
		{
			$model->attributes=$_POST['Slaves'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->slave_server_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Slaves']))
		{
			$model->attributes=$_POST['Slaves'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->slave_server_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

      $bad_jobs = Job::model()->findAll('job_status = :status AND slave_server_id_lock = :slave', array(':status' => 'running', ':slave' => $id));
      foreach ($bad_jobs as $job) {
        $job->job_status = 'error';
        $job->save();
      }

      // Try to delete from cloud too.
      $ws = new AmazonWS();
      if ($ws->deleteSlaveServers($id)) {
        Yii::log("Shut down slave: $id by manual deletion.",
          'info', 'controllers.SlavesController');
      }

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Slaves');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Slaves('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Slaves']))
			$model->attributes=$_GET['Slaves'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

  /**
   * Manually launch a single daily-type slave.
   */
  public function actionLaunchSingle($jobId=-1) {
    $ws = new AmazonWS();
    $response = $ws->createSlaveServers();
    if ($response != NULL) {
      list($slave_name) = $response;
      Yii::log("$slave_name created manually.", 'info', 'controllers.SlavesController');

      $slave = new Slaves();
      $slave->slave_server_id = $slave_name;
      $slave->slave_startup_time = new CDbExpression('NOW()');
      // Slave should update this and carte url when it comes online.
      $slave->slave_status = 'starting';

      if (!$slave->save()) {
        $msg = "Could not save created slave $slave_name: " . $slave->errors;
        echo $msg;
        Yii::log($msg, 'error', 'controllers.SlavesController');
      } else if ($jobId == -1) { // look at launched slave
        $this->redirect(array('view','id'=>$slave_name));
      } else { // look at launched job that invoked a slave
        $this->redirect(array('/job/view', 'id'=>$jobId));
      }
    } else {
      $msg = 'Could not launch slave:<br /> ' . printa($ws->ec2_response, 1);
      echo $msg;
      Yii::log($msg, 'error', 'controllers.SlavesController');
    }
  }

  /**
   * Launches slave servers with default params defined in the DB.
   */
  public function actionLaunchSlaves($auth) {
    header('Content-type: application/json');
    if ($auth != Yii::app()->params['actionAuth']) {
      echo CJSON::encode(array('results' => 'Invalid authorization.'));
      Yii::log('Invalid authorization.', 'warning', 'controllers.SlavesController');
      return;
    }

    $num = (int)MasterConfig::model()->param('NUM_SLAVES_TO_START_DAILY');
    // Start number of slaves minus slaves started less than a day ago.
    // (Prevents launching of endless slaves accidentally.)
    $existing_slaves = Slaves::model()->count(
      'now() < date_add(slave_startup_time, interval 1 day)');
    $num -= $existing_slaves;

    $ws = new AmazonWS();
    $response = $ws->createSlaveServers($num);

    if ($response != NULL) {
      foreach ($response as $instance) {
        $slave = new Slaves();
        $slave->slave_server_id = $instance;
        $slave->slave_startup_time = new CDbExpression('NOW()');
        // Slave should update this and carte url when it comes online.
        $slave->slave_status = 'starting';

        if(!$slave->save()) {
          $msg = "Could not save created slave $instance: " . $slave->errors;
          echo $msg . '<br />';
          Yii::log($msg, 'error', 'controllers.SlavesController');
        }
      }
    }
  }

  private function relaunchFailedJobs() {
    // Get a list of failed jobs that aren't at their retry limit:
    $q = <<<EOD
SELECT job_id, job_status, job_retry_attempt AS attempt,
  job.job_template_id,
  job_template.job_template_retry_delay AS delay,
  job_template.job_template_max_retries
FROM (SELECT MAX(job_id) AS id FROM job GROUP BY job_template_id) AS j
INNER JOIN job ON job.job_id = j.id
INNER JOIN job_template ON job.job_template_id = job_template.job_template_id
WHERE job_status='error' AND job_retry_attempt < job_template_max_retries
EOD;
    $command = Yii::app()->db->createCommand($q);
    $results = $command->queryAll();
    foreach ($results as $result) {
      // Copy them:
      $newjob = new Job;
      // Round-about way of adding time:
      $delay = getdate(strtotime($result['delay']));
      $start = time() + ($delay['hours']*60 + $delay['minutes']*60 + $delay['seconds']*60);

      $newjob->job_start_time = date('Y-m-d H:i:s', $start);
      $newjob->job_status = 'retry';
      $newjob->job_retry_attempt = (int)$result['attempt'] + 1;
      $newjob->job_prior_failed_job_id = $result['job_id'];
      $newjob->job_template_id = $result['job_template_id'];

      $newjob->save();
    }

    // Get a list of jobs marked for retry that are now scheduled to activate:
    $jobs = Job::model()->findAll('job_status = :status AND job_start_time < :time',
      array(':status' => 'retry', ':time' => date('Y-m-d H:i:s')));
    foreach ($jobs as $job) {
      $job->job_status = 'unassigned';
      $job->save();
    }
  }

  /**
   * Performs a series of monitoring tasks related to slave servers and jobs.
   * We check for failed jobs to relaunch, as well as dead or finished
   * servers to remove if there are no tasks left.
   */
  public function actionWatchdog($auth) {
    header('Content-type: application/json');
    if ($auth != Yii::app()->params['actionAuth']) {
      echo CJSON::encode(array('results' => 'Invalid authorization.'));
      return;
    }

    $this->relaunchFailedJobs();

    $ws = new AmazonWS();

    $slave_names_to_shutdown = array();

    $all_jobs = Job::model()->count();
    $all_finished_jobs = Job::model()->count("job_status IN ('success', 'error')");

    $slaves = Slaves::model()->findAll();
    foreach ($slaves as $slave) {
      // shut all slaves down or shut down any slaves that have been started
      // but haven't given us a carte url within 30 minutes.
      if ($all_jobs == 0 || $all_jobs == $all_finished_jobs ||
         ($slave->slave_carte_url == NULL &&
         strtotime($slave->slave_startup_time) + 30*60 <= time()))
      {
        $slave_names_to_shutdown[] = $slave->slave_server_id;
        Yii::log("Preparing to shut down slave: {$slave->slave_server_id} " .
          "for reason(s): jobs left=$all_jobs matches all finished jobs=$all_finished_jobs?, null carte and startup took 30 mins(true/false)=" .
          ($slave->slave_carte_url == NULL &&
          strtotime($slave->slave_startup_time) + 30*60 <= time()),
            'info', 'controllers.SlavesController');
        continue;
      }
      // Also shut down those with unresponsive carte urls.
      if ($slave->slave_carte_url != NULL) {
        $xml = KettleApi::kettleStatus($slave->slave_carte_url);
        if ($xml == NULL) {
          // try once more just in case of network fluke:
          sleep(2);
          if (NULL == KettleApi::kettleStatus($slave->slave_carte_url))
            $slave_names_to_shutdown[] = $slave->slave_server_id;
          Yii::log("Preparing to shut down slave: {$slave->slave_server_id} " .
                   'for reason of unresponsive carte url.',
            'info', 'controllers.SlavesController');
        }
      }
    }

    if (empty($slave_names_to_shutdown))
      return;

    $okay = $ws->deleteSlaveServers($slave_names_to_shutdown);
    if ($okay) {
      // Remove from the model, also mark any jobs that are running under
      // this slave name as failed.
      foreach ($slave_names_to_shutdown as $slv_name) {
        $slv = Slaves::model()->deleteByPk($slv_name);
        $bad_jobs = Job::model()->findAll('job_status = :status AND slave_server_id_lock = :slave', array(':status' => 'running', ':slave' => $slv_name));
        foreach ($bad_jobs as $job) {
          $job->job_status = 'error';
          $job->save();
        }
      }
      Yii::log('Slaves deleted: ' . print_r($slave_names_to_shutdown, 1),
        'info', 'controllers.SlavesController');
    } else {
      $msg = 'Could not delete:<br /> ' . printa($ws->ec2_response, 1);
      echo $msg;
      Yii::log($msg, 'error', 'controllers.SlavesController');
    }
  }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Slaves::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='slaves-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
