<?php
$this->breadcrumbs=array(
	'Master Configs'=>array('index'),
	$model->param_name=>array('view','param_name'=>$model->param_name),
	'Update',
);

$this->menu=array(
	array('label'=>'List MasterConfig', 'url'=>array('index')),
	array('label'=>'Create MasterConfig', 'url'=>array('create')),
	array('label'=>'View MasterConfig', 'url'=>array('view', 'param_name'=>$model->param_name)),
	array('label'=>'Manage MasterConfig', 'url'=>array('admin')),
);
?>

<h1>Update MasterConfig <?php echo $model->param_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
