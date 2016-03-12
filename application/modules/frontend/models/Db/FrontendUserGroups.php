<?php
class Db_FrontendUserGroups extends App_Model_Db {

    public function __construct()
    {
        $this->_myDbClassName       = "Db_FrontendUserGroups";
        $this->_myDbPrimary         = "id";
        $this->_myMetierClassName   = "FrontendUserGroups";
        $this->_myDbTableName       = "frontend_users_groups";
        $this->_myDbFieldPrefix     = "";

        parent::__construct();
    }

    function myFullSelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

}