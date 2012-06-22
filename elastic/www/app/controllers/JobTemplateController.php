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

class JobTemplateController extends Controller
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
      array('allow', // admins only
        'actions' => array('index', 'view', 'create', 'update',
          'admin', 'delete', 'immediateLoad'),
        'users' => array('admin'),
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
		$model=new JobTemplate;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['JobTemplate']))
		{
			$model->attributes=$_POST['JobTemplate'];
			if($model->save()) {
        if ($model->job_template_schedule == 'now') {
          $this->redirect(array('immediateLoad', 'id'=>$model->job_template_id));
        } else {
          $this->redirect(array('view','id'=>$model->job_template_id));
        }
      }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

  /**
   * Loads a template into a new job and launches a slave if needed.
   * @parameter integer $id - ID of template to load into jobs queue
   */
  public function actionImmediateLoad($id) {
    $job = new Job;
    $job->slave_server_id_lock = null;
    $job->job_start_time = null;
    $job->job_status = 'unassigned';
    $job->job_template_id = $id;
    $job->job_kettle_id = null;
    if (!$job->save()) {
      echo 'Could not load job: ' . $job->errors;
    } else if (Slaves::model()->count() < 1) {
      $this->redirect(array('/slaves/launchSingle', 'jobId' => $job->job_id));
    } else {
      $this->redirect(array('/job/view', 'id' => $job->job_id));
    }
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

		if(isset($_POST['JobTemplate']))
		{
			$model->attributes=$_POST['JobTemplate'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->job_template_id));
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
		$dataProvider=new CActiveDataProvider('JobTemplate');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new JobTemplate('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['JobTemplate']))
			$model->attributes=$_GET['JobTemplate'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=JobTemplate::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='job-template-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
