<?php
/**
 *  models/Metier/Signalement.php
 */


/**
 * Générateur version 2.0
 */
class Signalement extends App_Model_Std {


	/* Champs de la table */

	protected $signal_id = 0;
	protected $signal_lat = null;
	protected $signal_long = null;
	protected $signal_userId = "";
	protected $signal_incidentId = "";
	protected $signal_commentaire = null;
	protected $signal_dateAdded = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Signalement";
		$this->_myDbPrimary         = "signal_id";
		$this->_myMetierClassName   = "Signalement";
		$this->_myDbTableName       = "filrouge_signalement";
		$this->_myDbFieldPrefix     = "signal";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $signal_id
	 */
	public function setSignal_id($signal_id)
	{
		$this->signal_id = $signal_id;
	}

	/**
	 * @return the $signal_id
	 */
	public function getSignal_id()
	{
		return $this->signal_id;
	}

	/**
	 * @param double $signal_lat
	 */
	public function setSignal_lat($signal_lat)
	{
		$this->signal_lat = $signal_lat;
	}

	/**
	 * @return the $signal_lat
	 */
	public function getSignal_lat()
	{
		return $this->signal_lat;
	}

	/**
	 * @param double $signal_long
	 */
	public function setSignal_long($signal_long)
	{
		$this->signal_long = $signal_long;
	}

	/**
	 * @return the $signal_long
	 */
	public function getSignal_long()
	{
		return $this->signal_long;
	}

	/**
	 * @param int $signal_userId
	 */
	public function setSignal_userId($signal_userId)
	{
		$this->signal_userId = $signal_userId;
	}

	/**
	 * @return the $signal_userId
	 */
	public function getSignal_userId()
	{
		return $this->signal_userId;
	}

	/**
	 * @param int $signal_incidentId
	 */
	public function setSignal_incidentId($signal_incidentId)
	{
		$this->signal_incidentId = $signal_incidentId;
	}

	/**
	 * @return the $signal_incidentId
	 */
	public function getSignal_incidentId()
	{
		return $this->signal_incidentId;
	}

	/**
	 * @param string $signal_commentaire
	 */
	public function setSignal_commentaire($signal_commentaire)
	{
		$this->signal_commentaire = $signal_commentaire;
	}

	/**
	 * @return the $signal_commentaire
	 */
	public function getSignal_commentaire()
	{
		return $this->signal_commentaire;
	}

	/**
	 * @param timestamp $signal_dateAdded
	 */
	public function setSignal_dateAdded($signal_dateAdded)
	{
		$this->signal_dateAdded = $signal_dateAdded;
	}

	/**
	 * @return the $signal_dateAdded
	 */
	public function getSignal_dateAdded()
	{
		return $this->signal_dateAdded;
	}

	public function addSignalement($userId,$lat,$long,$commentaire){
		if(/*useridexist*/true){
			$this->setSignal_lat($lat);
			$this->setSignal_long($long);
			$this->setSignal_userId($userId);
			$this->setSignal_commentaire($commentaire);
			$this->save();
			return 'Signalement enregistré';
		}

	}


}