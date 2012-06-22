<?php
$this->breadcrumbs=array(
	'Job Summaries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JobSummary', 'url'=>array('index')),
	array('label'=>'Manage JobSummary', 'url'=>array('admin')),
);
?>

<h1>Create JobSummary</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>