<?php
namespace nltool\Models;

use Phalcon\Mvc\Model;

/**
 * nltool\Models\Profiles
 * All the profile levels in the application. Used in conjenction with ACL lists
 */
class Profiles extends Model
{

    /**
     * ID
     * @var integer
     */
    public $uid;

    /**
     * Name
     * @var string
     */
    public $title;

    /**
     * Define relationships to Users and Permissions
     */
    public function initialize()
    {
        $this->hasMany('id', 'nltool\Models\Feusers', 'profilesId', array(
            'alias' => 'users',
            'foreignKey' => array(
                'message' => 'Profile cannot be deleted because it\'s used on Users'
            )
        ));

        $this->hasMany('id', 'Vokuro\Models\Permissions', 'profilesId', array(
            'alias' => 'permissions'
        ));
    }
}