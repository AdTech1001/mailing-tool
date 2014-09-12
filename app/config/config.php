<?php

return new \Phalcon\Config(array(

    'database'    => array(
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname'   => 'bayw-nltool',
        'charset'  => 'utf8'
    ),
    'application' => array(
        'controllersDir' => APP_PATH . '/app/controllers/',
        'modelsDir'      => APP_PATH . '/app/models/',
        'viewsDir'       => APP_PATH . '/app/views/',
		'frontendViewsDir'       => APP_PATH . '/app/modules/frontend/views/',
        'pluginsDir'     => APP_PATH . '/app/plugins/',
        'libraryDir'     => APP_PATH . '/app/library/',
		'messagesDir'     => APP_PATH . '/app/messages/',
		'frontendDir'     => APP_PATH . '/app/modules/frontend/',
		'frontendControllersDir'     => APP_PATH . '/app/modules/frontend/controllers',
		'backendDir'     => APP_PATH . '/app/modules/backend/',
		'backendControllersDir'     => APP_PATH . '/app/modules/backend/controllers',
		'appsDir' => APP_PATH.'/app/',
        'development'    => array(
            'staticBaseUri' => '/baywa-nltool/',
            'baseUri'       => '/baywa-nltool/'
        ),
        'production'     => array(
            'staticBaseUri' => '/baywa-nltool/',
            'baseUri'       => '/baywa-nltool/'
        ),
        'debug'          => true,
		'version' => '0.1 Alpha'
    ),    
    'smtp'        => array(
        'host'     => "",
        'port'     => 25,
        'security' => "tls",
        'username' => "",
        'password' => ""
    ),
	'languages'=>array(
		'de' => 'Deutsch',
		'en' => 'English'
	)
    
));