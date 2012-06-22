<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'job_name'); ?>
		<?php echo $form->textField($model,'job_name',array('size'=>60,'maxlength'=>256)); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'sf_username'); ?>
		<?php echo $form->textField($model,'sf_username',array('size'=>60,'maxlength'=>256)); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'job_type'); ?>
		<?php echo $form->textField($model,'job_type',array('size'=>60,'maxlength'=>256)); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'job_status'); ?>
		<?php echo $form->textField($model,'job_status',array('size'=>60,'maxlength'=>256)); ?>
	</div>
        

<?php $this->endWidget(); ?>

</div><!-- search-form -->