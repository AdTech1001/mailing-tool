<?php
namespace nltool\Controllers;
use Phalcon\Tag as Tag;
use nltool\Models\Feusers as Feusers;
class SessionController extends ControllerBase
{
	private $_loginForm;
	
	public function initialize()
	{
	$this->_loginForm = new LoginForm();
	Tag::setTitle('Sign Up/Sign In');
        parent::initialize();
        
        
        
    
	}

	public function indexAction(){
		$this->view->form = $this->_loginForm;
	}

    private function _registerSession($user)
    {
        $this->session->set('auth', array(
            'id' => $user->uid,            
			'username' => $user->email,
			'identity' => true,
			'superuser' =>$user->superuser
        ));
    }

    public function startAction()
    {
		$request=$this->request;
        if ($this->request->isPost()) {

            //Receiving the variables sent by POST
            $email = $this->request->getPost('username', 'email');
            $rawpassword = $this->request->getPost('password');
			

            
            //Find the user in the database
            $feusers = Feusers::findFirst(array(
                "email = :email: AND deleted=0 AND hidden=0",
                "bind" => array('email' => $email)
            ));
	
			$checkedPasswords=$this->checkPassword($feusers->password, $rawpassword);
            if ($checkedPasswords != false) {

                $this->_registerSession($feusers);
					
                $this->flashSession->success('Willkommen '.$feusers->username);
				
				
                //Forward to the 'invoices' controller if the user is valid
				
                $this->response->redirect(""); 
				$this->view->disable(); 
            }else{

            $this->flash->error('Wrong email/password');
			}
        }

        return $this->forward('session/index');

    }

	
	private function checkPassword($hash, $password) {
 
    // first 29 characters include algorithm, cost and salt
    // let's call it $full_salt
    $full_salt = substr($hash, 0, 29);
 
    // run the hash function on $password
    $new_hash = crypt($password, $full_salt);
 
    // returns true or false
    return ($hash == $new_hash);
	}
	
}