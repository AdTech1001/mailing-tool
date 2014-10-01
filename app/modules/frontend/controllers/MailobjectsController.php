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
		if($this->request->isPost()){
			$mailobjects=Mailobjects::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));
			$mailobjectsArray=array();
			foreach($mailobjects as $mailobject){
				$mailobjctsArray[]=array(
					'uid'=>$mailobject->uid,
					'title'=>$mailobject->title,
					'date' =>date('d.m.Y',$mailobject->tstamp)
				);
						
			}
			$returnJson=json_encode($mailobjctsArray);
			echo($returnJson);
			die();
		}else{
        $environment= $this->config['application']['debug'] ? 'development' : 'production';
		$baseUri=$this->config['application'][$environment]['staticBaseUri'];
		$path=$baseUri.$this->view->language.'/mailobjects/update/';
		$mailobjects=Mailobjects::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));
		
		$this->view->setVar('mailobjects',$mailobjects);
		$this->view->setVar('path',$path);
		
		}
		
		
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
					
					
				}
				$bodyNice=$this->editRenderMailVars($bodyRaw);
				
				file_put_contents($generatedMailFile, $bodyNice);
				
				$this->response->redirect('mailobjects/update/'.$mailObject->uid.'/'); 
				
				}
				
            }
			
			
			
			
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
			$mainTemplateFile='../app/modules/frontend/templates/main.volt';
			$bodyRaw=file_get_contents($templateFile);
			
			if(is_array($contentElements)){
				$updateTime=time();
				foreach($contentElements as $position => $positionContents){
					foreach($positionContents as $sorting => $cElement){
						$contentobjectRecord=  Contentobjects::findFirst(array(
							"conditions" => "deleted = 0 AND hidden =0 AND templateposition = ?1 AND positionsorting = ?2 AND mailobjectuid = ?3",
							"bind" => array(
								1 => $position,
								2 => $sorting,
								3 => $mailObjectUid
								
								)
						));
						
						if($contentobjectRecord){
							$contentobjectRecord->sourcecode=$cElement;
							$contentobjectRecord->tstamp=$updateTime;
							$contentobjectRecord->update();
						}else{
							$contentobjectRecord=new Contentobjects();
							$contentobjectRecord->assign(array(
								'crdate' => $updateTime,
								'tstamp' => $updateTime,
								'cruser_id' =>$this->session->get('auth')['uid'],
								'usergroup' =>$this->session->get('auth')['usergroup'],
								'contenttype' =>0,
								'sourcecode'=> $cElement,
								'templateposition'=> $position,
								'positionsorting'=> $sorting,
								'mailobjectuid' => $mailObjectUid,
								'title'=> 'Basic Content Element '.$position.'.'.$sorting
							));
							if (!$contentobjectRecord->save()) {
								$this->flash->error($cElement->getMessages());
							}
						}
						
					}
				}
				
				/* Deleting all entries, which are not current */
				 $query=$this->modelsManager->createQuery( "UPDATE nltool\Models\Contentobjects SET deleted=1, hidden=1 WHERE tstamp < :updateTime: AND mailobjectuid = :mailobjectuid:");
				
				  $query->execute(array(
					 'updateTime' => $updateTime,
					  'mailobjectuid' => $mailObjectUid
				   ));
			}
			
			$contentObjects=Contentobjects::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND mailobjectuid = ?1",
				"bind" => array(1 => $mailObjectUid),
				"order" => "templateposition ASC, positionsorting ASC"
			));
			$mailBody=$this->writeContentElements($bodyRaw, $contentObjects);
			$mainTemplate=  file_get_contents($mainTemplateFile);
			$mail=$this->renderMain($mainTemplate,$mailBody);
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
			$contentObjects=$mailobjectRecord->getContentobjects(array(
				"conditions" => "deleted = 0 AND hidden =0",
				"order" => "templateposition ASC, positionsorting ASC"
				
			));
			$templatedContentObjects=  Templateobjects::find(array(
					"conditions" => "deleted = 0 AND hidden=0 AND usergroup=?1 AND templatetype = 1",
					"bind" => array(1 => $this->session->get('auth')['usergroup'])
					));
			
			$availableContentObject=  Contentobjects::find(array(
				"conditions" => "deleted = 0 AND hidden=0 AND usergroup=?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup'])
				
			));
			
			
			$templateFile=  '../app/modules/frontend/templates/template_mail_'.$mailobjectRecord->templateuid.'.volt';
			$bodyRaw=file_get_contents($templateFile);
			$body=$this->writeContentElements($bodyRaw, $contentObjects);
			$this->view->templatedCElements =$templatedContentObjects;
			$this->view->cElements=$availableContentObject;
			$this->view->setVar('compiledTemplatebodyRaw',$body);				
			$this->view->setVar('mailobjectuid',$mailObjectUid);
			$this->view->setVar('source','http://localhost/baywa-nltool/public/mails/mailobject_'.$mailObjectUid.'.html');
		}
		
		
		
	}
	
	
	
	
	function writeContentElements($bodyRaw,$contentObjects){
		$contentPerPosition=array();
		foreach($contentObjects as $contentObject){
			if(isset($contentPerPosition[$contentObject->templateposition])){
			$contentPerPosition[$contentObject->templateposition].=$contentObject->sourcecode;
			}else{
				$contentPerPosition[$contentObject->templateposition]=$contentObject->sourcecode;
			}
		}
		foreach($contentPerPosition as $content){
			$bodyRaw=preg_replace('/({{editable begin}})(.*)({{editable end}})/siU', '<div class="editable">' .$content.'</div>', $bodyRaw, 1, $count);
		}
		
		
		return $bodyRaw;
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