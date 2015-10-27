<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Sendoutobjects,
	nltool\Models\Triggerevents;

/**
 * Class IndexController
 *
 * @package baywa-nltool\Controllers
 */
class TriggereventsController extends ControllerBase
{
	public function indexAction()
	{
		$environment= $this->config['application']['debug'] ? 'development' : 'production';
		$baseUri=$this->config['application'][$environment]['staticBaseUri'];
		$path=$baseUri.$this->view->language.'/triggerevents/update/';
		$triggerevents=Triggerevents::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));

		$this->view->setVar('triggerevents',$triggerevents);
		$this->view->setVar('path',$path);
		
	}
	
	public function createAction()
	{
		
	}

}