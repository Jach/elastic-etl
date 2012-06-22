<?php
return array(
    'title'=>'Please select time interval',
 
    'elements'=>array(
        'start_time'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'end_time'=>array(
            'type'=>'text',
            'maxlength'=>32,
        )        
    ),
 
    'buttons'=>array(
        'filter'=>array(
            'type'=>'submit',
            'label'=>'Filter',
        ),
    ),
);
?>
