<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Configurationobjects as Configurationobjects,
		Phalcon\Tag,
		nltool\Forms\ConfigurationobjectsForm as ConfigurationobjectsForm;

/**
 * Class IndexController
 *
 * @package baywa-nltool\Controllers
 */
class ConfigurationobjectsController extends ControllerBase
{

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function indexAction()
    {
        //$this->flashSession->error('Page not found: ' . $this->escaper->escapeHtml($this->router->getRewriteUri()));
		$configurationobjects=Configurationobjects::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));
		if($this->request->isPost()){
			$confObjectsArr=array();
			foreach($configurationobjects as $configurationobject){
				$confObjectsArr[]=array(
					'uid'=>$configurationobject->uid,
					'title' => $configurationobject->title,
					'date'=> date('d.m.Y',$configurationobject->tstamp)
				);
			}
			$returnJson=json_encode($confObjectsArr);
			echo($returnJson);
			die();
		}else{
			
		$environment= $this->config['application']['debug'] ? 'development' : 'production';
		$baseUri=$this->config['application'][$environment]['staticBaseUri'];
		$path=$baseUri.$this->view->language.'/configurationobjects/update/';
		
		$this->view->setVar('configurationobjects',$configurationobjects);
		$this->view->setVar('path',$path);
		}
		
        
		
		
    }
	
	public function createAction()
	{
		 
	 if($this->request->isPost())
	{
		$time=time();
		$configurationobject=new Configurationobjects();
		$configurationobject->assign(array(				
				'pid' =>0,
				'deleted'=>0,
				'hidden' => 0,
				'tstamp' => $time,				
				'crdate' => $time,
				'cruser_id' => $this->session->get('auth')['uid'],
				'usergroup' => $this->session->get('auth')['usergroup'],
				'title' => $this->request->getPost('title','striptags'),
				'sendermail'=> $this->request->getPost('sendermail','email'),
				'sendername' => $this->request->getPost('sendername','striptags'),
				'answermail' => $this->request->getPost('answermail','email'),
				'answername' => $this->request->getPost('answername','striptags'),
				'returnpath' => $this->request->getPost('returnpath','email'),
				'organisation' => $this->request->getPost('organisation','striptags'),
				'htmlplain' => $this->request->getPost('htmlplain','int')
			));
		
		 $configurationobject->save();
		 if (!$configurationobject->save()) {
              $this->flash->error($configurationobject->getMessages());
		 } else {

		}
	}
		 
	}
	public function updateAction(){
		if(!$this->request->isPost()){
			$configurationobjectUid = $this->dispatcher->getParam("uid");
			$configurationobjectRecord = Configurationobjects::findFirstByUid($configurationobjectUid);
		}else{
			$configurationobjectUid=$this->request->getPost('uid', 'int');
			$configurationobjectRecord = Configurationobjects::findFirstByUid($configurationobjectUid);
			$time=time();
			$configurationobjectRecord->assign(array(								
				'tstamp' => $time,												
				'title' => $this->request->getPost('title','striptags'),
				'sendermail'=> $this->request->getPost('sendermail','email'),
				'sendername' => $this->request->getPost('sendername','striptags'),
				'answermail' => $this->request->getPost('answermail','email'),
				'answername' => $this->request->getPost('answername','striptags'),
				'returnpath' => $this->request->getPost('returnpath','email'),
				'organisation' => $this->request->getPost('organisation','striptags'),
				'htmlplain' => $this->request->getPost('htmlplain','int')
			));
			 if (!$configurationobjectRecord->save()) {
                $this->flash->error($configurationobjectRecord->getMessages());
            } else {

                $this->flash->success("User was updated successfully");

                Tag::resetInput();
            }
		}
		
		
		
		$this->view->form = new ConfigurationobjectsForm($configurationobjectRecord, array(
            'edit' => true
        ));
		
	}
	
}