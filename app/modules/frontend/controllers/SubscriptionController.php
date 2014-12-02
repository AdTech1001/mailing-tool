<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Addresses as Addresses;
use Phalcon\Mvc\Controller as Controller;
/**
 * Class SubscriptionController
 *
 * @package baywa-nltool\Controllers
 */

class SubscriptionController extends Controller

{
	public function indexAction(){
		
	}
	
	public function updateAction(){
		
	}
	
	public function unsubscribeAction(){
		$this->view->setMainView('baywa');
		$mailaddress=explode('/',$this->dispatcher->getParam('email'));
		
		if(count($mailaddress)>2){
			
		$address=  Addresses::findFirst(array(
				'conditions'=>'email LIKE ?1 AND uid = ?2',
				'bind'=>array(
					1=>$mailaddress[1],
					2=>$mailaddress[2]
				)
				));
		}else{
			$address=false;
		}
		
		$this->view->setVar('unsubscribe',false);
		if($address){
			 $address->deleted=1;
			 $address->hidden =1;
					
			 if (!$address->save()) {
			 $this->flash->error($address->getMessages());
			 
			 }else{
				 $this->view->setVar('unsubscribe',true);
			 }
		}
		
	}
}