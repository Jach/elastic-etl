<div class="form">

<?php
/*
   Copyright 2012 DynamoBI

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
 */

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'slave_server_id_lock'); ?>
		<?php echo $form->textField($model,'slave_server_id_lock',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'slave_server_id_lock'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_start_time'); ?>
		<?php echo $form->textField($model,'job_start_time'); ?>
		<?php echo $form->error($model,'job_start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_status'); ?>
    <?php echo EnumHelper::enumDropdown($model, 'job_status'); ?>
		<?php echo $form->error($model,'job_status'); ?>
	</div>

  <div class="row">
    <?php echo $form->labelEx($model,'job_retry_attempt'); ?>
    <?php echo $form->textField($model,'job_retry_attempt'); ?>
    <?php echo $form->error($model,'job_retry_attempt'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'job_prior_failed_job_id'); ?>
    <?php echo $form->textField($model,'job_prior_failed_job_id'); ?>
    <?php echo $form->error($model,'job_prior_failed_job_id'); ?>
  </div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_template_id'); ?>
		<?php echo $form->textField($model,'job_template_id'); ?>
		<?php echo $form->error($model,'job_template_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_kettle_id'); ?>
		<?php echo $form->textField($model,'job_kettle_id'); ?>
		<?php echo $form->error($model,'job_kettle_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
