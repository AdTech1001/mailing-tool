<?php

namespace nltool\Modules\Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller as Controller,
	Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class Triggerauth extends Controller
{
	
	
		public function beforeExecuteRoute(Dispatcher $dispatcher)
	{
			try {
				$params = $this->oauth->getParam(array('client_id', 'client_secret'));
				
				$result=$this->oauth->getGrantType('client_credentials')->completeFlow($params);
				
				var_dump($result);
					
				
			} catch (\League\OAuth2\Server\Exception\ClientException $e) {
				
				echo $e->getMessage();
				$this->response->sendHeaders();
				return false;
			} catch (\Exception $e) {
				
				echo $e->getTraceAsString();
				$this->response->sendHeaders();
				return false;
			}
			
			
	}
}