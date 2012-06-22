<div class="view">
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
?>


	<b><?php echo CHtml::encode($data->getAttributeLabel('slave_server_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->slave_server_id), array('view', 'id'=>$data->slave_server_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slave_status')); ?>:</b>
	<?php echo CHtml::encode($data->slave_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slave_carte_url')); ?>:</b>
	<?php echo CHtml::encode($data->slave_carte_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slave_startup_time')); ?>:</b>
	<?php echo CHtml::encode($data->slave_startup_time); ?>
	<br />

    <b>Carte Status:</b>
<?php
$xml = KettleApi::kettleStatus($data->slave_carte_url);
if($xml != NULL)
  echo '<span style="color:green;">'. $xml->statusdesc .'</span>';
else
  echo '<span style="color:red;">Offline</span>';
?>
  <br />


</div>
