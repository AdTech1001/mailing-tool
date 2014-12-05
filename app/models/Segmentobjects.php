<?php
namespace nltool\Models;
use Phalcon\Mvc\Model;


/**
 * Description of Contentobjects
 *
 * @author Philipp-PC
 */
class Segmentobjects extends Model{
	 public function initialize()
    {
		$this->hasManyToMany("uid", "nltool\Models\Segmentobjects_addresses_lookup", "uid_local","uid_foreign","nltool\Models\Addresses","uid",array('alias' => 'addresses'));
        $this->hasManyToMany("uid", "nltool\Models\Distributors_segmentobjects_lookup", "uid_foreign","uid_local","nltool\Models\Distributors","uid",array('alias' => 'distributors'));
    }
}