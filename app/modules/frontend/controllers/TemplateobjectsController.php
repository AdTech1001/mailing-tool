<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use Phalcon\Tag,
	nltool\Models\Templateobjects as Templateobjects,
	Phalcon\Mvc\View\Engine\Volt\Compiler as Compiler,
	Phalcon\Image\Adapter\GD as GDAdapter,
	DOMDocument as DOMDocument;
		

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
			$time=time();
			$environment= $this->config['application']['debug'] ? 'development' : 'production';
			$baseUri=$this->config['application'][$environment]['staticBaseUri'];
			$dummyImage=$baseUri.'/public/images/dummy-image.jpg';
			
			
			$templateObject=new Templateobjects();
			//$templatefilepath=$_POST['templatefilepath']=='' ? ' ' : $_POST['templatefilepath'];
			$templateObject->assign(array(				
				'tstamp' => $time,				
				'crdate' => $time,
				'cruser_id' => $this->session->get('auth')['uid'],
				'usergroup' => $this->session->get('auth')['usergroup'],
				'title' => $_POST['title'],
				'sourcecode' => ' ',
				'templatefilepath' => ' ',
				'templatetype' => $_POST['templatetype'],
			));
			
			
			 if (!$templateObject->save()) {
                $this->flash->error($templateObject->getMessages());
            } else {
				if($_POST['templatetype'] == 1){
					$generatedTemplateFileName='../app/modules/frontend/templates/template_content_'.$templateObject->uid.'.volt';
				}else{
					$generatedTemplateFileName='../app/modules/frontend/templates/template_mail_'.$templateObject->uid.'.volt';
				}
				
				
				
				
				if ($this->request->hasFiles() == true) {                    
                    foreach ($this->request->getUploadedFiles() as $file){
						$nameArray=explode('.',$file->getName());
						$filetype=$nameArray[(count($nameArray)-1)];
						$tmpFile='../app/cache/tmp/'.$time.'_'.$file->getName();
						$file->moveTo($tmpFile);
						
						$thumbFilenameS='../public/images/templateThumbnails/template_'.$templateObject->uid.'_S.'.$filetype;
						$thumbFilenameL='../public/images/templateThumbnails/template_'.$templateObject->uid.'_L.'.$filetype;
						$saveFilename='/public/images/templateThumbnails/template_'.$templateObject->uid.'_S.'.$filetype;
						
						$imageS = new GDAdapter($tmpFile);
						$imageS->resize(300);
						$imageS->save($thumbFilenameS);
						$imageL = new GDAdapter($tmpFile);
						$imageL->resize(600);
						$imageL->save($thumbFilenameL);
                         $templateObject->templatefilepath=$saveFilename;
						 $templateObject->update();
						 unlink($tmpFile);
                    }
					
					/*Updating the body to make images work*/
				$dom = new DOMDocument('1.0', 'utf-8');
				$postCode = mb_convert_encoding($_POST['sourcecode'], 'HTML-ENTITIES', "UTF-8"); 
				$dom->loadHTML($postCode);
				$images = $dom->getElementsByTagName('img');
				$counter=0;
				foreach ($images as $image) {
						$src=$image->getAttribute('src');
						if(substr($src,0,7)=='http://'){
							$path='../public/images/templates/template_mail_'.$templateObject->uid;
							if (!is_dir($path)) {
								// dir doesn't exist, make it
								mkdir($path);
							  }							
							$file=file_get_contents($src);
							$nameArray=explode('.',$src);
							$extension=$nameArray[(count($nameArray)-1)];
							$filename=$path.'/image_'.$counter.'.'.$extension;
							$image->setAttribute('src',$baseUri.substr($filename,3));
							file_put_contents($filename,$file);
						}else{
							$image->setAttribute('src',$dummyImage);
						}
						$counter++;
				}
				
				$html=preg_replace('~<(?:!DOCTYPE|/?(?:html))[^>]*>\s*~i', '', $dom->saveHTML($dom->documentElement));
                              
				$templateObject->sourcecode=$html;
				$templateObject->update();
				file_put_contents($generatedTemplateFileName,$html);
            }
				
				
                $this->flash->success("Template was created successfully: ");
            }

            Tag::resetInput();
		}
		
	}
}