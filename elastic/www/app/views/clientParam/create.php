<?php
$this->breadcrumbs=array(
	'Client Params'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClientParam', 'url'=>array('index')),
	array('label'=>'Manage ClientParam', 'url'=>array('admin')),
);
?>

<h1>Create ClientParam</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>