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
 * This is the model class for table "job".
 *
 * The followings are the available columns in table 'job':
 * @property integer $job_id
 * @property string $slave_server_id_lock
 * @property string $job_start_time
 * @property string $job_status
 * @property integer $job_retry_attempt
 * @property integer $job_prior_failed_job_id
 * @property integer $job_template_id
 * @property integer $job_kettle_id
 */
class Job extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Job the static model class
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
		return 'job';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('job_status, job_template_id', 'required'),
			array('job_retry_attempt, job_prior_failed_job_id, job_template_id, job_kettle_id', 'numerical', 'integerOnly'=>true),
			array('slave_server_id_lock', 'length', 'max'=>256),
      array('slave_server_id_lock', 'default', 'setOnEmpty' => true, 'value' => null),
			array('job_status', 'length', 'max'=>10),
			array('job_start_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('job_id, slave_server_id_lock, job_start_time, job_status, job_retry_attempt, job_prior_failed_job_id, job_template_id, job_kettle_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'job_id' => 'Job',
			'slave_server_id_lock' => 'Slave Server Id Lock',
			'job_start_time' => 'Job Start Time',
			'job_status' => 'Job Status',
      'job_retry_attempt' => 'Job Retry Attempt',
      'job_prior_failed_job_id' => 'Job Prior Failed Job',
			'job_template_id' => 'Job Template',
			'job_kettle_id' => 'Job Kettle',
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

		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('slave_server_id_lock',$this->slave_server_id_lock,true);
		$criteria->compare('job_start_time',$this->job_start_time,true);
		$criteria->compare('job_status',$this->job_status,true);
    $criteria->compare('job_retry_attempt',$this->job_retry_attempt);
    $criteria->compare('job_prior_failed_job_id',$this->job_prior_failed_job_id);
		$criteria->compare('job_template_id',$this->job_template_id);
		$criteria->compare('job_kettle_id',$this->job_kettle_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
      'sort' => array('defaultOrder'=>'job_id DESC'),
		));
	}
}
