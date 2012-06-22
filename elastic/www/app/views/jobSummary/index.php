<h1>Jobs Summary</h1>
<div class="form">
    <form id="job-summary-filter-form" action="?r=JobSummary/index">
    <label for="start_date">Start date</label>
    <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'name'=>'start_time',
                                      'attribute'=>'start_time',
                                      'value'=>$start_time,
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
                                    ), true)?>
    <label for="end_date">End date</label>
    <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'name'=>'end_time',
                                      'attribute'=>'end_time',
                                      'value'=>$end_time,
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
                                    ), true)?>
    <input type="submit" value="submit"/>
</form>
</div>

<div class="c-jobs-summary clearfix">
    <div class="c-list-by-client">
        <? //var_dump($by_clients)?>
        <?php foreach($by_clients as  $jc => $jt):?>
            <div class="c-job-client">
                <?php $base_href="/?r=JobSummary/Details&JobSummary[start_time]=$start_time&JobSummary[end_time]=$end_time&JobSummary[sf_username]=$jc";?>
                <a href="<?php echo $base_href;?>"><?php echo $jc?></a>
                
            </div>
            <?php foreach($jt as $t => $js):?>
               <div class="b-item"> <div class="">
                    <?php $base_href.="&JobSummary[job_type]=$t";?>
                    <a href="<?php echo $base_href;?>"><?php echo $t?></a>
                </div>
                <ul>
                    <?php foreach($js as $s):?>
                        <?php $base_href.="&JobSummary[job_status]=".$s['status'];?>
                        <li class="job-type-row-<?php echo strtolower($s['status'])?>"> 
                            <a href="<?php echo $base_href;?>"> <?php echo $s['status']?></a> - <?php echo $s['count']?></li>
                    <?php endforeach;?>
                </ul>
                
                </div>
            <?php endforeach;?>
        <div class="m-separate"></div>
        <?php endforeach;?>
    </div>
    
    <div class="c-list-by-job-type"><? //var_dump($by_jobs_types)?>
        <?php foreach($by_jobs_types as  $jt => $js):?>
             <?php $base_href="/?r=JobSummary/Details&JobSummary[start_time]=$start_time&JobSummary[end_time]=$end_time&JobSummary[job_type]=$jt";?>
            <div class="c-job-type">
                <a href="<?php echo $base_href;?>"><?php echo $jt?></a>
            </div>
            <ul>
                <?php foreach($js as  $s => $c):?>
                    <li class="job-type-row-<?php echo strtolower($s['status'])?>"> 
                        <div class="c-job-status"> 
                            <a href="<?php echo $base_href;?>&JobSummary[job_status]=<?php echo $s?>"> <?php echo $s?></a>
                            - <?php echo $c?>
                        </div>
                    </li>
                <?php endforeach;?>
            </ul>
        <div class="m-separate"></div>    
        <?php endforeach;?>
    </div>
   
</div>