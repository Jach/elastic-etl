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
	'id'=>'slaves-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'slave_server_id'); ?>
		<?php echo $form->textField($model,'slave_server_id',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'slave_server_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slave_status'); ?>
    <?php echo EnumHelper::enumDropdown($model, 'slave_status'); ?>
		<?php echo $form->error($model,'slave_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slave_carte_url'); ?>
		<?php echo $form->textField($model,'slave_carte_url',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'slave_carte_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slave_startup_time'); ?>
		<?php echo $form->textField($model,'slave_startup_time'); ?>
		<?php echo $form->error($model,'slave_startup_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
