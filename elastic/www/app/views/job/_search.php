<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'job_id'); ?>
		<?php echo $form->textField($model,'job_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'slave_server_id_lock'); ?>
		<?php echo $form->textField($model,'slave_server_id_lock',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_start_time'); ?>
		<?php echo $form->textField($model,'job_start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_status'); ?>
		<?php echo $form->textField($model,'job_status',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_retry_attempt'); ?>
		<?php echo $form->textField($model,'job_retry_attempt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_prior_failed_job_id'); ?>
		<?php echo $form->textField($model,'job_prior_failed_job_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_template_id'); ?>
		<?php echo $form->textField($model,'job_template_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_kettle_id'); ?>
		<?php echo $form->textField($model,'job_kettle_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->