<?php
namespace nltool\Models;
use Phalcon\Mvc\Model;


/**
 * Description of Contentobjects
 *
 * @author Philipp-PC
 */
class Sendoutobjects extends Model{

	public function initialize()
    {
        $this->hasOne("mailobjectuid", "nltool\Models\Mailobjects", "uid",array('alias' => 'mailobject'));
		$this->hasOne("configurationuid", "nltool\Models\Configurationobjects", "uid",array('alias' => 'configuration'));
		$this->hasOne("segmentobjectuid", "nltool\Models\Addressfolders", "uid",array('alias' => 'addressfolder'));
		$this->hasMany("uid", "nltool\Models\Addressconditions", "pid",array('alias' => 'addressconditions'));
		$this->hasMany("uid", "nltool\Models\Mailqueue", "sendoutobjectuid",array('alias' => 'mailqueue'));
    }
	
}