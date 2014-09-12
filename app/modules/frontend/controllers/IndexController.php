<?php
namespace nltool\Modules\Modules\Frontend\Controllers;

/**
 * Class IndexController
 *
 * @package baywa-nltool\Controllers
 */

class IndexController extends ControllerBase

{
	private $_loginForm;
	
	public function initialize()
	{
		$session=$this->session;
		
	$this->_loginForm = new LoginForm();
	
	 $this->view->setTemplateAfter('main');
	 
	}

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function indexAction()
    {		
		$auth = $this->session->get('auth');
		
		if(!$auth){			
			$this->view->form = $this->_loginForm;
			/*$this->dispatcher->forward(array(
            "controller" => "index",
            "action" => "index"
        ));*/
		}else{
			//$this->flashSession->success('Willkommen '.$auth['username']);
			$this->dispatcher->forward(array(
            "controller" => "index",
            "action" => "overview"
				));
			
		}
		
        
        
    }
	
	
	private function getRunningJobs(){
		$content='ACL geprüfter und mehrsprachiger Content';
		return $content;
	}
	
	
	
	/**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function overviewAction()
	{
		$runningJobs=$this->getRunningJobs();
			
			$this->view->setVar('runningJobs',$runningJobs);
		
	}
	  
	
}