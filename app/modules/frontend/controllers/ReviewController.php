<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Campaignobjects,
	nltool\Models\Sendoutobjects,
	nltool\Models\Review;	

/**
 * Class ReviewController
 *
 * @package baywa-nltool\Controllers
 */
class ReviewController extends ControllerBase
{
	
	function indexAction(){
		$environment= $this->config['application']['debug'] ? 'development' : 'production';
		$baseUri=$this->config['application'][$environment]['staticBaseUri'];
		$path=$baseUri.$this->view->language.'/review/update/';
		$sendoutobjects=  Sendoutobjects::find(array(
			'conditions'=>'deleted=0 AND hidden=0 AND usergroup=?1 AND sent=0 ',
			'bind' =>array(
				1 => $this->session->get('auth')['usergroup']
			),
			'order' => 'tstamp ASC'
		));
		
		$this->view->setVar('sendoutobjects',$sendoutobjects);
		$this->view->setVar('path',$path);
	}
	
	function updateAction(){
		$this->assets            
            ->addJs('js/vendor/reviewInit.js');
		if($this->dispatcher->getParam('uid') && !$this->request->isPost()){
			
			$sendoutobject=  Sendoutobjects::findFirst(array(
				'conditions'=>'uid = ?1',
				'bind' => array(
					1 => $this->dispatcher->getParam('uid')
				)
			));
			
			$configuration=$sendoutobject->getConfiguration();
			$authorities=$configuration->getAuthorities();
			$reviews=$sendoutobject->getReview();
			$reviewArray=array();
			foreach($reviews as $review){				
					$reviewArray[$review->cruser_id]=$review;				
			}
			$authorityArray=array();
			
			foreach($authorities as $authority){
				$authorityArray[$authority->uid]=$authority;
				$authorityArray[$authority->uid]->reviewed=null;
				$authorityArray[$authority->uid]->cleared=null;
				if(isset($reviewArray[$authority->uid])){
					if($reviewArray[$authority->uid]->reviewed==1){
						$authorityArray[$authority->uid]->reviewed=true;
					}
					if($reviewArray[$authority->uid]->cleared){
						$authorityArray[$authority->uid]->cleared=true;
					}
				}
			}
			$environment= $this->config['application']['debug'] ? 'development' : 'production';
			$baseUri=$this->config['application'][$environment]['staticBaseUri'];
			$this->view->setVar('source',$baseUri.'mails/mailobject_'.$sendoutobject->mailobjectuid.'.html');
			$this->view->setVar('authorities',$authorityArray);
			$this->view->setVar('reviews',$reviewArray);
			$this->view->setVar('userUid',$this->session->get('auth')['uid']);
			$this->view->setVar('reviewChecked',$sendoutobject->reviewed==1 ? 'checked':null);
			$this->view->setVar('clearedChecked',$sendoutobject->cleared==1 ? 'checked':null);
			$this->view->setVar('sendoutobject',$sendoutobject);
			$this->view->setVar('disabled',$this->session->get('auth')['superuser']==1 ? false : true);
		}else if($this->request->isPost()){
			
			$sendoutobject=  Sendoutobjects::findFirst(array(
				"conditions"=>"uid=?1",
				"bind"=>array(
					1=>$this->request->getPost('sendoutobjectuid')
				)
			));
			
			if($this->session->get('auth')['superuser']==1){
				if($this->request->getPost('reviewOverride')=='true'){
					
					$sendoutobject->assign(array(
						'reviewed'=>$this->request->getPost('reviewOverride')=='true' ? 1 :0
					));
					if(!$sendoutobject->update()){
						$this->flash->error($sendoutobject->getMessages());
						die();
					}else{			
						die(1);
					}
				}

				if($this->request->getPost('clearanceOverride')=='true'){
					$sendoutobject->assign(array(
						'cleared'=>$this->request->getPost('cleared')=='true' ? 1 :0
					));
					if(!$sendoutobject->update()){
						$this->flash->error($sendoutobject->getMessages());
						die();
					}else{			
						die(1);
					}
				}					
			}
			
			if($this->request->hasPost('reviewed')){
				$review=Review::findFirst(array(
					'conditions' =>'deleted=0 AND hidden=0 AND cruser_id = ?1 AND pid =?2',
					'bind' =>array(
						1=>$this->session->get('auth')['uid'],
						2=>$sendoutobject->uid
					)
				));
				if(!$review){
					$newReview=new Review();
					$newReview->assign(array(
						'pid' => $sendoutobject->uid,
						'tstamp'=>time(),
						'crdate' => time(),
						'cruser_id' => $this->session->get('auth')['uid'],
						'deleted' =>0,
						'hidden' => 0,
						'reviewed' => $this->request->getPost('reviewed')=='true' ? 1 : 0,
						'cleared' => 0
					));
					if(!$newReview->save()){
						$this->flash->error($newReview->getMessages());
						die();
					}else{
						$allclear=$this->checkAllReviewed($sendoutobject);
						if($allclear){
							$this->reviewSendoutobject($sendoutobject);
							die('allrevsclear');
						}else{
							die(1);
						}
					}
					
				}else{
					$review->assign(array(												
						'tstamp'=> time(),												
						'reviewed' => $this->request->getPost('reviewed')=='true' ? 1 : 0
					));
					if(!$review->update()){
						$this->flash->error($review->getMessages());						
						die();
					}else{
						$allclear=$this->checkAllReviewed($sendoutobject);
						if($allclear){
							$this->reviewSendoutobject($sendoutobject);
							die('allrevsclear');
						}else{
							die(1);
						}
					}
				}
				
			}
			
			/*TODO das gleiche noch für clearance und dann checken, ob alle reviews versammelt sind und gegebenenfalls frei schalten*/
			
			if($this->request->hasPost('cleared')){
				$clearance=Review::findFirst(array(
					'conditions' => 'deleted=0 AND hidden=0 AND cruser_id=?1 AND pid =?2',
					'bind'=> array(
						1=>$this->session->get('auth')['uid'],
						2=>$sendoutobject->uid
						
					)
				));
				if(!$clearance){
					$newReview=new Review();
					$newReview->assign(array(
						'pid' => $sendoutobject->uid,
						'tstamp'=>time(),
						'crdate' => time(),
						'cruser_id' => $this->session->get('auth')['uid'],
						'deleted' =>0,
						'hidden' => 0,
						'reviewed' => 0,
						'cleared' => $this->request->getPost('cleared')=='true' ? 1 : 0
					));
					if(!$newReview->save()){
						$this->flash->error($newReview->getMessages());
						die();
					}else{
						$allclear=$this->checkAllCleared($sendoutobject);
						if($allclear){
							$this->clearSendoutobject($sendoutobject);
							die('allclearclear');
						}else{
							die(1);
						}		
					}
				}else{
					
					$clearance->assign(array(
						'tstamp'=> time(),																		
						'cleared' => $this->request->getPost('cleared')=='true' ? 1 : 0
					));
					
					if(!$clearance->update()){
						$this->flash->error($clearance->getMessages());												
						die();
					}else{
						$allclear=$this->checkAllCleared($sendoutobject);
						if($allclear){
							$this->clearSendoutobject($sendoutobject);
							die('allclearclear');
						}else{
							die(1);
						}						
					}
				}
			}
			
		}
		
	}
	
