<?php
/**
 * Register application modules
 */

$application->registerModules(array(
    'frontend' => array(
        'className' => 'Modules\Modules\Frontend\Module',
        'path' => __DIR__ . '/../modules/frontend/Module.php'
    ), 
    'dashboard' => array(
        'className' => 'Modules\Modules\Backend\Module',
        'path' => __DIR__ . '/../modules/backend/Module.php'
    )
));