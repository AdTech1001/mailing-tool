<?php


$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(
    array(
		'nltool\Models'        => $this->config->application->modelsDir,
		'nltool\Controllers'   => $config->application->controllersDir,
		'nltool\Modules\Modules\Frontend'=>$config->application->frontendDir,
		'nltool\Modules\Modules\Frontend\Controllers'=>$config->application->frontendControllersDir,
		'nltool\Modules\Modules\Backend'=>$config->application->backendDir,
		'nltool\Modules\Modules\Backend\Controllers'=>$config->application->backendControllersDir,
		'nltool\app' => $config->application->appsDir,
		'nltool' => $config->application->libraryDir
       
    )
);

 $loader->registerDirs(array(
        $config->application->controllersDir,
        $config->application->modelsDir
    ));

$loader->register();