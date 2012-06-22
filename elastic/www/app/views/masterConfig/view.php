<?php
$this->breadcrumbs=array(
	'Master Configs'=>array('index'),
	$model->param_name,
);

$this->menu=array(
	array('label'=>'List MasterConfig', 'url'=>array('index')),
	array('label'=>'Create MasterConfig', 'url'=>array('create')),
	array('label'=>'Update MasterConfig', 'url'=>array('update', 'param_name'=>$model->param_name)),
	array('label'=>'Delete MasterConfig', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','param_name'=>$model->param_name),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MasterConfig', 'url'=>array('admin')),
);
?>

<h1>View MasterConfig #<?php echo $model->param_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'param_name',
		'param_value',
	),
)); ?>
