<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Feuserscategories,
	nltool\Models\Subscriptionobjects,
	nltool\Models\Addressfolders,
	nltool\Models\Subscriptionobjects_feuserscategories_lookup;
/**
 * Class FeusersController
 *
 * @package baywa-nltool\Controllers
 */

class SubscriptionobjectsController extends ControllerBase

{
    private $addressfieldmap=array(
        0 => 'firstname',
        1 => 'lastname',
        2 => 'salutation',
        3 => 'title',
        4 => 'email',
        5 => 'phone',
        6 => 'address',
        7 => 'city',
        8 => 'company',
        9 => 'zip',
        10 => 'region',
        11 => 'province',
        12 => 'userlanguage',
        13 => 'gender',
        14 => 'birthday'
    );
    
	public function indexAction()
	{
		$subscriptionobjects = Subscriptionobjects::find(array(
			'conditions' => 'deleted=0 AND hidden=0 AND usergroup = ?1',
			'bind' => array(
				1 => $this->session->get('auth')['usergroup']
			)
		));
		$environment= $this->config['application']['debug'] ? 'development' : 'production';
		$baseUri=$this->config['application'][$environment]['staticBaseUri'];
		$path=$baseUri.$this->view->language;		
		
		$this->view->setVar('path',$path);
		$this->view->setVar('subscriptionobjects',$subscriptionobjects);
		
	}
	
