<?php
$this->breadcrumbs=array(
	'Job Templates',
);

$this->menu=array(
	array('label'=>'Create JobTemplate', 'url'=>array('create')),
	array('label'=>'Manage JobTemplate', 'url'=>array('admin')),
);
?>

<h1>Job Templates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
  'template'=>'{summary}{pager}{items}{pager}',
)); ?>
