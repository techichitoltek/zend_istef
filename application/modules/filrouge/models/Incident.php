<?php
/**
 *  models/Metier/Incident.php
 */


/**
 * Générateur version 2.0
 */
class Incident extends App_Model_Std {


	/* Champs de la table */

	protected $incident_id = 0;
	protected $incident_userId = 0;
	protected $incident_lat = "";
	protected $incident_long = "";
	protected $incident_nbsignalements = null;
	protected $incident_etatId = null;
	protected $incident_typeincidentId = null;
	protected $incident_commentaire = null;
	protected $incident_dateAdded = null;

	/**
	 *
	 * @var Users
	 */
	protected $user = null;

	/**
	 *
	 * @var TypeIncident
	 */
	protected $typeIncident = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Incident";
		$this->_myDbPrimary         = "incident_id";
		$this->_myMetierClassName   = "Incident";
		$this->_myDbTableName       = "filrouge_incident";
		$this->_myDbFieldPrefix     = "incident";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $incident_id
	 */
	public function setIncident_id($incident_id)
	{
		$this->incident_id = $incident_id;
	}

	/**
	 * @return the $incident_id
	 */
	public function getIncident_id()
	{
		return $this->incident_id;
	}

	/**
	 * @param int $incident_userId
	 */
	public function setIncident_userId($incident_userId)
	{
		$this->incident_userId = $incident_userId;
	}

	/**
	 * @return the $incident_userId
	 */
	public function getIncident_userId()
	{
		return $this->incident_userId;
	}

	/**
	 * @param double $incident_lat
	 */
	public function setIncident_lat($incident_lat)
	{
		$this->incident_lat = $incident_lat;
	}

	/**
	 * @return the $incident_lat
	 */
	public function getIncident_lat()
	{
		return $this->incident_lat;
	}

	/**
	 * @param double $incident_long
	 */
	public function setIncident_long($incident_long)
	{
		$this->incident_long = $incident_long;
	}

	/**
	 * @return the $incident_long
	 */
	public function getIncident_long()
	{
		return $this->incident_long;
	}

	/**
	 * @param int $incident_nbsignalements
	 */
	public function setIncident_nbsignalements($incident_nbsignalements)
	{
		$this->incident_nbsignalements = $incident_nbsignalements;
	}

	/**
	 * @return the $incident_nbsignalements
	 */
	public function getIncident_nbsignalements()
	{
		return $this->incident_nbsignalements;
	}

	/**
	 * @param int $incident_etatId
	 */
	public function setIncident_etatId($incident_etatId)
	{
		$this->incident_etatId = $incident_etatId;
	}

	/**
	 * @return the $incident_etatId
	 */
	public function getIncident_etatId()
	{
		return $this->incident_etatId;
	}

	/**
	 * @param int $incident_typeincidentId
	 */
	public function setIncident_typeincidentId($incident_typeincidentId)
	{
		$this->incident_typeincidentId = $incident_typeincidentId;
	}

	/**
	 * @return the $incident_typeincidentId
	 */
	public function getIncident_typeincidentId()
	{
		return $this->incident_typeincidentId;
	}

	/**
	 * @param string $incident_commentaire
	 */
	public function setIncident_commentaire($incident_commentaire)
	{
		$this->incident_commentaire = $incident_commentaire;
	}

	/**
	 * @return the $incident_commentaire
	 */
	public function getIncident_commentaire()
	{
		return $this->incident_commentaire;
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


	/**
	 *
	 * @return TypeIncident
	 */
	public function getTypeIncident(){
		if(!$this->typeIncident){
			$this->typeIncident = new TypeIncident($this->incident_typeincidentId,true,'type_id');
		}
		return $this->typeIncident;
	}

	/**
	 *
	 * @return Users (utilisateurs application module filrouge)
	 */
	public function getUser(){
		if(!$this->user){
			$this->user = new Users($this->incident_userId,true,'user_id');
		}
		return $this->user;
	}


	/**
	 * @return list by latitude,longitude,rayon(km) using display incident for users
	 */
	public function getIncidentByLocation($lat,$long,$rayon){
		$objDB = new $this->_myDbClassName(); /* @var $objDB Db_Incident */
		$res = $objDB->mySelectIncidentByLocation($lat,$long,$rayon);
		return $res;
	}


	/**
	 * @return list by latitude,longitude,rayon(km) using API getincidentAction
	 */
	public function getIncidentByLocationResponse($typeResponse,$lat, $long, $rayon){
		$liste_incident = $this->getListe();
		$liste_incident = $this->getIncidentByLocation($lat, $long, $rayon);
		//var_dump($liste_incident);
		if(count($liste_incident)){
			switch ($typeResponse){
				case 'xml':
					$response = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>';
					$response .= '<root>';
					foreach ($liste_incident as $incident): /* @var $incident Incident */
					$type_incident_libelle = $incident->getTypeIncident()->getType_libelle();
					$user = $incident->getUser();

					$response .= '<incident id="'.$incident->getIncident_id().
					'" nbsignalement="'.$incident->getIncident_nbsignalements().
					'" typeincident="'.$type_incident_libelle
					.'" commentaire="'.$incident->getIncident_commentaire()
					.'" pseudo="'.$user->getUser_pseudo()
					.'" avatar="'.$user->getUser_avatar()
					.'"/>';
					endforeach;
					$response .= '</root>';
					break;
				case 'json':
					$response = '';
					foreach ($liste_incident as $incident): /* @var $incident Incident */
					$type_incident_libelle = $incident->getTypeIncident()->getType_libelle();
					$user = $incident->getUser();
					$response .= '{"id":"'.$incident->getIncident_id().'", "nbsignalement":"'.$incident->getIncident_nbsignalements()
					.'", "typeincident":"'.$type_incident_libelle
					.'", "commentaire":"'.$incident->getIncident_commentaire()
					.'", "pseudo":"'.$user->getUser_pseudo()
					.'", "avatar":"'.$user->getUser_avatar()
					.'"}';
					endforeach;
					break;

				default:
					$response = 'Erreur : paramètre type de réponse manquant';
					break;
			}
		} else {
			$response = 'Aucun incident à signalé';
		}

		return $response;
	}




}