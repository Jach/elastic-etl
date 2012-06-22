<?php
$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	$model->job_id=>array('view','id'=>$model->job_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Job', 'url'=>array('index')),
	array('label'=>'Create Job', 'url'=>array('create')),
	array('label'=>'View Job', 'url'=>array('view', 'id'=>$model->job_id)),
	array('label'=>'Manage Job', 'url'=>array('admin')),
);
?>

<h1>Update Job <?php echo $model->job_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>