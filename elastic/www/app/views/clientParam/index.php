<?php
$this->breadcrumbs=array(
	'Client Params',
);

$this->menu=array(
	array('label'=>'Create ClientParam', 'url'=>array('create')),
	array('label'=>'Manage ClientParam', 'url'=>array('admin')),
);
?>

<h1>Client Params</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
