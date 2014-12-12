<?php
namespace nltool\Models;
use Phalcon\Mvc\Model;


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
		$emailsArray=[];
		$uidsArray=[];		
		$segments=$this->getSegments();
		foreach($segments as $segment){
			$segmentAddresses=$segment->getEmails();
			foreach($segmentAddresses as $uid => $email){				
				$uidsArray[]=$uid;
				$emailsArray[]=$email;
			}
		}
		
		$folders=$this->getAddressfolders();
		foreach($folders as $addressFolder){
			$folderAddresses=$addressFolder->getEmails();
			foreach($folderAddresses as $uid => $email){
				$uidsArray[]=$uid;
				$emailsArray[]=$email;
			}
		}
		$cleanedArray=array_unique($emailsArray);
		return count($cleanedArray);
	}
	
}