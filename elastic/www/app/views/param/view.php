<?php
$this->breadcrumbs=array(
	'Params'=>array('index'),
	$model->param_id,
);

$this->menu=array(
	array('label'=>'List Param', 'url'=>array('index')),
	array('label'=>'Create Param', 'url'=>array('create')),
	array('label'=>'Update Param', 'url'=>array('update', 'id'=>$model->param_id)),
	array('label'=>'Delete Param', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->param_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Param', 'url'=>array('admin')),
);
?>

<h1>View Param #<?php echo $model->param_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'param_id',
		'job_template_id',
		'param_name',
		'param_value',
	),
)); ?>
