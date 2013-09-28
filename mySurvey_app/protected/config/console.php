<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
$shared_config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=mySurvey_app',
			'emulatePrepare' => true,
			'username' => 'srv-svc',
			'password' => ')7ZQm!G<4Y#q`t%',
			'charset' => 'utf8',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);
$env_config = require_once( dirname(__FILE__).'/db/dev.php');
$config = CMap::mergeArray($shared_config, $env_config);

/* UNCOMMENT FOLLOWING LINES BELOW TO SEE app config.*/
//echo '<pre>';
//print_r($config);
//die();

return $config;