<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Mailobjects as Mailobjects;

/**
 * Class IndexController
 *
 * @package baywa-nltool\Controllers
 */
class CampaignobjectsController extends ControllerBase
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
		 
		 $this->assets->addJs('js/vendor/campaignInit.js');
		 $this->assets->addCss('css/jquery.datetimepicker.css');
		 $this->view->setVar('lang',$this->view->language);
		 
	}
}