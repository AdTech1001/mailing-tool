<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Mailobjects as Mailobjects;

/**
 * Class IndexController
 *
 * @package baywa-nltool\Controllers
 */
class CampaignsController extends ControllerBase
{

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function indexAction()
    {
        //$this->flashSession->error('Page not found: ' . $this->escaper->escapeHtml($this->router->getRewriteUri()));
        
		
		
		
		
    }
	
	public function createAction()
	{
		 
		 $this->assets            
            ->addJs('js/vendor/campaignInit.js');
		 $mailobjects=Mailobjects::find();
		 $this->view->setVar("mailobjects",$mailobjects);
		 
	}
}