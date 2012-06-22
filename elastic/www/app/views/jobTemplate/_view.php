<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_template_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->job_template_id), array('view', 'id'=>$data->job_template_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_template_schedule')); ?>:</b>
	<?php echo CHtml::encode($data->job_template_schedule); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_template_client_id')); ?>:</b>
	<?php echo CHtml::encode($data->job_template_client_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_template_kettle_kjb')); ?>:</b>
	<?php echo CHtml::encode($data->job_template_kettle_kjb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_template_sequence')); ?>:</b>
	<?php echo CHtml::encode($data->job_template_sequence); ?>
	<br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('job_template_max_retries')); ?>:</b>
  <?php echo CHtml::encode($data->job_template_max_retries); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('job_template_retry_delay')); ?>:</b>
  <?php echo CHtml::encode($data->job_template_retry_delay); ?>
  <br />

	<?php echo CHtml::link('Run Job Now', array('immediateLoad', 'id'=>$data->job_template_id), array('title' => 'This will automatically launch a slave if none are up')); ?>
  <br />


</div>
