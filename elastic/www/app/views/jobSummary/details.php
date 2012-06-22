<?php
/*
   Copyright 2012 DynamoBI

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
 */

$this->breadcrumbs=array(
	'Job Summaries'=>array('index'),
	'Manage',
);
/*
$this->menu=array(
	array('label'=>'List JobSummary', 'url'=>array('index')),
	array('label'=>'Create JobSummary', 'url'=>array('create')),
);
*/

 
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/poshytip/jquery.poshytip.min.js');
$cs->registerScriptFile($baseUrl.'/js/jobSummary.js');
$cs->registerCssFile($baseUrl.'/js/poshytip/tip-violet/tip-violet.css');

?>


<h1>Job Summary</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div><!-- search-form -->

<?php
 //var_dump($model->getJobTypes());
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'job-summary-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'rowCssClassExpression' => '"details-table-row report-row-job-".strtolower($data["job_status"])',
	'columns'=>array(
           'JOB_ID',
            array(
                    'name' => 'job_name',
                    'filter' => $model->getJobTypes(),
                ),
		//'job_name',
		//'sf_username',
            array(
                    'name' => 'sf_username',
                    'filter' => $model->getClients(),
                ),
            array(
                    'name' => 'job_type',
                    'filter' => $model->getTypes(),
                ),
                //'job_type',
                 array(
                    'name' => 'job_status',
                    'filter' => array('Complete' => 'Complete', 'Aborted' => 'Aborted', 'Started'=>'Started','No Data'=>'No Data'),
                ),
            array(
                    'name'=>'start_time',
                    'type'=>'raw',
                    'filter'=> $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                    'name'=>'JobSummary[start_time]',
                                                    'model'=>$model,
                                                  'attribute'=>'start_time',
                                                  'value'=>$model->start_time,
                                                    // additional javascript options for the date picker plugin
                                                    'options'=>array(
                                                       // 'showAnim'=>'fold',
                                                        'dateFormat'=>'yy-mm-dd',
                                                        'showOtherMonths'=>true,
                                                        'changeMonth'=>true,
                                                        'gotoCurrent'=>true,
                                                        'showButtonPanel'=>true,
                                                        
                                                    ),
                                                    'htmlOptions'=>array(
                                                        'style'=>'height:20px;'
                                                    ),
                                                ), true)
                    //'filter'=>true,
                ),
		//'start_time',		
		array(
                    'name'=>'end_time',
                    'type'=>'raw',
                    'filter'=> $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                    'name'=>'JobSummary[end_time]',
                                                    'model'=>$model,
                                                  'attribute'=>'end_time',
                                                  'value'=>$model->end_time,
                                                    // additional javascript options for the date picker plugin
                                                    'options'=>array(
                                                        // 'showAnim'=>'fold',
                                                        'dateFormat'=>'yy-mm-dd',
                                                        'showOtherMonths'=>true,
                                                        'changeMonth'=>true,
                                                        'gotoCurrent'=>true,
                                                        'showButtonPanel'=>true,
                                                    ),
                                                    'htmlOptions'=>array(
                                                        'style'=>'height:20px;'
                                                    ),
                                                ), true)
                    //'filter'=>true,
                ),            
            ),
)); ?>




<div style="display: none;" id="url_sub_menu">
    <a href="javascript:void(0)" onclick="jobSummary.showLog(this); return false;">Show Log</a>
    <?php /*echo CHtml::ajaxLink(Yii::t('button','SELECT'),'/?r=JobSummary/view/',array(
                'dataType'=>'html',
                'type'=>'POST',
                'cache'=>'js:false',
                'success'=>'js:function(response){
                        setTimeout(function(){
                                $(response).appendTo("body");
                        },100);
                }',
        ));*/
?>
    <a href="javascript:void(0)" onclick="jobSummary.goToJob(this); return false;">Open Job</a>    
    <!--a href="#">Resolve</a-->
</div>



<script type="text/javascript">   
function initDetailsRow(){
    $('.details-table-row').poshytip({
            className: 'tip-violet',
            bgImageFrameSize: 11,
            alignY: 'bottom',
            content: function(updateCallback) {
                return $('<div/>').append($('#url_sub_menu').html()).append($('<div/>').attr('class', 'tooltip-value').hide().append($($(this).children()[0]).html().trim()));
            }
        });
}
initDetailsRow();
$('#url_sub_menu').bind("ajaxComplete",function() {
  initDetailsRow();
});
</script>
