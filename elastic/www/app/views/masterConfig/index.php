<?php
$this->breadcrumbs=array(
	'Master Configs',
);

$this->menu=array(
	array('label'=>'Create MasterConfig', 'url'=>array('create')),
	array('label'=>'Manage MasterConfig', 'url'=>array('admin')),
);
?>

<h1>Master Configs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
