<?php

namespace nltool\Modules\Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller as Controller,
	Phalcon\Mvc\Dispatcher;


class Triggerauth extends Controller
{
	
	
		public function beforeExecuteRoute(Dispatcher $dispatcher)
	{
			try {
				$params = $this->oauth->getParam(array('client_id', 'client_secret'));
				
				$result=$this->oauth->getGrantType('client_credentials')->completeFlow($params);
				
				
					
				
			} catch (\League\OAuth2\Server\Exception\ClientException $e) {
				
				echo $e->getMessage();
				$environment= $this->config['application']['debug'] ? 'development' : 'production';
				$baseUri=$this->config['application'][$environment]['staticBaseUri'];
				echo('<img src="'.$baseUri.'images/cowboy-shaking-head.gif" style="position:absolute;top:40%;left:40%;">');
				$this->response->sendHeaders();
				return false;
			} catch (\Exception $e) {
				
				echo $e->getTraceAsString();
				$this->response->sendHeaders();
				return false;
			}
			
			
	}
}