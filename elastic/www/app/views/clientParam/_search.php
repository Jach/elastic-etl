<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'client_param_id'); ?>
		<?php echo $form->textField($model,'client_param_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_template_client_id'); ?>
		<?php echo $form->textField($model,'job_template_client_id',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'param_name'); ?>
		<?php echo $form->textField($model,'param_name',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'param_value'); ?>
		<?php echo $form->textField($model,'param_value',array('size'=>60,'maxlength'=>4096)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->