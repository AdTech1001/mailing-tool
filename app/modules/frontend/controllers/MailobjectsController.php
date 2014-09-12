<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use Phalcon\Tag,
	nltool\Models\Templateobjects as Templateobjects,
	nltool\Models\Mailobjects as Mailobjects,
	Phalcon\Mvc\View\Engine\Volt\Compiler as Compiler;

/**
 * Class IndexController
 *
 * @package baywa-nltool\Controllers
 */
class MailobjectsController extends ControllerBase
{

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function indexAction()
    {
        
        
		
		
		
		
    }
	
	/**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function createAction()
    {
		
         $templateobjects = Templateobjects::find();

        
        $this->view->templateobjects = $templateobjects;
        
		

        
		
		
		
		
    }
	
	function updateAction(){
		$this->assets            
            ->addJs('js/vendor/mailobjectsInit.js');
		//$this->view->setVar('language',);
		if($this->request->isPost() && !$this->dispatcher->getParam("uid")){
			$templateUid=$_POST['templateobject'];
			
			$mailObject=new Mailobjects();
			
			$mailObject->assign(array(				
				'tstamp' => time(),				
				'crdate' => time(),
				'cruser_id' => $this->session->get('auth')['uid'],
				'usergroup' => $this->session->get('auth')['usergroup'],
				'title' => $_POST['title'],
				'templateuid' =>$_POST['templateobject']
			));
			
			
			 if (!$mailObject->save()) {
                $this->flash->error($mailObject->getMessages());
            } else {
				if($templateUid !=0){
				$this->flash->success("successfully created");
				$mainTemplate='../app/modules/frontend/templates/main.volt';
				$templateFile=  '../app/modules/frontend/templates/template_'.$templateUid.'.volt';
				$generatedMailformFile='../public/mails/mailobject_'.$mailObject->uid.'.html';
				$bodyRaw=file_get_contents($templateFile);
				$body=$this->editRenderMailVars($bodyRaw);
				$main=$this->renderMain(file_get_contents($mainTemplate),$bodyRaw);
				file_put_contents($generatedMailformFile, $main);
				$this->view->setVar('compiledTemplatebodyRaw',$body);
				$this->view->setVar('mailobjectuid',$mailObject->uid);
				 
				$this->view->setVar('source','http://localhost/baywa-nltool/public/mails/mailobject_'.$mailObject->uid.'.html');
				}
				
            }
			
			
			
			
		}elseif($this->request->isPost() && $this->dispatcher->getParam("uid")){
			
			$mailObjectUid = $this->dispatcher->getParam("uid");
			$mailobjectRecord = Mailobjects::findFirst(array(
			"conditions" => "uid = ?1",
			"bind" => array(1 => $mailObjectUid)
			));
			
			$textInputs['text']=isset($_POST['edit_text']) ? $_POST['edit_text'] : array();
			$textInputs['html']=isset($_POST['edit_html']) ? $_POST['edit_html'] : array();
			
			$generatedMailformFile='../public/mails/mailobject_'.$mailObjectUid.'.html';
			$templateFile=  '../app/modules/frontend/templates/template_'.$mailobjectRecord->templateuid.'.volt';
			$mainTemplate='../app/modules/frontend/templates/main.volt';
			$bodyRaw=file_get_contents($templateFile);
			
			if(is_array($textInputs)){
				$body=$this->renderMailVars($bodyRaw,$textInputs);
			}
			file_put_contents('../public/mails/test.html', $body);
			$mail=$this->renderMain(file_get_contents($mainTemplate),$body);
			file_put_contents($generatedMailformFile, $mail);
			$this->view->setVar('compiledTemplatebodyRaw',$bodyRaw);
			$this->view->setVar('mailobjectuid',$mailObjectUid);
			$this->view->setVar('source','http://localhost/baywa-nltool/public/mails/mailobject_'.$mailObjectUid.'.html');
			$this->view->disable();
		}else{			
			$mailObjectUid = $this->dispatcher->getParam("uid");
			$mailobjectRecord = Mailobjects::findFirst(array(
			"conditions" => "uid = ?1",
			"bind" => array(1 => $mailObjectUid)
			));
			
			$templateFile=  '../app/modules/frontend/templates/template_'.$mailobjectRecord->templateuid.'.volt';
			$bodyRaw=file_get_contents($templateFile);
			$body=$this->editRenderMailVars($bodyRaw);
			$this->view->setVar('compiledTemplatebodyRaw',$body);				
			$this->view->setVar('mailobjectuid',$mailObjectUid);
			$this->view->setVar('source','http://localhost/baywa-nltool/public/mails/mailobject_'.$mailObjectUid.'.html');
		}
		
		
		
	}
	
	function editRenderMailVars($subject){
		$search=array("{{image}}","{{text}}","{{html}}","{{contentElements}}");
		$imageText=$this->translate("dropImageText");
		$textText=$this->translate("inputTextText");
		$htmlText=$this->translate("inputHtmlText");
		$contentText=$this->translate("dropContentElementsText");
		$replace=array(			
			'<input type="file" name="edit_image[]" class="editarea droparea image">'.$imageText,
			'<textarea name="edit_text[]" class="editarea text" placeholder="'.$textText.'"></textarea>',
			'<textarea name="edit_html[]" class="editarea html" placeholder="'.$htmlText.'"></textarea>',
			$contentText.'<select multiple name="edit_content[]" class="editarea contentElements"></select>'
		);
		$renderMailVars=str_replace($search, $replace, $subject);
		return $renderMailVars;
	}
	
	function renderMailVars($subject,$inputs){		
		$count=0;
		
		foreach($inputs['text'] as $text){		
			if($text != ''){
				$regex = "/\{\{text\}\}/";
				$subject=preg_replace($regex, $text, $subject, 1, $count);						
			}
		}
		
		foreach($inputs['html'] as $text){		
			if($text != ''){
				$regex = "/\{\{html}\}/";
				$subject=preg_replace($regex, $text, $subject, 1, $count);						
			}
		}
		
		
		return $subject;
	}
	
	function renderMain($subject, $body){
		$search=array('{{compiledTemplatebody}}');
		$replace=array($body);
		$renderMain=str_replace($search, $replace, $subject);
		return $renderMain;
	}
	
	function getCompiler(){
		$compiler = new Compiler();
		$compiler->addFunction('headerdata', function($resolvedArgs, $exprArgs) {
			return '"<div class=\"editarea droparea headerdata\"></div>"';
		});
		$compiler->addFunction('image', function($resolvedArgs, $exprArgs) {
			$text=$this->translate("dropImageText");
			return '"<div class=\"editarea droparea image\">'.$text.'</div>"';
		});
		$compiler->addFunction('text', function($resolvedArgs, $exprArgs) {
			$text=$this->translate("inputTextText");
			return '"<textarea class=\"editarea text\">'.$text.'</textarea>"';
		});
		$compiler->addFunction('html', function($resolvedArgs, $exprArgs) {
			$text=$this->translate("inputHtmlText");
			return '"<textarea class=\"editarea html\">'.$text.'</textarea>"';
		});
		$compiler->addFunction('contentElements', function($resolvedArgs, $exprArgs) {
			$text=$this->translate("dropContentElementsText");
			return '"<div class=\"editarea contentElements\">'.$text.'</div>"';
		});		
		$compiler->addFunction('divider', function($resolvedArgs, $exprArgs) {
			return '"<div style=\"height:15px\">&nbsp;</div><!-- spacer -->"';
		});
		
		
		return $compiler;
	}
}