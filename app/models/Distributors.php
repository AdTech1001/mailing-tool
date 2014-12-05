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
    }
	
}