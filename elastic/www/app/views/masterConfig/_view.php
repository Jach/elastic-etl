<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('param_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->param_name), array('view', 'param_name'=>$data->param_name)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('param_value')); ?>:</b>
	<?php echo CHtml::encode($data->param_value); ?>
	<br />


</div>
