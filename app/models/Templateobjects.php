<?php
namespace nltool\Models;

use Phalcon\Mvc\Model;

/**
 * Permissions
 * Stores the permissions by profile
 */
class Templateobjects extends Model
{
	 /**
     *
     * @var integer
     */
    public $uid;

    /**
     *
     * @var integer
     */
    public $pid=0;
	
	/**
     *
     * @var integer
     */
    public $deleted=0;
	
	/**
     *
     * @var integer
     */
    public $hidden=0;
	
	/**
     *
     * @var integer
     */
    public $crdate;
	
	/**
     *
     * @var integer
     */
    public $tstamp;
	
	/**
     *
     * @var integer
     */
    public $cruser_id;
	
	/**
     *
     * @var integer
     */
    public $usergroup;

	/**
     *
     * @var string
     */
    public $title;
	
    /**
     *
     * @var string
     */
    public $sourcecode;
	
	/**
     *
     * @var string
     */
    public $templatefilepath;
}