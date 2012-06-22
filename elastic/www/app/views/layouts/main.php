<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); if (YII_DEBUG) echo ' (Debug Mode) '; ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				//array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
        //array('label'=>'Manage Tables', 'url'=>array('/site/manage'), 'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
        array('label'=>'Jobs', 'url'=>array('/job'), 'visible'=>!Yii::app()->user->isGuest),
        array('label'=>'Job Templates', 'url'=>array('/jobTemplate'), 'visible'=>!Yii::app()->user->isGuest),
        array('label'=>'Master Configurations', 'url'=>array('/masterConfig'), 'visible'=>!Yii::app()->user->isGuest),
        array('label'=>'Job Configurations', 'url'=>array('/param'), 'visible'=>!Yii::app()->user->isGuest),
        array('label'=>'Client Configurations', 'url'=>array('/clientParam'), 'visible'=>!Yii::app()->user->isGuest),
        array('label'=>'Slaves', 'url'=>array('/slaves'), 'visible'=>!Yii::app()->user->isGuest),
        array('label'=>'Launch One Slave', 'url'=>array('/slaves/launchSingle'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
        //array('label'=>'Reports', 'url'=>array('/report'), 'visible'=>!Yii::app()->user->isGuest),
        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
        array('label'=>'Gii', 'url'=>array('/gii/'), 'visible'=>YII_DEBUG),
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
		Software Copyright &copy; <?php echo date('Y'); ?> DynamoBI<br/>
	  Licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0.html">Apache License, Version 2.0</a><br/>
    This notice is not required.<br/>
    <?php /*echo Yii::powered();*/ ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
