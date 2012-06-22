<?php
$this->breadcrumbs=array(
	'Job Summaries'=>array('index'),
	346453,
);
/*
$this->menu=array(
	array('label'=>'List JobSummary', 'url'=>array('index')),
	array('label'=>'Create JobSummary', 'url'=>array('create')),
	array('label'=>'Update JobSummary', 'url'=>array('update', 'id'=>$model->JOB_ID)),
	array('label'=>'Delete JobSummary', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->JOB_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JobSummary', 'url'=>array('admin')),
);
?>
*/
?>


<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
        'options'=>array(
                'autoOpen'=>'js:true',
                'closeOnEscape'=>'js:true',
                'title'=>Yii::t('campaign','MY DIALOG'),
                'close'=>'js:function(e,ui){
                        $(this).dialog("destroy").remove();
                        // ****CODE TO SET VALUES****
                }',
                'width'=>850,
                'height'=>650,
                'modal'=>'js:true',
                'buttons'=>array(
                        Yii::t('button','CLOSE')=>'js:function(){ $(this).dialog("close"); }',
                ),
        ),
        'htmlOptions'=>array(
                'style'=>'display:none',
        ),
));?>   
        

<h1>View JobSummary #<?php echo $model->JOB_ID; ?></h1>
<div id="job-summary-tabs">
     <ul>
         <li><a href="#job"><span>Job</span></a></li>
         <li><a href="#transformations"><span>Transformations</span></a></li>
     </ul>
    
    <div id="job"> 
        <div>
            From <?php echo $jobDetails['job_start'] ?> To: <?php echo $jobDetails['job_end']?>
        </div>
        <pre>
            <?php
                echo $jobDetails['job_log']        
            ?>
        </pre>
    </div>

    <div id="transformations">
        <div id="accordion">
            <?php foreach ($transDetails as $t):?>
            <h3><a href="#"><?php echo $t['trans_name']?></a></h3>
            <div><?php echo $t['LOG_FIELD']?></div>
            <?php endforeach;?>
        </div>
    </div>
</div>



<script>
	$(function() {
		$( "#job-summary-tabs" ).tabs();
	});
</script>

 
<?php $this->widget('CTabView', array('tabs'=>$tabParameters)); ?>

<?php $this->endWidget();?>