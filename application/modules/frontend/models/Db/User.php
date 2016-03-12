<?php
class Db_User extends App_Model_Db {

    public function __construct()
    {
        $this->_myDbClassName       = "Db_User";
        $this->_myDbPrimary         = "id";
        $this->_myMetierClassName   = "User";
        $this->_myDbTableName       = "frontend_users";
        $this->_myDbFieldPrefix     = "user";

        parent::__construct();
    }

    function myFullSelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

    function usernameExistSearch(){
    	$select = $this->select()->setIntegrityCheck(false);
    	$select->from(array('frontend_users'=>$this->_myDbTableName),array("username"));
    	return $select;
    }

}