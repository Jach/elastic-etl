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

 $this->pageTitle=Yii::app()->name; ?>

<?php $this->widget('zii.widgets.CMenu', array(
  'items' => array(
    array('label'=>'Jobs', 'url'=>array('/job')),
    array('label'=>'Job Templates', 'url'=>array('/jobTemplate')),
    array('label'=>'Master Configurations', 'url'=>array('/masterConfig')),
    array('label'=>'Configuration Parameters', 'url'=>array('/param')),
    array('label'=>'Slaves', 'url'=>array('/slaves')),
  ),
)); ?>

