<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Distributors as Distributors,
	nltool\Models\Addresses as Addresses,
	nltool\Models\Addressfolders as Addressfolders,
	nltool\Models\Segmentobjects;
	

/**
 * Class DistributorsController
 *
 * @package baywa-nltool\Controllers
 */
class DistributorsController extends ControllerBase
{
	public function indexAction(){
		$distributors = Distributors::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));
			$distributorsArray = array();
			foreach($distributors as $distributor){
				$distributorAddresses=0;
				$folders=$distributor->getAddressfolders();
				if($folders){
					foreach($folders as $folder){
						$distributorAddresses+=$folder->countAddresses();
					}
				}
				$segments=$distributor->getSegments();
				if($segments){
					foreach($segments as $segment){
						$distributorAddresses+=$segment->countAddresses();
					}
				}
				
				$distributorsArray[]=array(
					'uid'=>$distributor->uid,
					'title'=>$distributor->title,
					'date' =>date('d.m.Y',$distributor->tstamp),
					'addresscount'=>$distributorAddresses
				);
						
			}
			$returnJson=json_encode($distributorsArray);
			echo($returnJson);
			die();
	}

	public function createAction(){
		if($this->request->isPost()){
			$time=time();
			$distributor=new Distributors();
			$distributor->assign(array(
				'pid'=>0,				
				'tstamp' => $time,
				'crdate' => $time,
				'cruser_id' => $this->session->get('auth')['uid'],
				'deleted' => 0,
				'hidden' => 0,
				'usergroup' => $this->session->get('auth')['usergroup'],
				'title' => $this->request->getPost('title'),
				'hashtags'=>' ',
				
			));
			$bindArray=array();
			$inStrng='';
			foreach($this->request->getPost('addressfolders') as $key=>$value){
				$inStrng.='?'.$key.',';
				$bindArray[$key]=$value;
			}
			$addressfolders=  Addressfolders::find(array(
				'conditions' => 'uid IN ('.substr($inStrng,0,-1).')',
				'bind' => $bindArray
				
			));
			$addressfolderArr=array();
			foreach ($addressfolders as $addressfolder){
				$addressfolderArr[]=$addressfolder;
				
			}
			
			$distributor->addressfolders=$addressfolderArr;
			
			if(!$distributor->save()){
				$this->flash->error($distributor->getMessages());
			}else{
				$this->flash->success("Distributor was created successfully");
			}
		}
		$addressfolders=Addressfolders::find(array(
			'conditions'=>'deleted=0 AND hidden=0 AND usergroup=?1',
			'bind'=>array(1=>$this->session->get('auth')['usergroup'])
		));
		$segmentobjects=  Segmentobjects::find(array(
			'conditions'=>'deleted=0 AND hidden=0 AND usergroup=?1',
			'bind'=>array(1=>$this->session->get('auth')['usergroup'])
		));

		$this->view->setVar('addressfolders',$addressfolders);
		$this->view->setVar('segmentobjects',$segmentobjects);
		
	}
}