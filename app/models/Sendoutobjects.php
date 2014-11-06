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
		$this->hasOne("segmentobjectuid", "nltool\Models\Adressfolders", "uid",array('alias' => 'adressfolder'));
    }
	
}