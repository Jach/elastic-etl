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

/**
 * This is the model class for table "job_summary".
 *
 * The followings are the available columns in table 'job_summary':
 * @property integer $JOB_ID
 * @property string $job_name
 * @property string $sf_username
 * @property string $job_type
 * @property string $job_status
 * @property string $start_time
 * @property string $end_time
 */
class JobSummary extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return JobSummary the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'job_summary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('JOB_ID, job_name, sf_username, job_type, start_time', 'required'),
			array('JOB_ID', 'numerical', 'integerOnly'=>true),
			array('job_name, job_type, job_status', 'length', 'max'=>255),
			array('sf_username', 'length', 'max'=>100),
			array('end_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('JOB_ID, job_name, sf_username, job_type, job_status, start_time, end_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    //'job_log' => array(self::BELONGS_TO, 'Organization', 'org_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'JOB_ID' => 'Job',
			'job_name' => 'Job Name',
			'sf_username' => 'Sf Username',
			'job_type' => 'Job Type',
			'job_status' => 'Job Status',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('JOB_ID',$this->JOB_ID);
		$criteria->compare('job_name',$this->job_name,true);
		$criteria->compare('sf_username',$this->sf_username,true);
		$criteria->compare('job_type',$this->job_type,true);
		$criteria->compare('job_status',$this->job_status,true);
		$criteria->compare('start_time','>='.$this->start_time,true);
		$criteria->compare('end_time','<='.$this->end_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function getJobTypes() 
        {
             $jobNames = Yii::app()->db->createCommand()
                        ->selectDistinct('job_name')
                        ->from($this->tableName())
                        ->order('job_name ASC')
                        ->queryAll();
             $rez = array(); 
             foreach ($jobNames as $j)
             {
                 $rez[$j['job_name']] = $j['job_name'];
             }
             
             return $rez;                                   
        }
        
        
        public function getClients() 
        {
             $jobNames = Yii::app()->db->createCommand()
                        ->selectDistinct('sf_username')
                        ->from($this->tableName())
                        ->order('sf_username ASC')
                        ->queryAll();
             $rez = array(); 
             foreach ($jobNames as $j)
             {
                 $rez[$j['sf_username']] = $j['sf_username'];
             }
             
             return $rez;                                   
        }
        
        
        public function getTypes() 
        {
             $jobNames = Yii::app()->db->createCommand()
                        ->selectDistinct('job_type')
                        ->from($this->tableName())
                        ->order('job_type ASC')
                        ->queryAll();
             $rez = array(); 
             foreach ($jobNames as $j)
             {
                 $rez[$j['job_type']] = $j['job_type'];
             }
             
             return $rez;                                   
        }
}
