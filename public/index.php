<?php

/*
  +------------------------------------------------------------------------+
  | baywa nltool                                                           |
  +------------------------------------------------------------------------+
  | Copyright (c) 2014 denkfabrik groupcom GmbH                            |
  +------------------------------------------------------------------------+
  | All rights reserved												       |
  | Author Philipp Schreiber											   |
  +------------------------------------------------------------------------+
*/

error_reporting(E_ALL);

if (!isset($_GET['_url'])) {
    $_GET['_url'] = '/';
}

define('APP_PATH', realpath('..'));

/**
 * Read the configuration
 */
$config = include APP_PATH . "/app/config/config.php";

/**
 * Include the loader
 */
require APP_PATH . "/app/config/loader.php";



try {

    /**
     * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
     */
    $di = new \Phalcon\DI\FactoryDefault();

    /**
     * Include the application services
     */
    require APP_PATH . "/app/config/services.php";

    /**
     * Handle the request
     */
    $application = new Phalcon\Mvc\Application($di);	
	echo $application->handle()->getContent();
} catch (Exception $e) {
	var_dump($e);
    echo 'Sorry, an error has ocurred :(';
}