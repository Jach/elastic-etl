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
 * This is the model class for table "slaves".
 *
 * The followings are the available columns in table 'slaves':
 * @property string $slave_server_id
 * @property string $slave_status
 * @property string $slave_carte_url
 * @property string $slave_startup_time
 */
class Slaves extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Slaves the static model class
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
		return 'slaves';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slave_server_id, slave_status, slave_startup_time', 'required'),
			array('slave_server_id, slave_carte_url', 'length', 'max'=>256),
			array('slave_status', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('slave_server_id, slave_status, slave_carte_url, slave_startup_time', 'safe', 'on'=>'search'),
      array('slave_startup_time', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => true, 'on' => 'insert'),
      array('slave_carte_url', 'default', 'value' => null),
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
			'slave_server_id' => 'Slave Server',
			'slave_status' => 'Slave Status',
			'slave_carte_url' => 'Slave Carte Url',
			'slave_startup_time' => 'Slave Startup Time',
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

		$criteria->compare('slave_server_id',$this->slave_server_id,true);
		$criteria->compare('slave_status',$this->slave_status,true);
		$criteria->compare('slave_carte_url',$this->slave_carte_url,true);
		$criteria->compare('slave_startup_time',$this->slave_startup_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
