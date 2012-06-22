<?php
$this->breadcrumbs=array(
	'Slaves',
);

$this->menu=array(
	array('label'=>'Create Slaves', 'url'=>array('create')),
	array('label'=>'Manage Slaves', 'url'=>array('admin')),
);
?>

<h1>Slaves</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
