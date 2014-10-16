<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Mailobjects as Mailobjects,
	nltool\Models\Campaignobjects as Campaignobjects,	
	nltool\Models\Sendoutobjects as Sendoutobjects;

/**
 * Class IndexController
 *
 * @package baywa-nltool\Controllers
 */
class CampaignobjectsController extends ControllerBase
{

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function indexAction()
    {
        //$this->flashSession->error('Page not found: ' . $this->escaper->escapeHtml($this->router->getRewriteUri()));
        
		if($this->request->isPost() && $this->request->getPost('campaignobjectuid')!=0){
			
			$campaignobject = Campaignobjects::findFirst(array(
			"conditions" => "uid = ?1",
			"bind" => array(1 => $this->request->getPost('campaignobjectuid'))
			));
			
			$campaignobjectJson=
					'{"uid":'.$campaignobject->uid.',
					"title":"'.$campaignobject->title.'",
				"automationgraphstring":"'.rawurlencode($campaignobject->automationgraphstring).'",
				"connections":'.$campaignobject->connections.'}';
			
			die($campaignobjectJson);
			
		}
		
		
		
    }
	
	public function createAction()
	{
		 if($this->request->isPost() && $this->request->getPost('campaignobjectuid')==0 ){
			 
				
				$automationgraphString=$this->request->getPost('htmlobjects');
				$time=time();												
				
				$campaignobjectRecord=new Campaignobjects();
				$campaignobjectRecord->assign(array(
					'pid'=>0,
					'crdate' => $time,
					'tstamp' => $time,
					'cruser_id' =>$this->session->get('auth')['uid'],
					'usergroup' =>$this->session->get('auth')['usergroup'],
					'deleted' =>0,
					'hidden' => 0,
					'title'=>$this->request->getPost('title','striptags')== '' ? 'no name' : $this->request->getPost('title','striptags'),
					'connections'=>$this->request->getPost('connections','striptags'),
					'automationgraphstring' =>$automationgraphString
				));
				if (!$campaignobjectRecord->save()) {
					$this->flash->error($campaignobjectRecord->getMessages());
				}
				//TODO Conditions für Sendoutobjects ablegen
				foreach($this->request->getPost('sendoutobjectelements') as $sendoutobjectElements){
					$rawArray=json_decode($sendoutobjectElements,true);
					$sendoutobject=new Sendoutobjects();
					$rawdate=$rawArray['tstamp'];
					
					$dateArr=explode(' ',$rawdate);
					$dateTimeArr=explode(':',$rawdate[1]);
					$dateDataArr=explode('/',$rawdate[0]);
					$sendoutobject->assign(array(
						'pid'=>0,
						'crdate' => $time,
						'tstamp' => mktime($dateTimeArr[0],$dateTimeArr[1],0,$dateDataArr[1],$dateDataArr[2],$dateDataArr[0]),
						'cruser_id' =>$this->session->get('auth')['uid'],
						'usergroup' =>$this->session->get('auth')['usergroup'],
						'deleted' =>0,
						'hidden' => 0,
						'campaignuid'=>$campaignobjectRecord->uid,						
						'mailobjectuid'=>$rawArray['mailobjectuid'],
						'configurationuid'=>$rawArray['configurationuid'],
						'subject'=>$rawArray['subject']
							
					));
					
					
				}
				if(!$sendoutobject->save()){
					$this->flash->error($sendoutobject->getMessages());
				}
				die($campaignobjectRecord->uid);
				
				$this->view->disable();                       
				
		 }elseif($this->request->isPost() && $this->request->getPost('campaignobjectuid')!=0 ){
			 /*UPDATE FUNCTIONality*/
		 }else{
			$this->assets->addJs('js/vendor/campaignInit.js');
			$this->assets->addCss('css/jquery.datetimepicker.css');
			$this->view->setVar('lang',$this->view->language);
		 }
	}
	
	public function updateAction(){
		$campaignObjectuid=$this->dispatcher->getParam("uid");
		$this->view->setVar('campaignobjectUid',$campaignObjectuid);
		$this->assets->addJs('js/vendor/campaignInit.js');
			$this->assets->addCss('css/jquery.datetimepicker.css');
			$this->view->setVar('lang',$this->view->language);
	}
}