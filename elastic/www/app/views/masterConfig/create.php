<?php
$this->breadcrumbs=array(
	'Master Configs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MasterConfig', 'url'=>array('index')),
	array('label'=>'Manage MasterConfig', 'url'=>array('admin')),
);
?>

<h1>Create MasterConfig</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>