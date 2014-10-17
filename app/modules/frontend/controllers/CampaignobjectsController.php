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
	function encodeURI($url) {
		// http://php.net/manual/en/function.rawurlencode.php
		// https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/encodeURI
		$unescaped = array(
			'%2D'=>'-','%5F'=>'_','%2E'=>'.','%21'=>'!', '%7E'=>'~',
			'%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')'
		);
		$reserved = array(
			'%3B'=>';','%2C'=>',','%2F'=>'/','%3F'=>'?','%3A'=>':',
			'%40'=>'@','%26'=>'&','%3D'=>'=','%2B'=>'+','%24'=>'$'
		);
		$score = array(
			'%23'=>'#'
		);
		return strtr(rawurlencode($url), array_merge($reserved,$unescaped,$score));

	}
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
				"automationgraphstring":"'.$this->encodeURI($campaignobject->automationgraphstring).'",
				"connections":'.substr($campaignobject->connections,1,-1).'}';
			
			die($campaignobjectJson);
			
		}else{
			$environment= $this->config['application']['debug'] ? 'development' : 'production';
			$baseUri=$this->config['application'][$environment]['staticBaseUri'];
			$path=$baseUri.$this->view->language.'/campaignobjects/update/';
			$campaignobjects=Campaignobjects::find(array(
					"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
					"bind" => array(1 => $this->session->get('auth')['usergroup']),
					"order" => "tstamp DESC"
				));

			$this->view->setVar('campaignobjects',$campaignobjects);
			$this->view->setVar('path',$path);
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
					$senddate=0;
					if(is_array($dateArr)){
					$dateTimeArr=explode(':',$dateArr[1]);
					$dateDataArr=explode('/',$dateArr[0]);
					$senddate=mktime($dateTimeArr[0],$dateTimeArr[1],0,$dateDataArr[1],$dateDataArr[2],$dateDataArr[0]);
					}
					$sendoutobject->assign(array(
						'pid'=>0,
						'crdate' => $time,
						'tstamp' => $senddate,
						'cruser_id' =>$this->session->get('auth')['uid'],
						'usergroup' =>$this->session->get('auth')['usergroup'],
						'deleted' =>0,
						'hidden' => 0,
						'campaignuid'=>$campaignobjectRecord->uid,						
						'mailobjectuid'=>intval($rawArray['mailobjectuid']),
						'configurationuid'=>intval($rawArray['configurationuid']),
						'subject'=>$rawArray['subject'],
						'abtest'=>intval($rawArray['abtest']),
						'segmentobjectuid'=>intval($rawArray['segmentobjectuid'])
							
					));
					if(!$sendoutobject->save()){
						$this->flash->error($sendoutobject->getMessages());
					}
					if($rawArray['abtest']==1){
						$rawdateB=$rawArray['tstampB'];
						
						$dateArrB=explode(' ',$rawdateB);
						$dateTimeArrB=explode(':',$dateArrB[1]);
						$dateDataArrB=explode('/',$dateArrB[0]);
						$sendoutobjectB=new Sendoutobjects();
						$sendoutobjectB->assign(array(
							'pid'=>$sendoutobject->uid,
							'crdate' => $time,
							'tstamp' => mktime($dateTimeArrB[0],$dateTimeArrB[1],0,$dateDataArrB[1],$dateDataArrB[2],$dateDataArrB[0]),
							'cruser_id' =>$this->session->get('auth')['uid'],
							'usergroup' =>$this->session->get('auth')['usergroup'],
							'deleted' =>0,
							'hidden' => 0,
							'campaignuid'=>$campaignobjectRecord->uid,						
							'mailobjectuid'=>$sendoutobject->mailobjectuid,
							'configurationuid'=>$rawArray['configurationuidB'],
							'subject'=>$rawArray['subjectB'],
							'abtest'=>1,
							'segmentobjectuid'=>$sendoutobject->segmentobjectuid

						));
						if(!$sendoutobjectB->save()){
							$this->flash->error($sendoutobjectB->getMessages());
						}
					}
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