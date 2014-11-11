<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller as Controller,
	Phalcon\Mvc\Dispatcher,
	nltool\Models\Linklookup,
	nltool\Models\Linkclicks;


class LinkrefererController extends Controller
{
	
	
	public function beforeExecuteRoute(Dispatcher $dispatcher)
	{
			
			$time=time();
			$linklookupUid = $this->dispatcher->getParam("uid");
			$LinklookupRecord = Linklookup::findFirst(array(
			"conditions" => "uid = ?1",
			"bind" => array(1 => $linklookupUid)
			));
			
			header('Location: '.$LinklookupRecord->url); 
			$linkClick=new Linkclicks();
			$linkClick->assign(array(
				'pid' =>0,
				'deleted'=>0,
				'hidden' => 0,
				'tstamp' => $time,				
				'crdate' => $time,
				'linkuid' => $this->dispatcher->getParam("uid"),
				'addressuid' => $this->dispatcher->getParam("addressuid")
			));
			$linkClick->save();
			
			die();
			
	}
	public function indexAction(){
		
	}
}