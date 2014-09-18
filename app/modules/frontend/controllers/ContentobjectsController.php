<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use Phalcon\Tag,
	nltool\Models\Templateobjects as Templateobjects,	
	nltool\Models\Contentobjects as Contentobjects,
	Phalcon\Mvc\View\Engine\Volt\Compiler as Compiler;

/**
 * Class IndexController
 *
 * @package baywa-nltool\Controllers
 */
class ContentobjectsController extends ControllerBase
{

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function indexAction()
	{
		
	}
	
	public function createAction(){
		if($this->request->isPost()){
			
		}
	}

}