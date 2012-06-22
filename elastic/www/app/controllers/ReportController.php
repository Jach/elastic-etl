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

class ReportController extends Controller
{
    
        public $layout='//layouts/column2';
        
	public function actionClient()
	{
		$this->render('client');
	}

	public function actionIndex()
	{
	/*	
            $dataProvider=new CActiveDataProvider('JobSummary');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
*/
            //$model=new JobSummary('search');
            //$model->unsetAttributes();  // clear any default values
		/*if(isset($_GET['MasterConfig']))
			$model->attributes=$_GET['MasterConfig'];*/
            
            $sort = new CSort();
            $sort->attributes = array(
                'start_time' => array(
                    'asc' => 'start_time',
                    'desc' => 'start_time desc',
                ),
                'end_time' => array(
                    'asc' => 'end_time',
                    'desc' => 'end_time desc',
                ),                
            );
            
            
            $dataProvider = new CActiveDataProvider('JobSummary', array(
                'criteria' => array(
                    //'with' => array('job_name', 'sf_username', 'job_type', 'job_status', 'start_time', 'end_time'),
                    'order'=>'start_time DESC',
                ),                
                'sort'=>$sort,                
                'pagination' => array(
                    'pageSize' => 30,
                ),
            ));            

            $this->render('index',array(
                    'dataProvider' => $dataProvider,
            ));
	}

	public function actionJob()
	{
		$this->render('job');
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
        'actions' => array('index', 'job', 'client', 'update', 'view'),
        'users' => array('admin')
      ),
      /*
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
      ),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
