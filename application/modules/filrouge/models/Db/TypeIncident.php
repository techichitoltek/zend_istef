<?php

/**
 *  models/Db/TypeIncident.php
 */

/**
 * Générateur version 2.0
 */
class Db_TypeIncident extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_TypeIncident";
		$this->_myDbPrimary         = "type_id";
		$this->_myMetierClassName   = "TypeIncident";
		$this->_myDbTableName       = "filrouge_type_incident";
		$this->_myDbFieldPrefix     = "type";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}