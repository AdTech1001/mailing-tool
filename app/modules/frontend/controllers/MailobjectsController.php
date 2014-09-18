<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use Phalcon\Tag,
	nltool\Models\Templateobjects as Templateobjects,
	nltool\Models\Mailobjects as Mailobjects,
	nltool\Models\Contentobjects as Contentobjects,
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
        if($this->request->isPost()){
			$time=time();
			$templateUid=$_POST['templateobject'];
			
			$mailObject=new Mailobjects();
			
			$mailObject->assign(array(				
				'tstamp' => $time,				
				'crdate' => $time,
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
				$templateFile=  '../app/modules/frontend/templates/template_mail_'.$templateUid.'.volt';
				$generatedMailFile='../public/mails/mailobject_'.$mailObject->uid.'.html';
				$bodyRaw=file_get_contents($templateFile);
				$body='';
				$basicContentElements=$this->getBasicContentElementsFromTemplate($bodyRaw);
				foreach($basicContentElements as $cElCount => $basicContentElement){
					$cElement=new Contentobjects();
					
					$cElement->assign(array(
						'crdate' => $time,
						'tstamp' =>$time,
						'cruser_id' =>$this->session->get('auth')['uid'],
						'usergroup' =>$this->session->get('auth')['usergroup'],
						'contenttype' =>0,
						'sourcecode'=> '<div class="cElement">'.$basicContentElement.'</div>',
						'templateposition'=> $cElCount,
						'positionsorting'=> 0,
						'mailobjectuid' => $mailObject->uid,
						'title'=> 'Basic Content Element '.$cElCount
					));
					if (!$cElement->save()) {
						$this->flash->error($cElement->getMessages());
					}
					$body.='<div class="editable"><div class="cElement">'.$basicContentElement.'</div></div>';
					
				}
				$bodyNice=$this->editRenderMailVars($bodyRaw);
				
				file_put_contents($generatedMailFile, $bodyNice);
				
				}
				
            }
			/*
			 * TODO entweder Mailform wieder aufbauen oder zu UPDATE weiterleiten (eher letzteres)
			 */
		}else{
		
		
			$templateobjects = Templateobjects::find(array(
				"conditions" => "templatetype = ?1",
				"bind" => array(1 => '0')
				));
			$environment= $this->config['application']['debug'] ? 'development' : 'production';
			$thumbnailSm=array();
			foreach($templateobjects as $templateobject){
				$thumbnailSmArray=explode('_',$templateobject->templatefilepath);
				$fileType=explode('.',$thumbnailSmArray[2]);
				$baseUri=$this->config['application'][$environment]['staticBaseUri'];
				$thumbnailSm[$templateobject->uid]=$baseUri.$thumbnailSmArray[0].'_'.$thumbnailSmArray[1].'_'.'S.'.$fileType[1];
			}

			$this->view->templateobjects = $templateobjects;  		
			$this->view->templateobjectsthumbs = $thumbnailSm;  		
		
		}
		
    }
	
	function updateAction()
	{
		$this->assets            
            ->addJs('js/vendor/mailobjectsInit.js');
		//$this->view->setVar('language',);
		if($this->request->isPost() && $this->dispatcher->getParam("uid")){
			
			$mailObjectUid = $this->dispatcher->getParam("uid");
			$mailobjectRecord = Mailobjects::findFirst(array(
			"conditions" => "uid = ?1",
			"bind" => array(1 => $mailObjectUid)
			));
			
			$contentElements=$_POST['contentElements'];
			
			$generatedMailformFile='../public/mails/mailobject_'.$mailObjectUid.'.html';
			$templateFile=  '../app/modules/frontend/templates/template_mail_'.$mailobjectRecord->templateuid.'.volt';
			$mainTemplate='../app/modules/frontend/templates/main.volt';
			$bodyRaw=file_get_contents($templateFile);
			
			if(is_array($contentElements)){
				$body=$this->renderMailVars($bodyRaw,$contentElements);
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
			$mailobjectRecord->getContentobjects(array(
				"conditions" => "deleted = 0 AND hidden =0",
				"order" => "templateposition ASC, positionsorting ASC"
				
			));
			//$contentObjects=  Contentobjects::find();
			
			$templateFile=  '../app/modules/frontend/templates/template_mail_'.$mailobjectRecord->templateuid.'.volt';
			$bodyRaw=file_get_contents($templateFile);
			$body=$this->editRenderMailVars($bodyRaw);
			$this->view->setVar('compiledTemplatebodyRaw',$body);				
			$this->view->setVar('mailobjectuid',$mailObjectUid);
			$this->view->setVar('source','http://localhost/baywa-nltool/public/mails/mailobject_'.$mailObjectUid.'.html');
		}
		
		
		
	}
	
	function editRenderMailVars($subject){
		$search=array("{{editable begin}}","{{editable end}}");
		$imageText=$this->translate("dropImageText");
		$textText=$this->translate("inputTextText");
		$htmlText=$this->translate("inputHtmlText");
		$contentText=$this->translate("dropContentElementsText");
		$replace=array(			
			'',
			''
			
		);
		$renderMailVars=str_replace($search, $replace, $subject);
		return $renderMailVars;
	}
	
	function getBasicContentElementsFromTemplate($body){
		
		$matches=array();
		preg_match_all('/{{editable begin}}(.*){{editable end}}/siU', $body, $matches);
		return $matches[1];
	}
	
	function renderMailVars($subject,$contentObjects){		
		$count=0;
		/*TODO inhaltslemente verschachtelt nach cposition und csorting einsetzen
		 * 
		 */
		
		foreach($inputs as $text){		
			if($text != ''){
				//$regex = "/()(.*)({{editable end}})/is";
				$subject=preg_replace('/({{editable begin}})(.*)({{editable end}})/siU', $text, $subject, 1, $count);
				
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