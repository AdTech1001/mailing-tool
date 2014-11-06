<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Sendoutobjects;
/**
 * Class TriggersendController
 *
 * @package baywa-nltool\Controllers
 */

class TriggersendController extends Triggerauth

{
	
	
	

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function indexAction()
    {
		if($this->request->isPost()){
			$time=time();
			//find mailings which are due
			$mailings= nltool\Models\Sendoutobjects::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND tstamp <= ?1",
				"bind" => array(1 => $time),
				"order" => "tstamp ASC"
			));
			
			foreach($mailings AS $mailing){
				
			}
			
			
			//generate mails as they are handed over to the smtp mailqueue
			//hand them over to smtp in chunks of X (Backend configuration) numbers
			
			
			
		}else{
			die('<img src="images/cowboy-shaking-head.gif" style="position:absolute;top:40%;left:40%;">');
		}
	}
	
}