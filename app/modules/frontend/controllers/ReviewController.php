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
			
			$environment= $this->config['application']['debug'] ? 'development' : 'production';
			$baseUri=$this->config['application'][$environment]['staticBaseUri'];
			$this->view->setVar('source',$baseUri.'mails/mailobject_'.$sendoutobject->mailobjectuid.'.html');
			$this->view->setVar('authorities',$authorities);
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
			
			if($this->sesseion->get('auth')['superuser']==1){
				if($this->request->getPost('reviewOverride')==true){
					$sendoutobject->assign(array(
						'reviewed'=>$this->request->getPost('reviewed')==true ? 1 :0
					));
					if(!$sendoutobject->update()){
						$this->flash->error($sendoutobject->getMessages());
						die();
					}else{			
						die(1);
					}
				}

				if($this->request->getPost('clearedanceOverride')==true){
					$sendoutobject->assign(array(
						'cleared'=>$this->request->getPost('cleared')==true ? 1 :0
					));
					if(!$sendoutobject->update()){
						$this->flash->error($sendoutobject->getMessages());
						
					}else{			
						
					}
				}					
			}
			
			if($this->request->getPost('reviewed')==true){
				$review=Review::findFirst(array(
					'conditions' =>'deleted=0 AND hidden=0 AND cruser_id = ?1 AND pid =?2',
					'bind' =>array(
						1=>$sendoutobject->uid,
						2=>$this->session->get('auth')['uid']
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
						'reviewed' => 1,
						'cleared' => 0
					));
					if(!$newReview->save()){
						$this->flash->error($newReview->getMessages());
						
					}
					
				}else{
					$review->assign(array(												
						'tstamp'=> time(),												
						'reviewed' => 1,
						'cleared' => 0
					));
					if(!$review->update()){
						$this->flash->error($review->getMessages());						
					}
				}
				
			}
			
			/*TODO das gleiche noch für clearance und dann checken, ob alle reviews versammelt sind und gegebenenfalls frei schalten*/
			
			
		}
		
	}
	
}	