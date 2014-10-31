<?php


$router = new Phalcon\Mvc\Router(true);

$router->setDefaultModule("frontend");
$router->removeExtraSlashes(TRUE);


$router->add(
	'/{language:[a-z]{2}}/:controller[/]{0,1}', 
	array(
		'language' => 1,
		'controller' => 2,
		'action' => "index",
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers',
	)
);

$router->add(
	'/{language:[a-z]{2}}/mailobjects/update/:int[/]{0,1}', 
	array(
		'language' => 1,
		'controller' => "mailobjects",
		'action' => "update",
		'uid' => 2,
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers'
	)
);

$router->add(
	'/{language:[a-z]{2}}/addressfolders/update/:int[/]{0,1}', 
	array(
		'language' => 1,
		'controller' => "addressfolders",
		'action' => "update",
		'uid' => 2,
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers'
	)
);

$router->add(
	'/{language:[a-z]{2}}/campaignobjects/update/:int[/]{0,1}', 
	array(
		'language' => 1,
		'controller' => "campaignobjects",
		'action' => "update",
		'uid' => 2,
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers'
	)
);

$router->add(
	'/mailobjects/update/:int[/]{0,1}', 
	array(	
		'controller' => "mailobjects",
		'action' => "update",
		'uid' => 1,
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers'
	)
);



$router->add(
		'/configurationobjects/:action[/]{0,1}',
		array(
		'controller' => "configurationobjects",
		'action' => 1,		
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers'
		)
);

$router->add(
	'/{language:[a-z]{2}}/:controller/:action[/]{0,1}', 
	array(
		'language' => 1,
		'controller' => 2,
		'action' => 3,
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers',
	)
);

$router->add(
	'/{language:[a-z]{2}}/configurationobjects/update/:int[/]{0,1}', 
	array(
		'language' => 1,
		'controller' => "configurationobjects",
		'action' => "update",
		'uid' => 2,
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers'
	)
);



$router->add(
	'/contentobjects/:action[/]{0,1}', 
	array(	
		'controller' => 'contentobjects',
		'action' => 1,
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers',
	)
);

$router->add(
	'/campaignobjects/:action[/]{0,1}', 
	array(	
		'controller' => 'campaignobjects',
		'action' => 1,
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers',
	)
);
$router->add(
	'/addressfolders/:action[/]{0,1}', 
	array(	
		'controller' => 'addressfolders',
		'action' => 1,
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers',
	)
);



$router->add(
	'/:controller[/]{0,1}', 
	array(	
		'module'=>'frontend',
		'controller' => 1,
		'action' => "index",
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers',
	)
);

$router->add(
	'/{language:[a-z]{2}}/', 
	array(
		'language' => 1,
		'controller' => "index",
		'action' => "index",
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers',
));

$router->add(
    '/',
    array(		
		'controller' => 'index',
		'action'     => 'index',
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers',
    )
);

$router->add(
    '/session/index/',
    array(
		'controller' => 'session',
		'action'     => 'index',
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers',
    )
);

$router->add(
    '/session/start[/]{0,1}',
    array(
       'controller' => 'session',
       'action'     => 'start',
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers',
    )
);

$router->add(
    '/session/logout[/]{0,1}',
    array(
       'controller' => 'session',
       'action'     => 'logout',
		'module'=>'frontend',
		'namespace'  => 'nltool\Modules\Modules\Frontend\Controllers',
    )
);



/*$router->add(
    '/session/:action[/]{0,1}',
    array(
       'controller' => 'session',
       'action'     => 1
    )
);*/

