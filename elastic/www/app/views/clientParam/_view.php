<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_param_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->client_param_id), array('view', 'id'=>$data->client_param_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_template_client_id')); ?>:</b>
	<?php echo CHtml::encode($data->job_template_client_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('param_name')); ?>:</b>
	<?php echo CHtml::encode($data->param_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('param_value')); ?>:</b>
	<?php echo CHtml::encode($data->param_value); ?>
	<br />


</div>