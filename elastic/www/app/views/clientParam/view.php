<?php
$this->breadcrumbs=array(
	'Client Params'=>array('index'),
	$model->client_param_id,
);

$this->menu=array(
	array('label'=>'List ClientParam', 'url'=>array('index')),
	array('label'=>'Create ClientParam', 'url'=>array('create')),
	array('label'=>'Update ClientParam', 'url'=>array('update', 'id'=>$model->client_param_id)),
	array('label'=>'Delete ClientParam', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->client_param_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClientParam', 'url'=>array('admin')),
);
?>

<h1>View ClientParam #<?php echo $model->client_param_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'client_param_id',
		'job_template_client_id',
		'param_name',
		'param_value',
	),
)); ?>
