<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Addresses as Addresses,
	nltool\Models\Addresssegmentobjects as Addresssegmentobjects;	

/**
 * Class AddressesController
 *
 * @package baywa-nltool\Controllers
 */
class AddressesController extends ControllerBase
{
	function indexAction(){
		
	}
	
	function createAction(){
		$this->assets->addJs('js/vendor/addressesInit.js');
		$addresssegmentobjectsRecords=Addresssegmentobjects::find(array(
			"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
		));
		$this->view->setVar('addresssegmentobjects',$addresssegmentobjectsRecords);
		
	}
}