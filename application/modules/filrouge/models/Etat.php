<?php
/**
 *  models/Metier/Etat.php
 */


/**
 * Générateur version 2.0
 */
class Etat extends App_Model_Std {


	/* Champs de la table */

	protected $etat_id = 0;
	protected $etat_libelle = "";
	protected $etat_dateAdded = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Etat";
		$this->_myDbPrimary         = "etat_id";
		$this->_myMetierClassName   = "Etat";
		$this->_myDbTableName       = "filrouge_etat";
		$this->_myDbFieldPrefix     = "etat";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $etat_id
	 */
	public function setEtat_id($etat_id)
	{
		$this->etat_id = $etat_id;
	}

	/**
	 * @return the $etat_id
	 */
	public function getEtat_id()
	{
		return $this->etat_id;
	}

	/**
	 * @param int $etat_libelle
	 */
	public function setEtat_libelle($etat_libelle)
	{
		$this->etat_libelle = $etat_libelle;
	}

	/**
	 * @return the $etat_libelle
	 */
	public function getEtat_libelle()
	{
		return $this->etat_libelle;
	}

	/**
	 * @param timestamp $etat_dateAdded
	 */
	public function setEtat_dateAdded($etat_dateAdded)
	{
		$this->etat_dateAdded = $etat_dateAdded;
	}

	/**
	 * @return the $etat_dateAdded
	 */
	public function getEtat_dateAdded()
	{
		return $this->etat_dateAdded;
	}


}