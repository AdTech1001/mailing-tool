<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use Phalcon\Events\EventsAwareInterface;
use Phalcon\Events\ManagerInterface;
use nltool\Models\Addresses as Addresses,
	nltool\Models\Subscriptionobjects,
	nltool\Models\Feusers,
	nltool\Models\Addresses_feuserscategories_lookup;
/**
 * Class SubscriptionController
 *
 * @package baywa-nltool\Controllers
 */

class SubscriptionController extends ControllerBase implements EventsAwareInterface
{
	protected $_eventsManager;

    public function setEventsManager( \Phalcon\Events\ManagerInterface $eventsManager)
    {
        $this->_eventsManager = $eventsManager;
    }

    public function getEventsManager()
    {
        return $this->_eventsManager;
    }

	
	public function indexAction(){
		
		
	}
	
	public function updateAction(){
		
	}
	
	public function unsubscribeAction(){
	
		$this->view->setTemplateAfter('subscribe');
		
		$mailaddress=$this->request->getQuery('email','email');
		$userUid=$this->request->getQuery('id','int');
		if($mailaddress && $userUid){
			
		$address=  Addresses::findFirst(array(
				'conditions'=>'email LIKE ?1 AND uid = ?2',
				'bind'=>array(
					1=>$mailaddress,
					2=>$userUid
				)
				));
		}else{
			$address=false;
		}
		
		$this->view->setVar('unsubscribe',false);
		if($address){
                        $address->tstamp=time();
			 $address->deleted=1;
			 $address->hidden =1;
					
			 if (!$address->save()) {
			 $this->flash->error($address->getMessages());
			 
			 }else{
				$this->view->setVar('unsubscribe',true);				
				$this->triggerevents->fire("SubscriptionController:subscriptionEventHandler", $address);
			 }
		}
		
		
		
	}
	public function subscribeAction(){
		$this->view->setMainView('basic');
		$this->view->setTemplateAfter('subscribe');
		
		
		if($this->request->isPost()){
			
			$this->view->pick('subscription/thankyou');
			$time=time();
			$salutation='';
			if($this->request->hasPost('salutation')){
				$salutation=$this->request->getPost('salutation')==0 ? $this->translate('salutation.female') : $this->translate('salutation.male');
                        }
			
			$address = new Addresses();			
			$address->assign(array(
				'pid' => $this->request->hasPost('addressfolder') ? $this->request->getPost('addressfolder') : 0,
				'crdate' => $time,
				'tstamp' => $time,
				'cruser_id' =>0,
				'deleted' => 0,
				'hidden' => 0,
				'usergroup' =>0,
				'first_name' => $this->request->hasPost('firstname') ? $this->request->getPost('firstname') : '',
				'last_name' => $this->request->hasPost('lastname') ? $this->request->getPost('lastname') : '',
				'salutation' => $salutation,
				'title' => $this->request->hasPost('title') ? $this->request->getPost('title') : '',
				'email' => $this->request->hasPost('email') ? $this->request->getPost('email') : '',
				'phone' => $this->request->hasPost('phone') ? $this->request->getPost('phone') : '',
				'address' => $this->request->hasPost('address') ? $this->request->getPost('address') : '',
				'city' => $this->request->hasPost('city') ? $this->request->getPost('city') : '',
				'company' => $this->request->hasPost('company') ? $this->request->getPost('company') : '',
				'zip' => $this->request->hasPost('zip') ? $this->request->getPost('zip') : 0,
				'region' => $this->request->hasPost('region') ? $this->request->getPost('region') : 0,
				'province' => $this->request->hasPost('province') ? $this->request->getPost('province') : 0,
				'userlanguage' => $this->language[$this->view->language],
				'gender' => $this->request->hasPost('salutation') ? $this->request->getPost('salutation') : 0,
				'formal' => 1,
				'hashtags' => '',
				'itemsource' => 'tool',
                                'birthday' => $this->request->hasPost('birthday') ? $this->request->getPost('birthday') : 0,
				'hasprofile' => 0
			));
			if (!$address->save()) {
                            $this->flash->error($subscriptionobject->getMessages());
			}else{
				
				$this->triggerevents->fire("SubscriptionController:subscriptionEventHandler", $address);
			}
			if($this->request->hasPost('feusercategories')){
				foreach($this->request->getPost('feusercategories') as $feusercategoryId){
					$addCatLookupEntry=new Addresses_feuserscategories_lookup();
					$addCatLookupEntry->assign(array(
						'deleted' => 0,
						'uid_local' => $address->uid,
						'uid_foreign' => $feusercategoryId
					));
					$addCatLookupEntry->save();
				}
			}
			
		}else{				
			$environment= $this->config['application']['debug'] ? 'development' : 'production';
			$baseUri=$this->config['application'][$environment]['staticBaseUri'];		
			$path=$baseUri.$this->view->language;			


			$subscriptionobject=  Subscriptionobjects::findFirstByUid($this->dispatcher->getParam('uid'));
                        
			$feuserscategories=$subscriptionobject->getFeuserscategories();
                        
                        $css= $subscriptionobject->placeholder == 1 ? 'label{display:none;}'.PHP_EOL : '';
                        $this->view->setVar('css',$css.$subscriptionobject->css);
			$this->view->setVar('path',$path);
			$this->view->setVar('feuserscategories',$feuserscategories);
			$this->view->setVar('subscriptionobject',$subscriptionobject);
                        $this->view->setVar('addressfields',explode(',',$subscriptionobject->addressfields));
			
			
		}
		
	}
	
	
}