<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->job_name), array('view', 'job_name'=>$data->job_name)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_name')); ?>:</b>
	<?php echo CHtml::encode($data->job_name); ?>
	<br />


</div>
