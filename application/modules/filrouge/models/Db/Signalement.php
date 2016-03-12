<?php

/**
 *  models/Db/Signalement.php
 */

/**
 * Générateur version 2.0
 */
class Db_Signalement extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Signalement";
		$this->_myDbPrimary         = "signal_id";
		$this->_myMetierClassName   = "Signalement";
		$this->_myDbTableName       = "filrouge_signalement";
		$this->_myDbFieldPrefix     = "signal";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}