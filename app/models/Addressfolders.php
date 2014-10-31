<?php
namespace nltool\Models;
use Phalcon\Mvc\Model;


/**
 * Description of Contentobjects
 *
 * @author Philipp-PC
 */
class Addressfolders extends Model{
	
	 public function initialize()
    {
        $this->hasMany("uid", "nltool\Models\Addresses", "pid",array('alias' => 'addresses'));
    }
	
}