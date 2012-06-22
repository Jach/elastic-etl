<?php
$this->breadcrumbs=array(
	'Job Templates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JobTemplate', 'url'=>array('index')),
	array('label'=>'Manage JobTemplate', 'url'=>array('admin')),
);
?>

<h1>Create JobTemplate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>