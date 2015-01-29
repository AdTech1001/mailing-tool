<?php

namespace nltool\Modules\Modules\Frontend\Controllers;

use nltool\Models\Campaignobjects,
	nltool\Models\Sendoutobjects,
	nltool\Models\Mailqueue;

/**
 * Class IndexController
 *
 * @package baywa-nltool\Controllers
 */
class ReportController extends ControllerBase
{

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function indexAction()
	{
		$action='index';
		if(!$this->dispatcher->getParam("uid")){
			
			$campaigns=  Campaignobjects::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));
			$reportableCampaigns=array();
			foreach($campaigns as $campaign){
				if($campaign->hasReportableSendoutobjects()){
					$reportableCampaigns[]=$campaign;
				}
			}
			
			
			$this->view->setVar('campaignobjects',$reportableCampaigns);
			$this->view->setVar('list',true);
		}else{
			
			$sendoutobjects=  Sendoutobjects::find(array(
				'conditions' => 'deleted=0 AND hidden=0 AND campaignuid=?1 AND (inprogress=1 OR sent = 1)',
				'bind'=>array(
					1=>$this->dispatcher->getParam("uid")
				)
			));
			$this->view->setVar('sendoutobjects',$sendoutobjects);
			$this->view->setVar('list',false);	
			$action='create';
		}
		
		$environment= $this->config['application']['debug'] ? 'development' : 'production';
		$baseUri=$this->config['application'][$environment]['staticBaseUri'];
		$path=$baseUri.$this->view->language.'/report/'.$action;
		$this->view->setVar('path',$path);
	}
	
	public function createAction(){
		$sendoutobject=  Sendoutobjects::findFirst(array(
			'conditions'=>'uid=?1',
			'bind'=>array(
				1=>$this->dispatcher->getParam("uid")
			)
		));
		$mailqueue=Mailqueue::find(array(
			'conditions' => 'sendoutobjectuid=?1 AND deleted=0 AND hidden=0',
			'bind' => array(
				1=>$sendoutobject->uid
			)
		));
		$sent=0;
		foreach($mailqueue as $mailqueueEl){
			if($mailqueueEl->sent==1){
				$sent++;
			}
		}
		$opened=$sendoutobject->countOpenclicks(array('group'=>'addressuid'));
		$clicked=$sendoutobject->countLinkclicks(array('group'=>'addressuid'));
		$linkClickCounts=$sendoutobject->countLinkclicks(array('group'=>'linkuid'));
		$clicks=$sendoutobject->getLinkclicks(array('group'=>'linkuid'));
		$clickArray=array();
		foreach($linkClickCounts as $linkClickCount){
			$clickArray[$linkClickCount->linkuid]=$linkClickCount->rowcount;
		}
		
		$this->view->setVar('clickcounts',$clickArray);
		$this->view->setVar('opened',count($opened));
		$this->view->setVar('clicked',count($clicked));
		$this->view->setVar('clicks',$clicks);
		$this->view->setVar('sendoutobject',$sendoutobject);
		$this->view->setVar('sent',$sent);
		$this->view->setVar('complete',count($mailqueue));
	}
}