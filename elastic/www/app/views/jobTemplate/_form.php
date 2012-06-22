<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-template-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'job_template_schedule'); ?>
    <?php echo EnumHelper::enumDropdown($model, 'job_template_schedule'); ?>
		<?php echo $form->error($model,'job_template_schedule'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_template_client_id'); ?>
		<?php echo $form->textField($model,'job_template_client_id',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'job_template_client_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_template_kettle_kjb'); ?>
		<?php echo $form->textField($model,'job_template_kettle_kjb',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'job_template_kettle_kjb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_template_sequence'); ?>
		<?php echo $form->textField($model,'job_template_sequence'); ?>
		<?php echo $form->error($model,'job_template_sequence'); ?>
	</div>

  <div class="row">
    <?php echo $form->labelEx($model,'job_template_max_retries'); ?>
    <?php echo $form->textField($model,'job_template_max_retries'); ?>
    <?php echo $form->error($model,'job_template_max_retries'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'job_template_retry_delay'); ?>
    <?php echo $form->textField($model,'job_template_retry_delay'); ?>
    <?php echo $form->error($model,'job_template_retry_delay'); ?>
  </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
