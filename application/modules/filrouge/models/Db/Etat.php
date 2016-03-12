<?php

/**
 *  models/Db/Etat.php
 */

/**
 * Générateur version 2.0
 */
class Db_Etat extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Etat";
		$this->_myDbPrimary         = "etat_id";
		$this->_myMetierClassName   = "Etat";
		$this->_myDbTableName       = "filrouge_etat";
		$this->_myDbFieldPrefix     = "etat";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}