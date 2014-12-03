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
       $this->hasManyToMay("uid", "nltool\Models\Distributors_segmentobjects_lookup", "uid_local", "uid_foreign", array('alias' => 'segments'));
	   $this->hasManyToMay("uid", "nltool\Models\Distributors_segmentobjects_lookup", "uid_local", "uid_foreign", array('alias' => 'segments'));
    }
	
}