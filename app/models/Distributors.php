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
	
	public function countAddresses(){
		$bindArray=array();
		$fieldMap=array(
			'pid'=>''
		);
		
		$folders=$this->getAddressfolders();
		
		$modelsManager=$this->getDi()->getShared('modelsManager');		
				
		foreach($folders as $key=> $folder){
			$fieldMap['pid'].='?'.$key;
			$bindArray[]=$folder->uid;			
		}
		
		$segments=$this->getSegments();
		
		foreach($segments as $segment){
			$conditions=$segment->getConditions();
			var_dump($segment);
		}
		
		$queryStrng="SELECT email, last_name AS lastname, first_name AS firstname, salutation, title, company, phone, address, city, zip, userlanguage, gender, uid FROM nltool\Models\Addresses WHERE deleted=0 AND hidden=0 AND pid IN (".$fieldMap['pid'].") GROUP BY email";	
		$sQuery=$modelsManager->createQuery($queryStrng);								
		
		$rResults = $sQuery->execute($bindArray);		
		
		/*$cleanedArray=array_unique($emailsArray);*/
		return count($rResults);
	}
	
}