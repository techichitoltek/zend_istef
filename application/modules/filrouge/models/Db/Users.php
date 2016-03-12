<?php

/**
 *  models/Db/Users.php
 */

/**
 * Générateur version 2.0
 */
class Db_Users extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Users";
		$this->_myDbPrimary         = "user_id";
		$this->_myMetierClassName   = "Users";
		$this->_myDbTableName       = "filrouge_users";
		$this->_myDbFieldPrefix     = "user";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}