/*
$router->add(
    '/sitemap',
    array(
       'controller' => 'sitemap',
       'action'     => 'index'
    )
);

$router->add(
    '/help/stats',
    array(
       'controller' => 'help',
       'action'     => 'stats'
    )
);

$router->add(
    '/help/about',
    array(
       'controller' => 'help',
       'action'     => 'about'
    )
);

$router->add(
    '/help/moderators',
    array(
       'controller' => 'help',
       'action'     => 'moderators'
    )
);

$router->add(
    '/help/voting',
    array(
       'controller' => 'help',
       'action'     => 'voting'
    )
);

$router->add(
    '/help/markdown',
    array(
       'controller' => 'help',
       'action'     => 'markdown'
    )
);

$router->add(
    '/',
    array(
       'controller' => 'help',
       'action'     => 'karma'
    )
);

$router->add(
    '/compose/',
    array(
       'controller' => 'compose',
       'action'     => 'index'
    )
);

$router->add(
    '/index.html',
    array(
       'controller' => 'discussions',
       'action'     => 'index'
    )
);

$router->add(
    '/discussions',
    array(
       'controller' => 'discussions',
       'action'     => 'index'
    )
);

$router->add(
    '/hook/mail-bounce',
    array(
       'controller' => 'hooks',
       'action'     => 'mailBounce'
    )
);

$router->add(
    '/hook/mail-reply',
    array(
       'controller' => 'hooks',
       'action'     => 'mailReply'
    )
);

$router->add(
    '/search',
    array(
       'controller' => 'discussions',
       'action'     => 'search'
    )
);

$router->add(
    '/settings',
    array(
       'controller' => 'discussions',
       'action'     => 'settings'
    )
);

$router->add(
    '/reload-categories',
    array(
       'controller' => 'discussions',
       'action'     => 'reloadCategories'
    )
);

$router->addPost(
    '/preview',
    array(
       'controller' => 'utils',
       'action'     => 'preview'
    )
);

$router->add(
    '/reply/accept/{id:[0-9]+}',
    array(
       'controller' => 'replies',
       'action'     => 'accept'
    )
);

$router->add(
    '/reply/vote-up/{id:[0-9]+}',
    array(
       'controller' => 'replies',
       'action'     => 'voteUp'
    )
);

$router->add(
    '/reply/vote-down/{id:[0-9]+}',
    array(
       'controller' => 'replies',
       'action'     => 'voteDown'
    )
);

$router->add(
    '/reply/history/{id:[0-9]+}',
    array(
       'controller' => 'replies',
       'action'     => 'history'
    )
);

$router->add(
    '/discussion/history/{id:[0-9]+}',
    array(
       'controller' => 'discussions',
       'action'     => 'history'
    )
);

$router->add(
    '/discussion/vote-up/{id:[0-9]+}',
    array(
       'controller' => 'discussions',
       'action'     => 'voteUp'
    )
);

$router->add(
    '/discussion/vote-down/{id:[0-9]+}',
    array(
       'controller' => 'discussions',
       'action'     => 'voteDown'
    )
);

$router->add(
    '/login/oauth/authorize',
    array(
       'controller' => 'session',
       'action'     => 'authorize'
    )
);

$router->add(
    '/login/oauth/access_token/',
    array(
       'controller' => 'session',
       'action'     => 'accessToken'
    )
);

$router->add(
    '/login/oauth/access_token',
    array(
       'controller' => 'session',
       'action'     => 'accessToken'
    )
);

$router->add(
    '/logout',
    array(
       'controller' => 'session',
       'action'     => 'logout'
    )
);

$router->add(
    '/notifications',
    array(
       'controller' => 'discussions',
       'action'     => 'notifications'
    )
);

$router->add(
    '/activity',
    array(
       'controller' => 'discussions',
       'action'     => 'activity'
    )
);

$router->add(
    '/activity/irc',
    array(
       'controller' => 'discussions',
       'action'     => 'irc'
    )
);

$router->add(
    '/delete/discussion/{id:[0-9]+}',
    array(
       'controller' => 'discussions',
       'action'     => 'delete'
    )
);

$router->add(
    '/category/{id:[0-9]+}/{slug}/{offset:[0-9]+}',
    array(
       'controller' => 'discussions',
       'action'     => 'category'
    )
);

$router->add(
    '/post/discussion',
    array(
       'controller' => 'discussions',
       'action'     => 'create'
    )
);

$router->add(
    '/edit/discussion/{id:[0-9]+}',
    array(
       'controller' => 'discussions',
       'action'     => 'edit'
    )
);

$router->add(
    '/user/{id:[0-9]+}/{login}',
    array(
       'controller' => 'discussions',
       'action'     => 'user'
    )
);

$router->add(
    '/category/{id:[0-9]+}/{slug}',
    array(
       'controller' => 'discussions',
       'action'     => 'category'
    )
);

$router->add(
    '/reply/{id:[0-9]+}',
    array(
       'controller' => 'replies',
       'action'     => 'get'
    )
);

$router->add(
    '/reply/update',
    array(
       'controller' => 'replies',
       'action'     => 'update'
    )
);

$router->add(
    '/reply/delete/{id:[0-9]+}',
    array(
       'controller' => 'replies',
       'action'     => 'delete'
    )
);

$router->add(
    '/discussions/{order:[a-z]+}',
    array(
       'controller' => 'discussions',
       'action'     => 'index'
    )
);

$router->add(
    '/discussions/{order:[a-z]+}/{offset:[0-9]+}',
    array(
       'controller' => 'discussions',
       'action'     => 'index'
    )
);

$router->add(
    '/discussion/{id:[0-9]+}/{slug}',
    array(
       'controller' => 'discussions',
       'action'     => 'view'
    )
);

$router->add(
    '/',
    array(
       'controller' => 'index',
       'action'     => 'index'
    )
);*/


$router->handle();
return $router;