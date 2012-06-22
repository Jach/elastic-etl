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
 * This is the model class for table "job_log".
 *
 * The followings are the available columns in table 'job_log':
 * @property integer $ID_JOB
 * @property string $CHANNEL_ID
 * @property string $JOBNAME
 * @property string $STATUS
 * @property string $LINES_READ
 * @property string $LINES_WRITTEN
 * @property string $LINES_UPDATED
 * @property string $LINES_INPUT
 * @property string $LINES_OUTPUT
 * @property string $LINES_REJECTED
 * @property string $ERRORS
 * @property string $STARTDATE
 * @property string $ENDDATE
 * @property string $LOGDATE
 * @property string $DEPDATE
 * @property string $REPLAYDATE
 * @property string $LOG_FIELD
 */
class JobLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return JobLog the static model class
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
		return 'job_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_JOB', 'numerical', 'integerOnly'=>true),
			array('CHANNEL_ID, JOBNAME', 'length', 'max'=>255),
			array('STATUS', 'length', 'max'=>15),
			array('LINES_READ, LINES_WRITTEN, LINES_UPDATED, LINES_INPUT, LINES_OUTPUT, LINES_REJECTED, ERRORS', 'length', 'max'=>20),
			array('STARTDATE, ENDDATE, LOGDATE, DEPDATE, REPLAYDATE, LOG_FIELD', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_JOB, CHANNEL_ID, JOBNAME, STATUS, LINES_READ, LINES_WRITTEN, LINES_UPDATED, LINES_INPUT, LINES_OUTPUT, LINES_REJECTED, ERRORS, STARTDATE, ENDDATE, LOGDATE, DEPDATE, REPLAYDATE, LOG_FIELD', 'safe', 'on'=>'search'),
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
			'ID_JOB' => 'Id Job',
			'CHANNEL_ID' => 'Channel',
			'JOBNAME' => 'Jobname',
			'STATUS' => 'Status',
			'LINES_READ' => 'Lines Read',
			'LINES_WRITTEN' => 'Lines Written',
			'LINES_UPDATED' => 'Lines Updated',
			'LINES_INPUT' => 'Lines Input',
			'LINES_OUTPUT' => 'Lines Output',
			'LINES_REJECTED' => 'Lines Rejected',
			'ERRORS' => 'Errors',
			'STARTDATE' => 'Startdate',
			'ENDDATE' => 'Enddate',
			'LOGDATE' => 'Logdate',
			'DEPDATE' => 'Depdate',
			'REPLAYDATE' => 'Replaydate',
			'LOG_FIELD' => 'Log Field',
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

		$criteria->compare('ID_JOB',$this->ID_JOB);
		$criteria->compare('CHANNEL_ID',$this->CHANNEL_ID,true);
		$criteria->compare('JOBNAME',$this->JOBNAME,true);
		$criteria->compare('STATUS',$this->STATUS,true);
		$criteria->compare('LINES_READ',$this->LINES_READ,true);
		$criteria->compare('LINES_WRITTEN',$this->LINES_WRITTEN,true);
		$criteria->compare('LINES_UPDATED',$this->LINES_UPDATED,true);
		$criteria->compare('LINES_INPUT',$this->LINES_INPUT,true);
		$criteria->compare('LINES_OUTPUT',$this->LINES_OUTPUT,true);
		$criteria->compare('LINES_REJECTED',$this->LINES_REJECTED,true);
		$criteria->compare('ERRORS',$this->ERRORS,true);
		$criteria->compare('STARTDATE',$this->STARTDATE,true);
		$criteria->compare('ENDDATE',$this->ENDDATE,true);
		$criteria->compare('LOGDATE',$this->LOGDATE,true);
		$criteria->compare('DEPDATE',$this->DEPDATE,true);
		$criteria->compare('REPLAYDATE',$this->REPLAYDATE,true);
		$criteria->compare('LOG_FIELD',$this->LOG_FIELD,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
