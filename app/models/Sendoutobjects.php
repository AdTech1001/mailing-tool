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
		$this->hasOne("distributoruid", "nltool\Models\Distributors", "uid",array('alias' => 'distributor'));
		$this->hasMany("uid", "nltool\Models\Addressconditions", "pid",array('alias' => 'addressconditions'));
		$this->hasMany("uid", "nltool\Models\Clickconditions", "pid",array('alias' => 'clickconditions'));
		$this->hasMany("uid", "nltool\Models\Mailqueue", "sendoutobjectuid",array('alias' => 'mailqueue'));
		$this->belongsTo("campaignuid", "nltool\Models\Campaignobjects", "uid", array('alias' => 'campaign'));
		$this->hasMany("uid", "nltool\Models\Review", "pid",array('alias' => 'review'));
		$this->hasMany("uid", "nltool\Models\Linkclicks", "sendoutobjectuid",array('alias' => 'linkclicks'));
		$this->hasMany("uid", "nltool\Models\Openclicks", "sendoutobjectuid",array('alias' => 'openclicks'));
    }
	
}