<?php
$this->breadcrumbs=array(
	'Job Templates'=>array('index'),
	$model->job_template_id,
);

$this->menu=array(
	array('label'=>'List JobTemplate', 'url'=>array('index')),
	array('label'=>'Create JobTemplate', 'url'=>array('create')),
	array('label'=>'Update JobTemplate', 'url'=>array('update', 'id'=>$model->job_template_id)),
	array('label'=>'Delete JobTemplate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->job_template_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JobTemplate', 'url'=>array('admin')),
);
?>

<h1>View JobTemplate #<?php echo $model->job_template_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'job_template_id',
		'job_template_schedule',
		'job_template_client_id',
		'job_template_kettle_kjb',
		'job_template_sequence',
		'job_template_max_retries',
		'job_template_retry_delay',
	),
)); ?>
