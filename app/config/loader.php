<?php


$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(
    array(
       'nltool\Models'        => $config->application->modelsDir,
       'nltool\Controllers'   => $config->application->controllersDir
       
    )
);

$loader->register();