<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Addressssegmentobjects as Addressssegmentobjects;	

/**
 * Class AddressssegmentobjectsController
 *
 * @package baywa-nltool\Controllers
 */
class AddressssegmentobjectsController extends ControllerBase
{
	function indexAction(){
		
	}
	
	function createAction(){
		$this->assets->addJs('js/vendor/addressesInit.js');
		
	}
}