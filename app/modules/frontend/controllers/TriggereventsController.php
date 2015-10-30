<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Sendoutobjects,
	nltool\Models\Triggerevents,
	nltool\Models\Mailobjects,
	nltool\Models\Configurationobjects,
	nltool\Models\Distributors;

/**
 * Class IndexController
 *
 * @package baywa-nltool\Controllers
 */
class TriggereventsController extends ControllerBase
{
	private $events=array(
		1 => 'date',
		2 => 'recursive',
		3 => 'birthday',
		4 => 'subscribe',
		5 => 'unsubscribe'
	);
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
		$mailobjects = Mailobjects::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));
		
		$configurationsobjects = Configurationobjects::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));
		
		$addresslistobjects = Distributors::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));
		
		$this->view->setVar("eventtypes",$this->events);
		$this->view->setVar("mailobjects",$mailobjects);
		$this->view->setVar("configurationsobjects",$configurationsobjects);
		$this->view->setVar("addresslistobjects",$addresslistobjects);
		
	}
	
	public function unsubscribeListener($event,$subscription)
	{
		var_dump($event);
	}

}