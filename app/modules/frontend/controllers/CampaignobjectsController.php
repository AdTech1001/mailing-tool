<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Mailobjects as Mailobjects,
	nltool\Models\Campaignobjects as Campaignobjects,	
	nltool\Models\Sendoutobjects as Sendoutobjects,
	nltool\Models\Addressconditions	as Addressconditions;

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
			$frozenSendoutobjects=  Sendoutobjects::find(array(
				"conditions" => "deleted=0 AND hidden =0 AND pid=0 AND campaignuid=?1 AND (cleared=1 OR inprogress=1 OR sent=1)",
				"bind" => array(1 => $this->request->getPost('campaignobjectuid'))
			));
			$frozenDomIds='[';
			foreach($frozenSendoutobjects as $frozenSendoutobject){
				$frozenDomIds.='"'.$frozenSendoutobject->domid.'",';
			}
			if(strlen($frozenDomIds)>1){
			$frozenDomIds=substr($frozenDomIds,0,-1);
			}
			$frozenDomIds.=']';
			$campaignobjectJson=
					'{"uid":'.$campaignobject->uid.',
					"title":"'.$campaignobject->title.'",
				"automationgraphstring":"'.$this->encodeURI($campaignobject->automationgraphstring).'",
				"connections":'.substr($campaignobject->connections,1,-1).','.
				'"frozensendoutobjects":'.$frozenDomIds.
					'}';
			
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
								
				$this->writeSendoutObjects($campaignobjectRecord);
				
				
				
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
		
		if($this->request->isPost()){
			$campaignObjectuid=$this->request->getPost('campaignobjectuid');
			$campaignobjectRecord = Campaignobjects::findFirst(array(
				"conditions" => "uid = ?1",
				"bind" => array(1 => $campaignObjectuid)
				));
			$campaignobjectRecord->assign(array(
				"tstamp" => time(),				
				"automationgraphstring"=>$this->request->getPost('htmlobjects'),
				'title'=>$this->request->getPost('title','striptags')== '' ? 'no name' : $this->request->getPost('title','striptags'),
				'connections'=>$this->request->getPost('connections','striptags'),
			));
			$campaignobjectRecord->update();			
			$this->removePreviousObjectsFromCampaign($campaignobjectRecord->uid);			
			$this->writeSendoutObjects($campaignobjectRecord);
			$this->view->disable();  
			
			die($campaignobjectRecord->uid);
			
		}else{
			$campaignObjectuid=$this->dispatcher->getParam("uid");
			$campaignobjectRecord = Campaignobjects::findFirst(array(
				"conditions" => "uid = ?1",
				"bind" => array(1 => $campaignObjectuid)
				));
			$this->view->setVar('campaignobjectUid',$campaignObjectuid);
			$this->view->setVar('campaignobjectTitle',$campaignobjectRecord->title);

			$this->assets->addJs('js/vendor/campaignInit.js');
			$this->assets->addCss('css/jquery.datetimepicker.css');
			$this->view->setVar('lang',$this->view->language);
		}
	}
	
	private function removePreviousObjectsFromCampaign($campaignobjectUid){
		$sendoutobjectRecords=  Sendoutobjects::find(array(
				"conditions" => "deleted = 0 AND hidden =0 AND inprogress=0 AND cleared=0 AND sent=0 AND campaignuid = ?1",
							"bind" => array(
								1 => $campaignobjectUid																
								)
			));
		foreach($sendoutobjectRecords as $sendoutobjectRecord){
			if($sendoutobjectRecord){
				$sendoutobjectRecord->deleted=1;
				$sendoutobjectRecord->hidden=1;				
				$sendoutobjectRecord->update();
				$addressconditions=$sendoutobjectRecord->getAddressconditions();
				if($addressconditions){
					foreach($addressconditions as $addresscondition){
						$addresscondition->deleted=1;
						$addresscondition->hidden=1;
						$addresscondition->update();
					}
				}
			}	
		}
			
	}
	
	private function writeSendoutObjects($campaignobjectRecord){
		$time=time();
		foreach($this->request->getPost('sendoutobjectelements') as $sendoutobjectElements){
					
					$rawArray=json_decode($sendoutobjectElements,true);					
					
					$rawdate=$rawArray['tstamp'];
					
					$dateArr=explode(' ',$rawdate);
					$senddate=0;
					if(is_array($dateArr)){
					$dateTimeArr=explode(':',$dateArr[1]);
					$dateDataArr=explode('/',$dateArr[0]);
					$senddate=mktime($dateTimeArr[0],$dateTimeArr[1],0,$dateDataArr[1],$dateDataArr[2],$dateDataArr[0]);
					}
					$sendoutobject=  Sendoutobjects::findFirst(array(
									"conditions" => "deleted=0 AND hidden=0 AND campaignuid = ?1 AND usergroup = ?2 AND domid LIKE ?3",
									"bind" => array(
											1 => $campaignobjectRecord->uid,
											2 => $this->session->get('auth')['usergroup'],
											3 => $rawArray['id']
										)
									));
					
					if(!$sendoutobject){
						$sendoutobject=new Sendoutobjects();
						$sendoutobject->assign(array(
							'pid'=>0,
							'crdate' => $time,
							'tstamp' => $senddate,
							'cruser_id' =>$this->session->get('auth')['uid'],
							'usergroup' =>$this->session->get('auth')['usergroup'],
							'deleted' =>0,
							'hidden' => 0,
							'reviewed'=>0,
							'cleared'=>0,
							'inprogress'=>0,
							'sent'=>0,
							'campaignuid'=>$campaignobjectRecord->uid,						
							'mailobjectuid'=>intval($rawArray['mailobjectuid']),
							'configurationuid'=>intval($rawArray['configurationuid']),
							'subject'=>$rawArray['subject'],
							'abtest'=>intval($rawArray['abtest']),
							'segmentobjectuid'=>intval($rawArray['segmentobjectuid']),
							'domid'=>$rawArray['id']

						));
						if(!$sendoutobject->save()){
							$this->flash->error($sendoutobject->getMessages());
						}
					}else{
						if($sendoutobject->cleared!=1 || $sendoutobject->sent!=1 || $sendoutobject->inprogress!=1){
							$sendoutobject->assign(array(							
								'tstamp' => $senddate,
								'cruser_id' =>$this->session->get('auth')['uid'],														
								'mailobjectuid'=>intval($rawArray['mailobjectuid']),
								'configurationuid'=>intval($rawArray['configurationuid']),
								'subject'=>$rawArray['subject'],
								'abtest'=>intval($rawArray['abtest']),
								'segmentobjectuid'=>intval($rawArray['segmentobjectuid'])							
							));
							if(!$sendoutobject->update()){
								$this->flash->error($sendoutobject->getMessages());
							}
						}

					}
					
					
					if($rawArray['abtest']==1){
						$rawdateB=$rawArray['tstampB'];
						
						$dateArrB=explode(' ',$rawdateB);
						$dateTimeArrB=explode(':',$dateArrB[1]);
						$dateDataArrB=explode('/',$dateArrB[0]);
						
						$sendoutobjectB=  Sendoutobjects::findFirst(array(
									"conditions" => "deleted=0 AND hidden=0 AND pid != 0 AND campaignuid = ?1 AND usergroup = ?2 AND domid = ?3",
									"bind" => array(
											1 => $campaignobjectRecord->uid,
											2 => $this->session->get('auth')['usergroup'],
											3 => $rawArray['id']
										)
									));
						
						if(!$sendoutobjectB){
							$sendoutobjectB=new Sendoutobjects();
							$sendoutobjectB->assign(array(
								'pid'=>$sendoutobject->uid,
								'crdate' => $time,
								'tstamp' => mktime($dateTimeArrB[0],$dateTimeArrB[1],0,$dateDataArrB[1],$dateDataArrB[2],$dateDataArrB[0]),
								'cruser_id' =>$this->session->get('auth')['uid'],
								'usergroup' =>$this->session->get('auth')['usergroup'],
								'deleted' =>0,
								'hidden' => 0,
								'reviewed'=>0,
								'cleared'=>0,
								'inprogress'=>0,
								'sent'=>0,
								'campaignuid'=>$campaignobjectRecord->uid,						
								'mailobjectuid'=>$rawArray['mailobjectB'],
								'configurationuid'=>$rawArray['configurationuidB'],
								'subject'=>$rawArray['subjectB'],
								'abtest'=>1,
								'segmentobjectuid'=>$sendoutobject->segmentobjectuid,
								'domid'=>$rawArray['id']

							));
							if(!$sendoutobjectB->save()){
								$this->flash->error($sendoutobjectB->getMessages());
							}
						}else{
							if($sendoutobjectB->cleared!=1 && $sendoutobjectB->sent!=1 && $sendoutobjectB->inprogress!=1){
								$sendoutobjectB->assign(array(							
									'tstamp' => $senddate,
									'cruser_id' =>$this->session->get('auth')['uid'],														
									'mailobjectuid'=>intval($rawArray['mailobjectB']),
									'configurationuid'=>intval($rawArray['configurationuidB']),
									'subject'=>$rawArray['subjectB'],
									'abtest'=>1,
									'segmentobjectuid'=>intval($rawArray['segmentobjectuid'])
								));
								if(!$sendoutobjectB->update()){
									$this->flash->error($sendoutobjectB->getMessages());
								}
							}
							
						}
					}
					
					if(isset($rawArray['conditions']) && $sendoutobject->cleared==0 && $sendoutobject->inprogress==0 && $sendoutobject->sent==0){
						
						$addressconditionsPrev=$sendoutobject->getAddressconditions();
							if($addressconditionsPrev){
								foreach($addressconditionsPrev as $addressconditionPrevEl){
									$addressconditionPrevEl->deleted=1;
									$addressconditionPrevEl->hidden=1;
									$addressconditionPrevEl->update();
								}
							}
						
						foreach($rawArray['conditions'] as $conditionArray){
							
							$addressconditions=new Addressconditions();				
							$addressconditions->assign(array(
								'pid'=>$sendoutobject->uid,
								'crdate'=>$time,
								'tstamp'=>$time,
								'cruser_id' =>$this->session->get('auth')['uid'],
								'usergroup' =>$this->session->get('auth')['usergroup'],
								'deleted' =>0,
								'hidden' => 0,
								'junctor' => intval($conditionArray[0]['value']),
								'conditionaloperator' => intval($conditionArray[1]['value']),
								'argument' => intval($conditionArray[2]['value']),
								'operator'=> intval($conditionArray[3]['value']),
								'argumentcondition' => $conditionArray[3]['value']
								
								
							));
							if(!$addressconditions->save()){
								$this->flash->error($addressconditions->getMessages());
							}
							
						}
					}
				}
	}
}