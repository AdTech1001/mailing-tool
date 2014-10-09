<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Mailobjects as Mailobjects,
	nltool\Models\Campaignobjects as Campaignobjects,
	nltool\Models\Sendoutobjects as Sendoutobjects;

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
		 if($this->request->isPost()){
				$time=time();
				$automationgraphstring='';
				foreach($this->request->getPost('campaignobjectelements') as $campaignobjectElements){
					$automationgraphstring+=$campaignobjectElements;
				}
				$campaignobjectRecord=new Contentobjects();
				$campaignobjectRecord->assign(array(
					'pid'=>0,
					'crdate' => $time,
					'tstamp' => $time,
					'cruser_id' =>$this->session->get('auth')['uid'],
					'usergroup' =>$this->session->get('auth')['usergroup'],
					'deleted' =>0,
					'hidden' => 0,
					'title'=>$this->request->getPost('title','striptags'),
					'automationgraphstring' =>$automationgraphstring
				));
				if (!$campaignobjectRecord->save()) {
					$this->flash->error($cElement->getMessages());
				}
				foreach($this->request->getPost('sendoutobjects') as $sendoutobjectElements){
					$rawArray=json_decode($sendoutobjectElements);
					$sendoutobject=new Sendoutobjects();
					$rawdate=$rawArray['tstamp'];
					/*TODO DATE zerpflücken*/
					$dateArr=explode(' ',$rawdate);
					$sendoutobject->assign(array(
						'pid'=>0,
						'crdate' => $time,
						'tstamp' => $date,
						'cruser_id' =>$this->session->get('auth')['uid'],
						'usergroup' =>$this->session->get('auth')['usergroup'],
						'deleted' =>0,
						'hidden' => 0,
						'title'=>$this->request->getPost('title','striptags'),
						'automationgraphstring' =>$automationgraphstring
					));
					if (!$campaignobjectRecord->save()) {
						$this->flash->error($cElement->getMessages());
					}
					
				}
				
				
		 }else{
			$this->assets->addJs('js/vendor/campaignInit.js');
			$this->assets->addCss('css/jquery.datetimepicker.css');
			$this->view->setVar('lang',$this->view->language);
		 }
	}
}