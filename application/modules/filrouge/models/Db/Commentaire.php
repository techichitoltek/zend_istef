<?php

/**
 *  models/Db/Commentaire.php
 */

/**
 * Générateur version 2.0
 */
class Db_Commentaire extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Commentaire";
		$this->_myDbPrimary         = "comment_id";
		$this->_myMetierClassName   = "Commentaire";
		$this->_myDbTableName       = "filrouge_commentaire";
		$this->_myDbFieldPrefix     = "comment";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}
