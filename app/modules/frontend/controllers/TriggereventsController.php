<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Sendoutobjects,
	nltool\Models\Triggerevents,
	nltool\Models\Mailobjects,
	nltool\Models\Configurationobjects,
	nltool\Models\Distributors,
	nltool\Models\Addressfolders;

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
		if($this->request->isPost()){
			$time = time();
			$triggerevent=new Triggerevents();
			$triggerevent->assign(array(
				'pid' => 0,
				'tstamp' => $time,
				'crdate' => $time,
				'deleted' => 0,
				'hidden' => 0,
				'eventtype' => $this->request->hasPost('eventtype') ? $this->request->getPost('eventtype') : 0,
				'title' => $this->request->hasPost('title') ? $this->request->getPost('title') : 0,
				'repetitive' => $this->request->hasPost('repetetive') ? $this->request->getPost('repetetive') : 0,
				'repeatcycle' => $this->request->hasPost('repeatcycle') ? $this->request->getPost('repeatcycle') : 0,
				'repeatcycletime' => $this->request->hasPost('repeatcycletime') ? $this->request->getPost('repeatcycletime') : 0,
				'reviewed' => 0,
				'cleared' => 0,
				'inprogress' => 0,
				'usergroup' => $this->session->get('auth')['usergroup'],
				'mailobjectuid' => $this->request->hasPost('mailobject') ? $this->request->getPost('mailobject') : 0,
				'configurationuid' => $this->request->hasPost('configurationsobject') ? $this->request->getPost('configurationsobject') : 0,
				'subject' => $this->request->hasPost('subject') ? $this->request->getPost('subject') : 0,
				'distributoruid' => $this->request->hasPost('addresslistobject') ? $this->request->getPost('addresslistobject') : 0,
				'cruser_id' => $this->session->get('auth')['usergroup'],
				'addressfolder' => $this->request->hasPost('addressfolder') ? $this->request->getPost('addressfolder') : 0
			));
			
			if(!$triggerevent->save()){
				$this->flash->error($triggerevent->getMessages());
			}else{
				$this->flash->success("Triggerevent was created successfully");
			}
		}
		
		
		$environment= $this->config['application']['debug'] ? 'development' : 'production';
		$baseUri=$this->config['application'][$environment]['staticBaseUri'];
		$path=$baseUri.$this->view->language;
		
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
		
		$addressfolders = Addressfolders::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));
		
		$this->view->setVar("eventtypes",$this->events);
		$this->view->setVar("mailobjects",$mailobjects);
		$this->view->setVar("configurationsobjects",$configurationsobjects);
		$this->view->setVar("addresslistobjects",$addresslistobjects);
		$this->view->setVar("addressfolders",$addressfolders);
		$this->view->setVar('path',$path);
		
	}
	
	

}