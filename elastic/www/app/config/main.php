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

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

// Modify this file's values in production
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'auth.php';

$cfg = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Elastic Jobs Master',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
      'showScriptName' => false,
			'rules'=>array(
        '' => 'site/login',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
        // is there a better way to manage these special-case rules?
				'<controller:\w+>/<action:(create|update|delete|view|admin|index|manage|login|logout|error|login|watchdog|launchSlaves|launchSingle)>'=>'<controller>/<action>',
        'gii/<action:\w+>' => 'gii/<action>',
        'gii/<action>/<action2>' => 'gii/<action>/<action2>',
        '<controller:\w+>/<id>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id>'=>'<controller>/<action>',
			),
		),

		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
    ),*/

    'db' => array(
      'connectionString' => $connStr,
      'emulatePrepare' => true,
      'username' => $dbUser,
      'password' => $dbPass,
      'charset' => 'utf8',
    ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info',
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
    // TODO: make someone in charge.
		'adminEmail'=>'webmaster@example.com',
    'actionAuth' => $actionAuth, // private pw for crontab jobs
    'adminUILogin' => $adminUILogin,
	),

);

// extra bits
if (YII_DEBUG) {
  $cfg['modules'] = array(
    'gii'=>array(
      'class'=>'system.gii.GiiModule',
      'password'=>'pass',
      // If removed, Gii defaults to localhost only. Edit carefully to taste.
      'ipFilters'=>false,//array('127.0.0.1','::1'),
    ),
  );

  // uncomment the following to show log messages on web pages
  $cfg['components']['log']['routes'][] = array(
    'class'=>'CWebLogRoute',
  );

}

return $cfg;

