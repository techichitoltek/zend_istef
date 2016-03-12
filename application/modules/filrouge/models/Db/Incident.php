<?php

/**
 *  models/Db/Incident.php
 */

/**
 * Générateur version 2.0
 */
class Db_Incident extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Incident";
		$this->_myDbPrimary         = "incident_id";
		$this->_myMetierClassName   = "Incident";
		$this->_myDbTableName       = "filrouge_incident";
		$this->_myDbFieldPrefix     = "incident";

		parent::__construct();
	}


	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

	function geoSelectBuild(/*$lat,$long,$rayon*/){

		$sql="SELECT *,
			(6366*acos(cos(radians(43.2967))*cos(radians(incident_lat))*cos(radians(incident_long) -radians(5.37639))+sin(radians(43.2967))*sin(radians(incident_lat)))) AS distance
			FROM filrouge_incident
			having distance<=5
		ORDER by distance ASC";
		/*
		* paris lat:48.86 long:2.34445
		* marseille lat:43.2967 long: 5.37639
		* tournefeuille lat:43.5833 long:1.35
		* toulouse: lat:43.6 long:1.43333*/


		$select = $this->select()->setIntegrityCheck(false);
		$lat = 43.6;
		$long = 1.43333;
		$rayon = 0.5;

		$geocal = '(6366*acos(cos(radians('.$lat.'))*cos(radians(incident_lat))*cos(radians(incident_long) -radians('.$long.'))+sin(radians('.$lat.'))*sin(radians(incident_lat))))';
		$select->from(array('a'=>$this->_myDbTableName),array("*"));
		$select->where("$geocal");
		$select->having("$geocal <= 5");

		//$select->order("$geocal ASC"); // n'arrive pas à implémenter dans zend - définir alias geo.. --> adapté avec getIncidentByLocation() ci-dessous
		/*
		 // Construire cette requête :
		//   SELECT p."produit_id", (p.prix * 1.08) AS prix_avec_taxe
		//   FROM "produits" AS p

		$select = $db->select()
		->from(array('p' => 'produits'),
				array('produit_id',
						'prix_avec_taxe' => '(p.prix * 1.08)'));
		*/

		return $select;




	}

	function mySelectIncidentByLocation($lat,$long,$rayon){
		$stmt = $this->_db->query('SELECT *,
		(6366*acos(cos(radians('.$lat.'))*cos(radians(incident_lat))*cos(radians(incident_long) -radians('.$long.'))+sin(radians('.$lat.'))*sin(radians(incident_lat)))) AS distance
		FROM filrouge_incident
		having distance<='.$rayon	.'
		ORDER by distance ASC');
		$return = array();
		foreach($stmt as $rowset){
			$obj = new $this->_myMetierClassName();
			$obj->loadFromRowset($rowset);
			$return[] = $obj;
		}
		return $return;
	}

}