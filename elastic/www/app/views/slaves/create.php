<?php
$this->breadcrumbs=array(
	'Slaves'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Slaves', 'url'=>array('index')),
	array('label'=>'Manage Slaves', 'url'=>array('admin')),
);
?>

<h1>Create Slaves</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>