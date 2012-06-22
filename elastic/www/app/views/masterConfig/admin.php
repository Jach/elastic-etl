<?php
$this->breadcrumbs=array(
	'Master Configs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MasterConfig', 'url'=>array('index')),
	array('label'=>'Create MasterConfig', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('master-config-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Master Configs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'master-config-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'param_name',
		'param_value',
		array(
			'class'=>'CButtonColumn',
      'viewButtonUrl'=>'Yii::app()->createUrl("/masterConfig/view", array("param_name"=>$data["param_name"]))',
      'deleteButtonUrl'=>'Yii::app()->createUrl("/masterConfig/delete", array("param_name"=>$data["param_name"]))',
      'updateButtonUrl'=>'Yii::app()->createUrl("/masterConfig/update", array("param_name"=>$data["param_name"]))',
		),
	),
)); ?>
