<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'job_template_id'); ?>
		<?php echo $form->textField($model,'job_template_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_template_schedule'); ?>
		<?php echo $form->textField($model,'job_template_schedule',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_template_client_id'); ?>
		<?php echo $form->textField($model,'job_template_client_id',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_template_kettle_kjb'); ?>
		<?php echo $form->textField($model,'job_template_kettle_kjb',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_template_sequence'); ?>
		<?php echo $form->textField($model,'job_template_sequence'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_template_max_retries'); ?>
		<?php echo $form->textField($model,'job_template_max_retries'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_template_retry_delay'); ?>
		<?php echo $form->textField($model,'job_template_retry_delay'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->