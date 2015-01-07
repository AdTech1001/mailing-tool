<?php
namespace nltool\Models;
use Phalcon\Mvc\Model;
Model::setup(['notNullValidations' => false]);

/**
 * Description of Distributors
 *
 * @author Philipp-PC
 */
class Distributors extends Model{
	
	 public function initialize()
    {
       $this->hasManyToMany("uid", "nltool\Models\Distributors_segmentobjects_lookup", "uid_local", "uid_foreign", "nltool\Models\Segmentobjects", "uid",array('alias' => 'segments'));
	   $this->hasManyToMany("uid", "nltool\Models\Distributors_addressfolders_lookup", "uid_local", "uid_foreign", "nltool\Models\Addressfolders", "uid",array('alias' => 'addressfolders'));
	   $this->hasMany("uid", "nltool\Models\Addresses", "",array('alias' => 'addresses'));
    }
	
	public function hasMany($fields, $referenceModel, $referencedFields, $options = NULL){
		
	}
	
	public function getAddresses($params= array()){
		
		$bindArray=array();
		$fieldMap=array(
			'pid'=>''
		);
		$pids=array();
		
		$folders=$this->getAddressfolders();
		
		$modelsManager=$this->getDi()->getShared('modelsManager');		
		$bindCounter=0;
		foreach($folders as $key=> $folder){
			$pids[]=$folder->uid;
		}
		$searchTerms=array();
		$segments=$this->getSegments();
		$where='';
		foreach($segments as $segment){
			$conditions=$segment->getConditions();
			if($conditions){
				$where.=' AND (';
				foreach($conditions as $condition){
					if($condition->field !== 'searchterm'  && $condition->field !== 'pid'){
						switch($condition->field){
							case 'firstname':
								$fieldname='first_name';
								break;
							case 'lastname':
								$fieldname='last_name';
								break;
							default:
								$fieldname=$condition->field;
								break;
						}
						$bindArray[$condition->field.$bindCounter]=$condition->searchvalue;
						$where .=$fieldname.' LIKE :'.$condition->field.$bindCounter.':';
						$bindCounter++;
					}elseif($condition->field === 'pid'){
						$pids[]=$condition->searchvalue;
					}elseif($condition->field === 'searchterm'){
						$searchTerms[] =$condition->searchvalue;
					}
					
				}
				$where.=')';
			}
			
		}
		if(count($pids)>0){
			$where.= ' AND nltool\Models\Addresses.pid IN (';
			$pidStrng='';
			foreach($pids as $key => $value){
				$pidStrng.='?'.$key.',';
				$bindArray[$key]=$value;
			}
			$where.=substr($pidStrng,0,-1).')';
		}
		$aColumnsFilter=array('email', 'last_name', 'first_name', 'salutation', 'title', 'company', 'phone', 'address', 'city', 'zip', 'userlanguage', 'gender' );
		if(count($searchTerms) >0){
			
			$searchStrng='';
			foreach($searchTerms as $key => $searchTerm){
				$where.=' AND (';
				foreach($aColumnsFilter as $filterName){
					$searchStrng .= "".$filterName." LIKE :searchterm".$key.": OR ";
				}
				$bindArray['searchterm'.$key]='%'.$searchTerm.'%';
				$searchStrng = substr($searchStrng, 0, -3 );
				$where .= $searchStrng.')';
			}
			
		}
		if(isset($params['conditions'])){
			$where.=$params['conditions'];
		}
		$joinTables='';
		if(isset($params['clickconditions'])){
			$joinTables=$params['clickconditions'][1];
			$where.=$params['clickconditions'][0];
		}
		$queryStrng="SELECT email, last_name AS lastname, first_name AS firstname, salutation, title, company, phone, address, city, zip, userlanguage, gender, nltool\Models\Addresses.uid FROM nltool\Models\Addresses".$joinTables." WHERE nltool\Models\Addresses.deleted=0 AND nltool\Models\Addresses.hidden=0 ".$where." GROUP BY email,nltool\Models\Addresses.uid";	
		
		$sQuery=$modelsManager->createQuery($queryStrng);								
		
		$rResults = $sQuery->execute($bindArray);		
		
		/*$cleanedArray=array_unique($emailsArray);*/
		return $rResults;
	}
	
	public function countAddresses(){
		$rResults=$this->getAddresses();
		
		
		/*$cleanedArray=array_unique($emailsArray);*/
		return count($rResults);
	}
	
}