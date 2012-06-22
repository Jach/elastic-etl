<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/../app/config/main.php';

date_default_timezone_set('US/Pacific');

define('LOCAL_DEV', ($_SERVER['HTTP_HOST'] == '50.46.152.154:4321' || $_SERVER['HTTP_HOST'] == 'elastic-loc:8080') );

if (LOCAL_DEV) {
  // remove the following lines when in production mode
  defined('YII_DEBUG') or define('YII_DEBUG',true);
  // specify how many levels of call stack should be shown in each log message
  defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
}

function printa($var, $return=0) {
  $out = '<pre>' . htmlentities(print_r($var, 1), ENT_COMPAT, 'UTF-8') . "</pre>\n<br />\n";
  if ($return)
    return $out;
  else
    echo $out;
}

require_once($yii);
Yii::createWebApplication($config)->run();
