<?php
namespace nltool\Modules\Modules\Backend\Controllers;
use nltool\Models\Feusers,
	nltool\Models\Profiles,
	nltool\Models\Languages,
	nltool\Models\Usergroups,
	nltool\Models\Permissions,
	nltool\Models\Resources;
/**
 * Class FeusersController
 *
 * @package baywa-nltool\Controllers
 */

class ProfilesController extends ControllerBase

{
	public function indexAction(){
		$this->assets->addJs('js/vendor/profilesInit.js');
		$profiles=  Profiles::find(array(
			'conditions' => 'deleted=0 AND hidden =0'
		));
		$resources=Resources::find(array(
			'conditions' => 'deleted=0 AND hidden=0'
		));
		
		$permissions=Permissions::find(array(
			'conditions'=> 'deleted=0 AND hidden=0'
		));
		
		$permissionArray=array();
		foreach($permissions as $permission){
			$permissionArray[$permission->profileid][$permission->resourceid][$permission->resourceaction]=1;
		}
		
		$this->view->setVar('permissions',$permissionArray);
		$this->view->setVar('profiles',$profiles);
		$this->view->setVar('resources',$resources);
	}
	public function updateAction(){
		
	}
	public function createAction(){
		$resources=  Resources::find(array(
			'conditions' =>'deleted=0 AND hidden=0'
		));
		
		$this->view->setVar('resources',$resources);
	}
}