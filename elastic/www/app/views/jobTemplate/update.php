<?php
$this->breadcrumbs=array(
	'Job Templates'=>array('index'),
	$model->job_template_id=>array('view','id'=>$model->job_template_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JobTemplate', 'url'=>array('index')),
	array('label'=>'Create JobTemplate', 'url'=>array('create')),
	array('label'=>'View JobTemplate', 'url'=>array('view', 'id'=>$model->job_template_id)),
	array('label'=>'Manage JobTemplate', 'url'=>array('admin')),
);
?>

<h1>Update JobTemplate <?php echo $model->job_template_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>