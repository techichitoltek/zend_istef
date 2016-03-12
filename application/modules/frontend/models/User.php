<?php
class User extends App_Model_Std {

	Use Tools;

    /* Champs de la table */

    protected $id = 0;
    protected $username = "";
    protected $password = "";
    protected $password_valid = 0;
    protected $last_login = null;
    protected $nb_login = 0;
    protected $last_password_update = null;
    protected $deleted = 0;
    protected $user_dateAdded = null;
    protected $user_dateUpdated = null;


    /* /Champs de la table */

    /**
     *
     * @var UserInfos
     */
    protected $userInfos = null;

    protected $groups = null;

    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_User";
        $this->_myDbPrimary         = "id";
        $this->_myMetierClassName   = "User";
        $this->_myDbTableName       = "frontend_users";
        $this->_myDbFieldPrefix     = "user";

        if($id !== false) $this->loadById($id,$full,$champ);
    }
    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param number $id
     */
    public function setId($id) {
        $this->id = $id;
    }
    /**
     * @return the $username
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @return the $password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @return the $password_valid
     */
    public function getPassword_valid() {
        return $this->password_valid;
    }

    /**
     * @param number $password_valid
     */
    public function setPassword_valid($password_valid) {
        $this->password_valid = $password_valid;
    }
    /**
     * @return the $last_login
     */
    public function getLast_login() {
        return $this->last_login;
    }

    /**
     * @param field_type $last_login
     */
    public function setLast_login($last_login) {
        $this->last_login = $last_login;
    }

    /**
	 * @return the $nb_login
	 */
	public function getNb_login() {
		return $this->nb_login;
	}

	/**
	 * @param number $nb_login
	 */
	public function setNb_login($nb_login) {
		$this->nb_login = $nb_login;
	}

	/**
     * @return the $last_password_update
     */
    public function getLast_password_update() {
        return $this->last_password_update;
    }

    /**
     * @param field_type $last_password_update
     */
    public function setLast_password_update($last_password_update) {
        $this->last_password_update = $last_password_update;
    }

    /**
     * @return the $deleted
     */
    public function getDeleted() {
        return $this->deleted;
    }

    /**
     * @param number $deleted
     */
    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    /**
     * @return the $user_dateAdded
     */
    public function getUser_dateAdded() {
        return $this->user_dateAdded;
    }

    /**
     * @param field_type $user_dateAdded
     */
    public function setUser_dateAdded($user_dateAdded) {
        $this->user_dateAdded = $user_dateAdded;
    }

    /**
     * @return the $user_dateUpdated
     */
    public function getUser_dateUpdated() {
        return $this->user_dateUpdated;
    }

    /**
     * @param field_type $user_dateUpdated
     */
    public function setUser_dateUpdated($user_dateUpdated) {
        $this->user_dateUpdated = $user_dateUpdated;
    }


    public static function getSession(){
        $baseUser = BaseUser::getSession();
        $user = new User();
        $user->loadFromRowset($baseUser);
        return $user;
    }

    /**
     *
     * @return UserInfos
     */
    public function getUserInfos(){
        if(!$this->userInfos){
            $this->userInfos = new UserInfos($this->id,true,'userinfos_userId');
        }
        return $this->userInfos;
    }

    public function getGroups(){
        if($this->groups == null){
            $userGroups = array();
            $userModel = new RcwebUser();
            $user = $userModel->findById($this->id);
            $groups = $user->findManyToManyRowset('Group', 'FrontendUserGroup');
            foreach($groups as $group){
                $userGroups[] = $group;
            }

            $this->groups = $userGroups;
        }
        return $this->groups;
    }

    public function getRoles(){
        $this->getGroups();
        $role = "";
        if(is_array($this->groups)){
            foreach ($this->groups as $r) {
                $role[] = $r->name;
            }
        }else{
            $role = $this->groups->name;
        }
        return $role;
    }

    public function usernameExist($username){
		$now = new Zend_Date();
		$objDB = new $this->_myDbClassName(); /* @var $objDB Db_User */
		$select = $objDB->usernameExistSearch();
		$select->where("username = ?",$username);
		return count($this->getListe(false,$select)) ? true:false;
    }

    private function randomUsername($firstname,$lastname){
    	$number = "0123456789";
    	$username_int = array();
    	$numberLength = strlen($number) - 1;
    	for ($i = 0; $i < 5; $i++) {
    		$n = rand(0, $numberLength);
    		$username_int[] = $number[$n];
    	}
    	$usernameGen = strtoupper(substr($firstname, 0, 1)).strtoupper(substr($lastname, 0, 1)).implode($username_int);
    	if($this->usernameExist($usernameGen)){
			$this->randomUsername($firstname, $lastname);
    	} else {
    		return $usernameGen;
    	}
    }

    public function generateUsername($nom,$prenom){
    	return $this->randomUsername($nom,$prenom);
    }

    public function confirmMail($sign){
    	if($sign==$this->getUserInfos()->getUserinfos_mailConfirm()){
    		$userinfos = $this->getUserInfos();
    		$userinfos->setUserinfos_active(1);
    		$userinfos->setUserinfos_mailConfirm(null);
    		$userinfos->save();
    		debug('confirm affirmatif');
    		return true;
    	} else {
    		debug('confirm negatif');
    		return false;
    	}

    }



}