	public function createAction()			
	{
		$this->assets->addJs('js/vendor/subscriptionobjectsInit.js');
		$feuserscategories = Feuserscategories::find(array(
			'conditions' => 'deleted=0 AND hidden=0 AND usergroup = ?1',
			'bind' => array(
				1 => $this->session->get('auth')['usergroup']
			)
		));
		$addressfolders=Addressfolders::find(array(
			'conditions' => 'deleted=0 AND hidden=0 AND usergroup = ?1',
			'bind' => array(
				1 => $this->session->get('auth')['usergroup']
			)
		));
		
		$environment= $this->config['application']['debug'] ? 'development' : 'production';
		$baseUri=$this->config['application'][$environment]['staticBaseUri'];
		$path=$baseUri.$this->view->language;		
		
		$this->view->setVar('feuserscategories',$feuserscategories);
		$this->view->setVar('addressfolders',$addressfolders);
                $this->view->setVar('addressfields',$this->addressfieldmap);
		$this->view->setVar('path',$path);
		
		if($this->request->isPost()){
			$time=time();
                        $addressfields='';
                        if($this->request->hasPost('addressfields')){
                            
                                $addressfields =implode(',',$this->request->getPost('addressfields')) ;
                            
                        }
			$subscriptionobject=new Subscriptionobjects();
			$subscriptionobject->assign(array(
                                'pid' => 0,
				'tstamp' => $time,
				'crdate' => $time,
				'deleted' => 0,
				'hidden' => 0,
				'usergroup' => $this->session->get('auth')['usergroup'],
				'cruser_id' => $this->session->get('auth')['uid'],
				'title' => $this->request->hasPost('title') ? $this->request->getPost('title') : '',
				'addressfolder' => $this->request->hasPost('addressfolder') ? $this->request->getPost('addressfolder') : 0,
                                'addressfields' => $addressfields,
                                'css' => $this->request->hasPost('css') ? $this->request->getPost('css') : '',
                                'placeholder' => $this->request->hasPost('placeholder') ? $this->request->getPost('placeholder') : 0
			));
			if (!$subscriptionobject->save()) {
                            $this->flashSession->error($subscriptionobject->getMessages());
			}else{
                            $this->flashSession->success("Created successfully");
				if($this->request->hasPost('feuserscategories')){
					foreach($this->request->getPost('feuserscategories') as $addressfolderUid){
						$subscrAddrfolderLookup=new Subscriptionobjects_feuserscategories_lookup();
						$subscrAddrfolderLookup->assign(array(
							'deleted' => 0,
							'uid_local' => $subscriptionobject->uid,
							'uid_foreign' => $addressfolderUid
						));
						$subscrAddrfolderLookup->save();
					}
				}
				
				if($this->request->hasPost('newfeuserscategories')){
					foreach($this->request->getPost('newfeuserscategories') as $newFolderTitle){
						if($newFolderTitle != ''){
							$newFolder=new Feuserscategories();
							$newFolder->assign(array(
								'pid'=>0,
								'deleted'=>0,
								'hidden'=>0,
								'tstamp'=>$time,
								'crdate'=>$time,
								'cruser_id' => $this->session->get('auth')['uid'],
								'usergroup' => $this->session->get('auth')['usergroup'],
								'title'=>$newFolderTitle							
							));
							$newFolder->save();
							$subscrAddrfolderLookup=new Subscriptionobjects_feuserscategories_lookup();
							$subscrAddrfolderLookup->assign(array(
								'deleted' => 0,
								'uid_local' => $subscriptionobject->uid,
								'uid_foreign' => $newFolder->uid
							));
							$subscrAddrfolderLookup->save();
						}
					}
				}
			}		
		}		
	}
	
	
	public function updateAction()			
	{
		$subscriptionobjUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
		$subscriptionobj=Subscriptionobjects::findFirst(array(
				'conditions' => 'uid = ?1',
				'bind' => array(
					1=>$subscriptionobjUid
				)
			));
		
		$this->assets->addJs('js/vendor/subscriptionobjectsInit.js');
		
		$environment= $this->config['application']['debug'] ? 'development' : 'production';
		$baseUri=$this->config['application'][$environment]['staticBaseUri'];
		$path=$baseUri.$this->view->language;		
		
		$feuserscategories = Feuserscategories::find(array(
			'conditions' => 'deleted=0 AND hidden=0 AND usergroup = ?1',
			'bind' => array(
				1 => $this->session->get('auth')['usergroup']
			)
		));
		$addressfolders=Addressfolders::find(array(
			'conditions' => 'deleted=0 AND hidden=0 AND usergroup = ?1',
			'bind' => array(
				1 => $this->session->get('auth')['usergroup']
			)
		));
		
		$feuserscategoryArray = array();
		$subsCats=$subscriptionobj->getFeuserscategories();
		foreach($subsCats as $subsCat){
			$feuserscategoryArray[] = $subsCat->uid;
		}
		
		if($this->request->isPost()){
                    if($this->request->hasPost('addressfields')){
                            
                                $addressfields =implode(',',$this->request->getPost('addressfields')) ;
                            
                        }
			$subscrAddrfolderLookups= Subscriptionobjects_feuserscategories_lookup::find(array(
				'conditions' => 'uid_local = ?1',
				'bind' => array(
					1 => $this->request->hasPost('uid') ? $this->request->getPost('uid') : 0
				)
			));
			foreach($subscrAddrfolderLookups as $subscrAddrfolderLookup){
				$subscrAddrfolderLookup->delete();
			}
			
			$time=time();
			
			$subscriptionobj->assign(array(
				'tstamp' => $time,								
				'usergroup' => $this->session->get('auth')['usergroup'],
				'cruser_id' => $this->session->get('auth')['uid'],
				'title' => $this->request->hasPost('title') ? $this->request->getPost('title') : '',
				'addressfolder' => $this->request->hasPost('addressfolder') ? $this->request->getPost('addressfolder') : 0,
                                'addressfields' => $addressfields,
                            'css' => $this->request->hasPost('css') ? $this->request->getPost('css') : '',
                                'placeholder' => $this->request->hasPost('placeholder') ? $this->request->getPost('placeholder') : 0
			));
			if (!$subscriptionobj->update()) {
                $this->flash->error($subscriptionobj->getMessages());
			}else{
				if($this->request->hasPost('feuserscategories')){
					foreach($this->request->getPost('feuserscategories') as $addressfolderUid){
						$subscrAddrfolderLookup=new Subscriptionobjects_feuserscategories_lookup();
						$subscrAddrfolderLookup->assign(array(
							'deleted' => 0,
							'uid_local' => $subscriptionobj->uid,
							'uid_foreign' => $addressfolderUid
						));
						$subscrAddrfolderLookup->save();
					}
				}
				
				if($this->request->hasPost('newfeuserscategories')){
					foreach($this->request->getPost('newfeuserscategories') as $newFolderTitle){
						if($newFolderTitle != ''){
							$newFolder=new Feuserscategories();
							$newFolder->assign(array(
								'pid'=>0,
								'deleted'=>0,
								'hidden'=>0,
								'tstamp'=>$time,
								'crdate'=>$time,
								'cruser_id' => $this->session->get('auth')['uid'],
								'usergroup' => $this->session->get('auth')['usergroup'],
								'title'=>$newFolderTitle							
							));
							$newFolder->save();
							$subscrAddrfolderLookup=new Subscriptionobjects_feuserscategories_lookup();
							$subscrAddrfolderLookup->assign(array(
								'deleted' => 0,
								'uid_local' => $subscriptionobj->uid,
								'uid_foreign' => $newFolder->uid
							));
							$subscrAddrfolderLookup->save();
						}
					}
				}
			}

		}
		$this->view->setVar('addressfields',$this->addressfieldmap);
                $this->view->setVar('addressfieldsArr',explode(',',$subscriptionobj->addressfields));
		$this->view->setVar('source','http://'.$this->request->getHttpHost());
		$this->view->setVar('feuserscategoryArray',$feuserscategoryArray);
		$this->view->setVar('subscriptionobject',$subscriptionobj);
		$this->view->setVar('feuserscategories',$feuserscategories);
		$this->view->setVar('addressfolders',$addressfolders);
		$this->view->setVar('path',$path);
	}
}