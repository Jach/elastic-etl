<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->job_id), array('view', 'id'=>$data->job_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slave_server_id_lock')); ?>:</b>
	<?php echo CHtml::encode($data->slave_server_id_lock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_start_time')); ?>:</b>
	<?php echo CHtml::encode($data->job_start_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_status')); ?>:</b>
	<?php echo CHtml::encode($data->job_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_retry_attempt')); ?>:</b>
	<?php echo CHtml::encode($data->job_retry_attempt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_prior_failed_job_id')); ?>:</b>
	<?php echo CHtml::encode($data->job_prior_failed_job_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_template_id')); ?>:</b>
	<?php echo CHtml::encode($data->job_template_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_kettle_id')); ?>:</b>
	<?php echo CHtml::encode($data->job_kettle_id); ?>
	<br />

</div>
