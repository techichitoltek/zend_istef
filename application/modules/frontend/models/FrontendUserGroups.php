<?php
class FrontendUserGroups extends App_Model_Std {

    /* Champs de la table */

    protected $id = 0;
    protected $group_id = "";
    protected $user_id = "";


    /* /Champs de la table */

    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_FrontendUserGroups";
        $this->_myDbPrimary         = "id";
        $this->_myMetierClassName   = "FrontendUserGroups";
        $this->_myDbTableName       = "frontend_users_groups";
        $this->_myDbFieldPrefix     = "";

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
     * @return the $group_id
     */
    public function getGroup_id() {
        return $this->group_id;
    }

    /**
     * @param string $group_id
     */
    public function setGroup_id($group_id) {
        $this->group_id = $group_id;
    }

    /**
     * @return the $user_id
     */
    public function getUser_id() {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     */
    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function getLastUserGroup(){
    	$objDB = new $this->_myDbClassName(); /* @var $objDB Db_FrontendUserGroups */
    	$select = $objDB->mySelectBuild();
    	$res = $this->getListe(false,$select,"id DESC");
    	return count($res) ? $res[0] : null;
    }

    public function getLastUserGroupId(){
    	$usergroupes = new FrontendUserGroups();
    	$lastUserGroup = $usergroupes->getLastUserGroup(); /* @var $lastUserGroup FrontendUserGroups */
    	return $lastUserGroup!==null ? $lastUserGroup->getId() : 0;
    }

    public function deleteByGroupIdUserId($groupId,$userId){
    	$objDB = new $this->_myDbClassName(); /* @var $objDB Db_FrontendUserGroups */
    	$select = $objDB->mySelectBuild();
    	$select->where('group_id = ?',$groupId);
    	$select->where('user_id = ?', $userId); /* 7: superviseurs | 8: administrateurs */
    	$res = $this->getListe(false,$select,"id DESC");
    	if(count($res)){
    		$GroupUser =  $res[0]; /* @var $GroupUser FrontendUserGroups */
    		$GroupUser->delete();
    	}
    }

}