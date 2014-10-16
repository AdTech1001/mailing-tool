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
        
		
		
		
		
    }
	
	public function createAction()
	{
		 if($this->request->isPost()){
			 
				$sendoutObjectsArray=array();
				$automationgraphString=$this->request->getPost('htmlobjects');
				$time=time();
				$counter=0;
				//die($automationgraphString);
				
				
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
				foreach($this->request->getPost('campaignobjectelements') as $sendoutobjectElements){
					$rawArray=json_decode($sendoutobjectElements);
					$sendoutobject=new Sendoutobjects();
					$rawdate=$rawArray['tstamp'];
					/*TODO DATE zerpflücken*/
					$dateArr=explode(' ',$rawdate);
					$sendoutobject->assign(array(
						'pid'=>0,
						'crdate' => $time,
						'tstamp' => $date,
						'cruser_id' =>$this->session->get('auth')['uid'],
						'usergroup' =>$this->session->get('auth')['usergroup'],
						'deleted' =>0,
						'hidden' => 0,
						'campaignuid'=>$campaignobjectRecord->uid,						
						'mailobjectuid'=>$this->request->getPost()
					));
					
					
				}
				die($campaignobjectRecord->uid);
				
				$this->view->disable();                       
				
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