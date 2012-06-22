<?php
$this->breadcrumbs=array(
	'Slaves'=>array('index'),
	$model->slave_server_id=>array('view','id'=>$model->slave_server_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Slaves', 'url'=>array('index')),
	array('label'=>'Create Slaves', 'url'=>array('create')),
	array('label'=>'View Slaves', 'url'=>array('view', 'id'=>$model->slave_server_id)),
	array('label'=>'Manage Slaves', 'url'=>array('admin')),
);
?>

<h1>Update Slaves <?php echo $model->slave_server_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>