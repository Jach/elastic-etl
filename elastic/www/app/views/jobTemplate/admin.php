<?php
$this->breadcrumbs=array(
	'Job Templates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List JobTemplate', 'url'=>array('index')),
	array('label'=>'Create JobTemplate', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('job-template-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Job Templates</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'job-template-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'job_template_id',
		'job_template_schedule',
		'job_template_client_id',
		'job_template_kettle_kjb',
		'job_template_sequence',
		'job_template_max_retries',
		'job_template_retry_delay',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
