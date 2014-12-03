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
        $this->hasManyToMay("uid", "nltool\Models\Distributors_segmentobjects_lookup", "uid_foreign","uid_local",array('alias' => 'distributors'));
    }
}