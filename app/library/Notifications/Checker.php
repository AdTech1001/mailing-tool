<?php
namespace nltool\Notifications;

use nltool\Models\EventNotifications;
use Phalcon\Di\Injectable;

class Checker extends Injectable
{

    /**
     * Check whether there are unread notifications or not
     *
     * @return boolean
     */
    public function has()
    {
        $usersId = $this->session->get('identity');
        if (!$usersId) {
            return false;
        }

        $number = ActivityNotifications::count(array(
            'users_id = ?0 AND was_read = "N"',
            'bind' => array($usersId)
        ));

        return $number > 0;
    }

     /**
     * Check whether there are unread notifications or not
     *
     * @return integer
     */
    public function getNumber()
    {
        $usersId = $this->session->get('identity');
        if (!$usersId) {
            return 0;
        }

        $number = ActivityNotifications::count(array(
            'users_id = ?0 AND was_read = "N"',
            'bind' => array($usersId)
        ));

        return $number;
    }

}