<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Campaignobjects,
	nltool\Models\Sendoutobjects;	

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
		if($this->dispatcher->getParam('uid')){
			
			$sendoutobject=  Sendoutobjects::findFirst(array(
				'conditions'=>'uid = ?1',
				'bind' => array(
					1 => $this->dispatcher->getParam('uid')
				)
			));
			
			$configuration=$sendoutobject->getConfiguration();
			
			
			$environment= $this->config['application']['debug'] ? 'development' : 'production';
			$baseUri=$this->config['application'][$environment]['staticBaseUri'];
			$this->view->setVar('source',$baseUri.'mails/mailobject_'.$sendoutobject->mailobjectuid.'.html');
			
			$this->view->setVar('sendoutobject',$sendoutobject);
		}
		
	}
	
}	