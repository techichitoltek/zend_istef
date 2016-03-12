<?php
/**
 *  models/Metier/TypeIncident.php
 */


/**
 * Générateur version 2.0
 */
class TypeIncident extends App_Model_Std {


	/* Champs de la table */

	protected $type_id = 0;
	protected $type_libelle = null;
	protected $type_dangerosite = null;
	protected $type_picto = null;
	protected $incident_dateAdded = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_TypeIncident";
		$this->_myDbPrimary         = "type_id";
		$this->_myMetierClassName   = "TypeIncident";
		$this->_myDbTableName       = "filrouge_type_incident";
		$this->_myDbFieldPrefix     = "type";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $type_id
	 */
	public function setType_id($type_id)
	{
		$this->type_id = $type_id;
	}

	/**
	 * @return the $type_id
	 */
	public function getType_id()
	{
		return $this->type_id;
	}

	/**
	 * @param varchar $type_libelle
	 */
	public function setType_libelle($type_libelle)
	{
		$this->type_libelle = $type_libelle;
	}

	/**
	 * @return the $type_libelle
	 */
	public function getType_libelle()
	{
		return $this->type_libelle;
	}

	/**
	 * @param int $type_dangerosite
	 */
	public function setType_dangerosite($type_dangerosite)
	{
		$this->type_dangerosite = $type_dangerosite;
	}

	/**
	 * @return the $type_dangerosite
	 */
	public function getType_dangerosite()
	{
		return $this->type_dangerosite;
	}

	/**
	 * @param varchar $type_picto
	 */
	public function setType_picto($type_picto)
	{
		$this->type_picto = $type_picto;
	}

	/**
	 * @return the $type_picto
	 */
	public function getType_picto()
	{
		return $this->type_picto;
	}

	/**
	 * @param timestamp $incident_dateAdded
	 */
	public function setIncident_dateAdded($incident_dateAdded)
	{
		$this->incident_dateAdded = $incident_dateAdded;
	}

	/**
	 * @return the $incident_dateAdded
	 */
	public function getIncident_dateAdded()
	{
		return $this->incident_dateAdded;
	}


}