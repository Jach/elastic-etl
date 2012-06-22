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
 * This is the model class for table "job_template".
 *
 * The followings are the available columns in table 'job_template':
 * @property integer $job_template_id
 * @property string $job_template_schedule
 * @property string $job_template_client_id
 * @property string $job_template_kettle_kjb
 * @property integer $job_template_sequence
 * @property integer $job_template_max_retries
 * @property string $job_template_retry_delay
 */
class JobTemplate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return JobTemplate the static model class
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
		return 'job_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('job_template_schedule, job_template_client_id, job_template_kettle_kjb, job_template_sequence', 'required'),
			array('job_template_sequence, job_template_max_retries', 'numerical', 'integerOnly'=>true),
			array('job_template_schedule', 'length', 'max'=>7),
			array('job_template_client_id, job_template_kettle_kjb', 'length', 'max'=>256),
			array('job_template_retry_delay', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('job_template_id, job_template_schedule, job_template_client_id, job_template_kettle_kjb, job_template_sequence, job_template_max_retries, job_template_retry_delay', 'safe', 'on'=>'search'),
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
			'job_template_id' => 'Job Template',
			'job_template_schedule' => 'Job Template Schedule',
			'job_template_client_id' => 'Job Template Client',
			'job_template_kettle_kjb' => 'Job Template Kettle Kjb',
			'job_template_sequence' => 'Job Template Sequence',
			'job_template_max_retries' => 'Job Template Max Retries',
			'job_template_retry_delay' => 'Job Template Retry Delay',
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

		$criteria->compare('job_template_id',$this->job_template_id);
		$criteria->compare('job_template_schedule',$this->job_template_schedule,true);
		$criteria->compare('job_template_client_id',$this->job_template_client_id,true);
		$criteria->compare('job_template_kettle_kjb',$this->job_template_kettle_kjb,true);
		$criteria->compare('job_template_sequence',$this->job_template_sequence);
		$criteria->compare('job_template_max_retries',$this->job_template_max_retries);
		$criteria->compare('job_template_retry_delay',$this->job_template_retry_delay,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
