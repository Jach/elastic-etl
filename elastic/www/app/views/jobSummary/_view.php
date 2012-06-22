<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('JOB_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->JOB_ID), array('view', 'id'=>$data->JOB_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_name')); ?>:</b>
	<?php echo CHtml::encode($data->job_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sf_username')); ?>:</b>
	<?php echo CHtml::encode($data->sf_username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_type')); ?>:</b>
	<?php echo CHtml::encode($data->job_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_status')); ?>:</b>
	<?php echo CHtml::encode($data->job_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_time')); ?>:</b>
	<?php echo CHtml::encode($data->start_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_time')); ?>:</b>
	<?php echo CHtml::encode($data->end_time); ?>
	<br />


</div>