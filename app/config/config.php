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