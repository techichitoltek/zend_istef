<?php
class Db_UserInfos extends App_Model_Db {

    public function __construct()
    {
        $this->_myDbClassName       = "Db_UserInfos";
        $this->_myDbPrimary         = "userinfos_id";
        $this->_myMetierClassName   = "UserInfos";
        $this->_myDbTableName       = "frontend_users_infos";
        $this->_myDbFieldPrefix     = "userinfos";

        parent::__construct();
    }

    function myFullSelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

}