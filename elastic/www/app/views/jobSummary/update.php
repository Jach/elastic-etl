<?php
$this->breadcrumbs=array(
	'Job Summaries'=>array('index'),
	$model->JOB_ID=>array('view','id'=>$model->JOB_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List JobSummary', 'url'=>array('index')),
	array('label'=>'Create JobSummary', 'url'=>array('create')),
	array('label'=>'View JobSummary', 'url'=>array('view', 'id'=>$model->JOB_ID)),
	array('label'=>'Manage JobSummary', 'url'=>array('admin')),
);
?>

<h1>Update JobSummary <?php echo $model->JOB_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>