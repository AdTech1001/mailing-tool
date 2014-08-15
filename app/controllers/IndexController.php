<?php
namespace nltool\Controllers;

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
			$this->dispatcher->forward(array(
            "controller" => "index",
            "action" => "login"
        ));
		}else{
			//$this->flashSession->success('Willkommen '.$auth['username']);
		}
		
        
        
    }
	
	/**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function loginAction()
	{
		
		$this->view->form = $this->_loginForm;
	}
	  
	
}