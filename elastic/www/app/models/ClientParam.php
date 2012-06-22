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
 * This is the model class for table "client_param".
 *
 * The followings are the available columns in table 'client_param':
 * @property integer $client_param_id
 * @property string $job_template_client_id
 * @property string $param_name
 * @property string $param_value
 */
class ClientParam extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ClientParam the static model class
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
		return 'client_param';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('param_name', 'required'),
			array('job_template_client_id, param_name', 'length', 'max'=>256),
			array('param_value', 'length', 'max'=>4096),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('client_param_id, job_template_client_id, param_name, param_value', 'safe', 'on'=>'search'),
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
			'client_param_id' => 'Client Param',
			'job_template_client_id' => 'Job Template Client',
			'param_name' => 'Param Name',
			'param_value' => 'Param Value',
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

		$criteria->compare('client_param_id',$this->client_param_id);
		$criteria->compare('job_template_client_id',$this->job_template_client_id,true);
		$criteria->compare('param_name',$this->param_name,true);
		$criteria->compare('param_value',$this->param_value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
