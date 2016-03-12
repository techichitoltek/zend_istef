<?php
class Db_FrontendGroups extends App_Model_Db {

    public function __construct()
    {
        $this->_myDbClassName       = "Db_FrontendGroups";
        $this->_myDbPrimary         = "id";
        $this->_myMetierClassName   = "FrontendGroups";
        $this->_myDbTableName       = "zf_groups";
        $this->_myDbFieldPrefix     = "";

        parent::__construct();
    }

    function myFullSelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

}