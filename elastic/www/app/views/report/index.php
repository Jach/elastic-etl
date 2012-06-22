<?php
$this->breadcrumbs=array(
	'Report',
);?>

<?php 
$this->menu=array(
	array('label'=>'Client report', 'url'=>array('client')),
	array('label'=>'Job report', 'url'=>array('job')),
);
?>

<?php /*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('report-jobsummary-grid', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h1>Reports</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,    
    'columns' => array(
        array(
            'name' => 'job_name',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->job_name),
                         array("report/view","id" => $data->job_name))',
        ),
        array(
            'name' => 'Client Name',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->sf_username),
                         array("report/client","name" => $data->sf_username))',
        ),
        array(
            'name' => 'name',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->job_type),
                         array("report/job_type","name" => $data->job_type))',
        ),
        'job_status',
        'start_time',
        'end_time',
    ),
));
?>