<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use Phalcon\Tag,
	nltool\Models\Templateobjects as Templateobjects,
	Phalcon\Mvc\View\Engine\Volt\Compiler as Compiler;

class TemplateobjectsController extends ControllerBase
{
	 /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function indexAction()
    {
        
        
		
		
		
		
    }
	public function createAction(){

		/*$file=  file_get_contents('../app/modules/frontend/templates/newsletterMainTemplate.volt');
		$compiled= $compiler->parse($file);*/
		//echo('<iframe src="http://localhost/baywa-nltool/public/templates/newsletterMainTemplate.volt.php"></iframe>');
	
		
		if($this->request->isPost()){
			
			$templateObject=new Templateobjects();
			$templatefilepath=$_POST['templatefilepath']=='' ? ' ' : $_POST['templatefilepath'];
			$templateObject->assign(array(				
				'tstamp' => time(),				
				'crdate' => time(),
				'cruser_id' => $this->session->get('auth')['uid'],
				'usergroup' => $this->session->get('auth')['usergroup'],
				'title' => $_POST['title'],
				'sourcecode' => $_POST['sourcecode'],
				'templatefilepath' => $templatefilepath
			));
			
			
			 if (!$templateObject->save()) {
                $this->flash->error($templateObject->getMessages());
            } else {
				$generatedTemplateFileName='../app/modules/frontend/templates/template_'.$templateObject->uid.'.volt';
				file_put_contents($generatedTemplateFileName,$templateObject->sourcecode);
                $this->flash->success("Profile was created successfully: ");
            }

            Tag::resetInput();
		}
		
	}
}