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
	'id'=>'job-summary-edit-form',
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
		<?php echo $form->textField($model,'job_name'); ?>
		<?php echo $form->error($model,'job_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sf_username'); ?>
		<?php echo $form->textField($model,'sf_username'); ?>
		<?php echo $form->error($model,'sf_username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_type'); ?>
		<?php echo $form->textField($model,'job_type'); ?>
		<?php echo $form->error($model,'job_type'); ?>
	</div>

	<div class="row">
            
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php echo $form->textField($model,'start_time'); ?>
		<?php echo $form->error($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_status'); ?>
		<?$form->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'start_time',
    'model'=>$model,
  'attribute'=>'start_time',
  'value'=>$model->start_time,
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));?>
		<?php echo $form->error($model,'job_status'); ?>
	</div>

	<div class="row">
            
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?$form->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'end_time',
    'model'=>$model,
  'attribute'=>'end_time',
  'value'=>$model->end_time,
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));?>
		<?php echo $form->error($model,'end_time'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
