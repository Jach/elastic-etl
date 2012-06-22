<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-summary-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'JOB_ID'); ?>
		<?php echo $form->textField($model,'JOB_ID'); ?>
		<?php echo $form->error($model,'JOB_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_name'); ?>
		<?php echo $form->textField($model,'job_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'job_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sf_username'); ?>
		<?php echo $form->textField($model,'sf_username',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'sf_username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_type'); ?>
		<?php echo $form->textField($model,'job_type',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'job_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_status'); ?>
		<?php echo $form->textField($model,'job_status',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'job_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php echo $form->textField($model,'start_time'); ?>
		<?php echo $form->error($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?php echo $form->textField($model,'end_time'); ?>
		<?php echo $form->error($model,'end_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->