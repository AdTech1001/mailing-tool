<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Segmentobjects as Segmentobjects;	

/**
 * Class SegmentobjectsController
 *
 * @package baywa-nltool\Controllers
 */
class SegmentobjectsController extends ControllerBase
{
	function indexAction(){
		
	}
	
	function createAction(){
		$this->assets->addJs('js/vendor/addressesInit.js');
		
	}
}