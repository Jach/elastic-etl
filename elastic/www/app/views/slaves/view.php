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

$this->breadcrumbs=array(
	'Slaves'=>array('index'),
	$model->slave_server_id,
);

$this->menu=array(
	array('label'=>'List Slaves', 'url'=>array('index')),
	array('label'=>'Create Slaves', 'url'=>array('create')),
	array('label'=>'Update Slaves', 'url'=>array('update', 'id'=>$model->slave_server_id)),
	array('label'=>'Delete Slaves', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->slave_server_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Slaves', 'url'=>array('admin')),
);
?>

<h1>View Slaves <?php echo $model->slave_server_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'slave_server_id',
		'slave_status',
		'slave_carte_url',
		'slave_startup_time',
	),
)); ?>
