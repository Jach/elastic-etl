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

class JobSummaryController extends Controller
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
                            'actions' => array('index', 'job', 'client', 'details', 'view'),
                            'users' => array('admin')
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
            $jobDetails = Yii::app()->db->createCommand()
                                ->select('s.JOB_ID AS job_id,
                                           s.sf_username AS sf_username,
                                           s.job_name AS job_name,
                                           s.job_type AS job_type,
                                           s.job_status AS job_status,
                                           l.STATUS AS job_status_2,
                                           l.REPLAYDATE AS job_start,
                                           l.ENDDATE AS job_end,
                                           l.LOG_FIELD AS job_log')
                                ->from('job_summary s')
                                ->join('job_log l', 's.JOB_ID = l.ID_JOB')
                                ->where(array('and','s.JOB_ID = '.$id))                                
                                ->queryRow();
            
            $transDetails = Yii::app()->db->createCommand()
                                ->select('trans_summary.JOB_ID AS job_id,
                                            trans_summary.ID_BATCH AS trans_id,
                                            trans_summary.trans_name,
                                            trans_summary.sf_username,
                                            trans_summary.source,
                                            trans_summary.target,
                                            trans_log.STATUS,
                                            trans_log.LINES_INPUT,
                                            trans_log.LINES_OUTPUT,
                                            trans_log.LINES_REJECTED,
                                            trans_log.REPLAYDATE AS STARTDATE,
                                            trans_log.ENDDATE,
                                            trans_log.LOG_FIELD')
                                ->from('trans_summary trans_summary')
                                ->join('trans_log trans_log', 'trans_summary.ID_BATCH = trans_log.ID_BATCH')
                                ->where(array('and','trans_summary.JOB_ID = '.$id))
                                ->order('trans_log.REPLAYDATE ASC')
                                ->queryAll();
            
            
            $this->render('view',array(
			'jobDetails'=>$jobDetails,
                        'transDetails'=>$transDetails,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new JobSummary;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['JobSummary']))
		{
			$model->attributes=$_POST['JobSummary'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->JOB_ID));
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
            $model=JobSummary::model()->findByPk($id);

            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='job-summary-edit-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            */

            if(isset($_POST['JobSummary']))
            {
                $model->attributes=$_POST['JobSummary'];
                if($model->validate())
                {
                    // form inputs are valid, do something here
                    return;
                }
            }
            $this->render('edit',array('model'=>$model));
	}

	

	/**
	 * Lists all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('JobSummary');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
            $start_time = Yii::app()->request->getParam('start_time',  date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")) ));
            $end_time =  Yii::app()->request->getParam('end_time',  date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")) ));
            
            
            //$model = new LoginForm;
           /* $form = new CForm('application.views.jobSummary.jobSummaryDateForm', null, null);
            if($form->submitted('filter') && $form->validate())
            {
                $start_time = $form->start_time;               
                $end_time = $form->end_time;
            }   */         
            
            $data = Yii::app()->db->createCommand()
                                ->select('s.JOB_ID AS job_id,
                                           s.sf_username AS sf_username,
                                           s.job_name AS job_name,
                                           s.job_type AS job_type,
                                           s.job_status AS job_status,
                                           l.STATUS AS job_status_2,
                                           l.REPLAYDATE AS job_start,
                                           l.ENDDATE AS job_end,
                                           l.LOG_FIELD AS job_log,
                                           COUNT(s.JOB_ID) AS count')
                                ->from('job_summary s')
                                ->join('job_log l', 's.JOB_ID = l.ID_JOB')
                                ->where(array('and', 'l.REPLAYDATE > "'.$start_time.'"', 'l.REPLAYDATE < "'.$end_time.'"'))
                                ->group('s.sf_username, job_type, s.job_status')
                                ->order('s.sf_username ASC, job_type ASC, s.job_status ASC')
                                ->queryAll();
            
            $by_clients = array();
            $by_jobs_types = array();
            foreach($data as $k => $v)
            {
                $by_clients[$v['sf_username']][$v['job_type']][] = array('status'=>$v['job_status'], 'count'=>$v['count']);
                if (empty($by_jobs_types[$v['job_type']][$v['job_status']])){
                    $by_jobs_types[$v['job_type']][$v['job_status']] = 0;
                }
                $by_jobs_types[$v['job_type']][$v['job_status']] += $v['count'];
            }
                        
		$this->render('index',array(
			'by_clients'=>$by_clients,
                        'by_jobs_types'=>$by_jobs_types,
                        'form'=> $form,
                        'start_time'=>$start_time,
                        'end_time'=>$end_time
		));
	}
        
        
        /**
	 * Manages all models.
	 */
	public function actionDetails()
	{
		$model=new JobSummary('search');
		$model->unsetAttributes();  // clear any default values
                $model->getDbCriteria()->order = 'start_time DESC';
                
                
                
		if(isset($_GET['JobSummary']))
			$model->attributes=$_GET['JobSummary'];
                
                /*$model->attributes['pagination'] = array(
                    'pageSize' =>50,
                );*/

		$this->render('details',array(
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
		$model=JobSummary::model()->findByPk($id);
                
                
                
                
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='job-summary-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
