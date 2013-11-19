<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$shared_config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'MySurvey',
        'theme'=>'mySurvey_001',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
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
                        'showScriptName'=>false,
                        'caseSensitive'=>false,
                        'rules'=>array(
	                        //gii specific rules.
	                        'gii'=>'gii',
	                        'gii/<controller:\w+>'=>'gii/<controller>',
	                        'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',

	                        //site specific rules.
	                        '/'=>'site/index',
	                        '<action:(login|logout|register|home)>'=>'site/<action>',
	                        '<page:(reports|settings|successfulSubmit)>'=>'site/view/page/<page>',

	                         //any single word url handleded as controlle
							'<controller:\w+>'=>'<controller>/index', //view all
							'<controller:\w+>/<id:\d+>'=>'<controller>/view', //view one
							'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>', //specific-model/action
							'<controller:\w+>/<action:\w+>'=>'<controller>/<action>', //general-model/action
	                        '<controller:\w+>/<action:\w+>/<hash:\w+>'=>'<controller>/<action>', //specific model/action
			),
		),
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL databasex
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
//				array(
//					'class'=>'CWebLogRoute',
//				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);

$env_config = require_once( dirname(__FILE__).'/db/dev.php');
$config = CMap::mergeArray($shared_config, $env_config);

/* UNCOMMENT FOLLOWING LINES BELOW TO SEE app config.*/
//echo '<pre>';
//print_r($config);
//die();

return $config;