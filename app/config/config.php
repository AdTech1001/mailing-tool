<?php

return new \Phalcon\Config(array(

    
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
		'formsDir'     => APP_PATH . '/app/forms',
		'backendDir'     => APP_PATH . '/app/modules/backend/',
		'backendControllersDir'     => APP_PATH . '/app/modules/backend/controllers',
		'appsDir' => APP_PATH.'/app/',
        'development'    => array(
            'staticBaseUri' => '/baywa-nltool/',
            'baseUri'       => '/baywa-nltool/'
        ),
        'production'     => array(
            'staticBaseUri' => '/',
            'baseUri'       => '/'
        ),
        'debug'          => true,
		'dontSendReally' => true,
		'version' => '1.0 beta'
    ),    
    'smtp'        => array(
        'host'     => "smtp.iq-pi.org",
        'port'     => 25,
        'security' => "tls",
        'username' => "mailing@iq-pi.org",
        'password' => "hpkYhxr&mdm7", //
		'mailcycle' => 300
    ),
	
	'languages'=>array(
		'de' => 'Deutsch',
		'en' => 'English'
	),
	'database'=>array(
		'production'=>array(
			'adapter'  => 'Mysql',
			'host'     => 'nltool.mysql.eu1.frbit.com',
			'username' => 'nltool',
			'password' => 'ab9b03uQYRb_0lly',
			'dbname'   => 'nltool',
			'charset'  => 'utf8'
		),
		'debug'=>array(
			'adapter'  => 'Mysql',
			'host'     => 'localhost',
			'username' => 'root',
			'password' => '',
			'dbname'   => 'bayw-nltool',
			'charset'  => 'utf8'
		)
		
	)
    
));

