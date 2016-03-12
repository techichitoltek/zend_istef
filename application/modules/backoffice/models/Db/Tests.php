<?php
class Db_Tests extends App_Model_Db {

    public function __construct()
    {
        $this->_myDbClassName       = "Db_Tests";
        $this->_myDbPrimary         = "tests_id";
        $this->_myMetierClassName   = "Tests";
        $this->_myDbTableName       = "zf_tests";
        $this->_myDbFieldPrefix     = "tests";

        parent::__construct();
    }

    function myFullSelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

}