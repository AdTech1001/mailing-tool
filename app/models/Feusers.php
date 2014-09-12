<?php
namespace nltool\Models;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

/**
 * Description of fe_users
 *
 * @author Philipp Schreiber
 */
class Feusers extends \Phalcon\Mvc\Model{
	/**
     * @var integer
     */
    public $uid;

    /**
     * @var integer
     */
    public $pid;

	/**
	 * @var integer
	 */
	public $tstamp;
	
	/**
	 * @var integer
	 */
	public $crdate;
	
	/**
	 * @var integer
	 */
	public $cruser_id;
	
	/**
	 * @var integer
	 */
	public $deleted;
	
	/**
	 * @var integer
	 */
	public $hidden;
	
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;
	
	/**
     * @var string
     */
    public $first_name;
	
	/**
     * @var string
     */
    public $last_name;
	
	/**
     * @var string
     */
    public $email;
	
	/**
     * @var string
     */
    public $phone;
	
	/**
     * @var string
     */
    public $address;
	
	/**
     * @var string
     */
    public $city;
	
	
	/**
     * @var integer
     */
    public $userrole;
	
	/**
     * @var integer
     */
    public $usergroup;
	
	
	/**
     * @var integer
     */
    public $superuser;
	public function getUid() {
		return $this->uid;
	}

	public function setUid($uid) {
		$this->uid = $uid;
	}

	public function getPid() {
		return $this->pid;
	}

	public function setPid($pid) {
		$this->pid = $pid;
	}

	public function getTstamp() {
		return $this->tstamp;
	}

	public function setTstamp($tstamp) {
		$this->tstamp = $tstamp;
	}

	public function getCrdate() {
		return $this->crdate;
	}

	public function setCrdate($crdate) {
		$this->crdate = $crdate;
	}

	public function getCruser_id() {
		return $this->cruser_id;
	}

	public function setCruser_id($cruser_id) {
		$this->cruser_id = $cruser_id;
	}

	public function getDeleted() {
		return $this->deleted;
	}

	public function setDeleted($deleted) {
		$this->deleted = $deleted;
	}

	public function getHidden() {
		return $this->hidden;
	}

	public function setHidden($hidden) {
		$this->hidden = $hidden;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function getFirst_name() {
		return $this->first_name;
	}

	public function setFirst_name($first_name) {
		$this->first_name = $first_name;
	}

	public function getLast_name() {
		return $this->last_name;
	}

	public function setLast_name($last_name) {
		$this->last_name = $last_name;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function setPhone($phone) {
		$this->phone = $phone;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setAddress($address) {
		$this->address = $address;
	}

	public function getCity() {
		return $this->city;
	}

	public function setCity($city) {
		$this->city = $city;
	}

	public function getUserrole() {
		return $this->userrole;
	}

	public function setUserrole($userrole) {
		$this->userrole = $userrole;
	}

	public function getUsergroup() {
		return $this->usergroup;
	}

	public function setUsergroup($usergroup) {
		$this->usergroup = $usergroup;
	}

	public function getSuperuser() {
		return $this->superuser;
	}

	public function setSuperuser($superuser) {
		$this->superuser = $superuser;
	}

		
    public function validation()
    {
        $this->validate(new EmailValidator(array(
            'field' => 'email'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'email',
            'message' => 'Sorry, The email was registered by another user'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'username',
            'message' => 'Sorry, That username is already taken'
        )));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
	
	public function initialize(){
		$this->hasOne('profileid', 'nltool\Models\Profiles', 'uid', array(
            'alias' => 'profile'
        ));
	}
}

