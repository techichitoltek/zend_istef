<?php



/**
 *  models/Db/Geoville.php
 */

/**
 * Générateur version 2.0
 */
class Db_Geoville extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Geoville";
		$this->_myDbPrimary         = "ville_id";
		$this->_myMetierClassName   = "Geoville";
		$this->_myDbTableName       = "filrouge_geoville";
		$this->_myDbFieldPrefix     = "ville";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}