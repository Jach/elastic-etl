<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'client-param-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'job_template_client_id'); ?>
		<?php echo $form->textField($model,'job_template_client_id',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'job_template_client_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'param_name'); ?>
		<?php echo $form->textField($model,'param_name',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'param_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'param_value'); ?>
		<?php echo $form->textField($model,'param_value',array('size'=>60,'maxlength'=>4096)); ?>
		<?php echo $form->error($model,'param_value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->