	private function reviewSendoutobject($sendoutobject){
		$sendoutobject->assign(array(
						'reviewed'=>1
						
					));
		$sendoutobject->update();
	}
	
	private function clearSendoutobject($sendoutobject){
		$sendoutobject->assign(array(
						'cleared'=>1
						
					));
		$sendoutobject->update();
	}
	
	private function checkAllReviewed($sendoutobject){
		$returnVal=true;
		$configuration=$sendoutobject->getConfiguration();
		$authorities=$configuration->getAuthorities();
		
		$reviews=$sendoutobject->getReview();
		$userArray=array();
		foreach($reviews as $review){
			if($review->reviewed==1){
				$userArray[]=$review->cruser_id;
			}
		}		
		foreach($authorities as $authority){
			if(!in_array($authority->uid, $userArray)){
				$returnVal=false;
				break;
			}
		}
		return $returnVal;
	}
	
	private function checkAllCleared($sendoutobject){
		$returnVal=true;
		$configuration=$sendoutobject->getConfiguration();
		$authorities=$configuration->getAuthorities();
		
		$reviews=$sendoutobject->getReview();
		$userArray=array();
		foreach($reviews as $review){
			if($review->reviewed==1 && $review->cleared==1){
				$userArray[]=$review->cruser_id;
			}
		}		
		foreach($authorities as $authority){
			if(!in_array($authority->uid, $userArray)){
				$returnVal=false;
				break;
			}
		}
		return $returnVal;
	}
	
}	