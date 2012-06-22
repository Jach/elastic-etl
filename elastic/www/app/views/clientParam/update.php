<?php
$this->breadcrumbs=array(
	'Client Params'=>array('index'),
	$model->client_param_id=>array('view','id'=>$model->client_param_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClientParam', 'url'=>array('index')),
	array('label'=>'Create ClientParam', 'url'=>array('create')),
	array('label'=>'View ClientParam', 'url'=>array('view', 'id'=>$model->client_param_id)),
	array('label'=>'Manage ClientParam', 'url'=>array('admin')),
);
?>

<h1>Update ClientParam <?php echo $model->client_param_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>