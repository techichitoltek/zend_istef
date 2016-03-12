<?php
/**
 *  models/Metier/Geoville.php
 */


/**
 * Générateur version 2.0
 */
class Geoville extends App_Model_Std {


	/* Champs de la table */

	protected $ville_id = 0;
	protected $ville_departement = null;
	protected $ville_slug = null;
	protected $ville_nom = null;
	protected $ville_nom_simple = null;
	protected $ville_nom_reel = null;
	protected $ville_nom_soundex = null;
	protected $ville_nom_metaphone = null;
	protected $ville_code_postal = null;
	protected $ville_commune = null;
	protected $ville_code_commune = "";
	protected $ville_arrondissement = null;
	protected $ville_canton = null;
	protected $ville_amdi = null;
	protected $ville_population_2010 = null;
	protected $ville_population_1999 = null;
	protected $ville_population_2012 = null;
	protected $ville_densite_2010 = null;
	protected $ville_surface = null;
	protected $ville_longitude_deg = null;
	protected $ville_latitude_deg = null;
	protected $ville_longitude_grd = null;
	protected $ville_latitude_grd = null;
	protected $ville_longitude_dms = null;
	protected $ville_latitude_dms = null;
	protected $ville_zmin = null;
	protected $ville_zmax = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Geoville";
		$this->_myDbPrimary         = "ville_id";
		$this->_myMetierClassName   = "Geoville";
		$this->_myDbTableName       = "filrouge_geoville";
		$this->_myDbFieldPrefix     = "ville";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param mediumint $ville_id
	 */
	public function setVille_id($ville_id)
	{
		$this->ville_id = $ville_id;
	}

	/**
	 * @return the $ville_id
	 */
	public function getVille_id()
	{
		return $this->ville_id;
	}

	/**
	 * @param varchar $ville_departement
	 */
	public function setVille_departement($ville_departement)
	{
		$this->ville_departement = $ville_departement;
	}

	/**
	 * @return the $ville_departement
	 */
	public function getVille_departement()
	{
		return $this->ville_departement;
	}

	/**
	 * @param varchar $ville_slug
	 */
	public function setVille_slug($ville_slug)
	{
		$this->ville_slug = $ville_slug;
	}

	/**
	 * @return the $ville_slug
	 */
	public function getVille_slug()
	{
		return $this->ville_slug;
	}

	/**
	 * @param varchar $ville_nom
	 */
	public function setVille_nom($ville_nom)
	{
		$this->ville_nom = $ville_nom;
	}

	/**
	 * @return the $ville_nom
	 */
	public function getVille_nom()
	{
		return $this->ville_nom;
	}

	/**
	 * @param varchar $ville_nom_simple
	 */
	public function setVille_nom_simple($ville_nom_simple)
	{
		$this->ville_nom_simple = $ville_nom_simple;
	}

	/**
	 * @return the $ville_nom_simple
	 */
	public function getVille_nom_simple()
	{
		return $this->ville_nom_simple;
	}

	/**
	 * @param varchar $ville_nom_reel
	 */
	public function setVille_nom_reel($ville_nom_reel)
	{
		$this->ville_nom_reel = $ville_nom_reel;
	}

	/**
	 * @return the $ville_nom_reel
	 */
	public function getVille_nom_reel()
	{
		return $this->ville_nom_reel;
	}

	/**
	 * @param varchar $ville_nom_soundex
	 */
	public function setVille_nom_soundex($ville_nom_soundex)
	{
		$this->ville_nom_soundex = $ville_nom_soundex;
	}

	/**
	 * @return the $ville_nom_soundex
	 */
	public function getVille_nom_soundex()
	{
		return $this->ville_nom_soundex;
	}

	/**
	 * @param varchar $ville_nom_metaphone
	 */
	public function setVille_nom_metaphone($ville_nom_metaphone)
	{
		$this->ville_nom_metaphone = $ville_nom_metaphone;
	}

	/**
	 * @return the $ville_nom_metaphone
	 */
	public function getVille_nom_metaphone()
	{
		return $this->ville_nom_metaphone;
	}

	/**
	 * @param varchar $ville_code_postal
	 */
	public function setVille_code_postal($ville_code_postal)
	{
		$this->ville_code_postal = $ville_code_postal;
	}

	/**
	 * @return the $ville_code_postal
	 */
	public function getVille_code_postal()
	{
		return $this->ville_code_postal;
	}

	/**
	 * @param varchar $ville_commune
	 */
	public function setVille_commune($ville_commune)
	{
		$this->ville_commune = $ville_commune;
	}

	/**
	 * @return the $ville_commune
	 */
	public function getVille_commune()
	{
		return $this->ville_commune;
	}

	/**
	 * @param varchar $ville_code_commune
	 */
	public function setVille_code_commune($ville_code_commune)
	{
		$this->ville_code_commune = $ville_code_commune;
	}

	/**
	 * @return the $ville_code_commune
	 */
	public function getVille_code_commune()
	{
		return $this->ville_code_commune;
	}

	/**
	 * @param smallint $ville_arrondissement
	 */
	public function setVille_arrondissement($ville_arrondissement)
	{
		$this->ville_arrondissement = $ville_arrondissement;
	}

	/**
	 * @return the $ville_arrondissement
	 */
	public function getVille_arrondissement()
	{
		return $this->ville_arrondissement;
	}

	/**
	 * @param varchar $ville_canton
	 */
	public function setVille_canton($ville_canton)
	{
		$this->ville_canton = $ville_canton;
	}

	/**
	 * @return the $ville_canton
	 */
	public function getVille_canton()
	{
		return $this->ville_canton;
	}

	/**
	 * @param smallint $ville_amdi
	 */
	public function setVille_amdi($ville_amdi)
	{
		$this->ville_amdi = $ville_amdi;
	}

	/**
	 * @return the $ville_amdi
	 */
	public function getVille_amdi()
	{
		return $this->ville_amdi;
	}

	/**
	 * @param mediumint $ville_population_2010
	 */
	public function setVille_population_2010($ville_population_2010)
	{
		$this->ville_population_2010 = $ville_population_2010;
	}

	/**
	 * @return the $ville_population_2010
	 */
	public function getVille_population_2010()
	{
		return $this->ville_population_2010;
	}

	/**
	 * @param mediumint $ville_population_1999
	 */
	public function setVille_population_1999($ville_population_1999)
	{
		$this->ville_population_1999 = $ville_population_1999;
	}

	/**
	 * @return the $ville_population_1999
	 */
	public function getVille_population_1999()
	{
		return $this->ville_population_1999;
	}

	/**
	 * @param mediumint $ville_population_2012
	 */
	public function setVille_population_2012($ville_population_2012)
	{
		$this->ville_population_2012 = $ville_population_2012;
	}

	/**
	 * @return the $ville_population_2012
	 */
	public function getVille_population_2012()
	{
		return $this->ville_population_2012;
	}

	/**
	 * @param int $ville_densite_2010
	 */
	public function setVille_densite_2010($ville_densite_2010)
	{
		$this->ville_densite_2010 = $ville_densite_2010;
	}

	/**
	 * @return the $ville_densite_2010
	 */
	public function getVille_densite_2010()
	{
		return $this->ville_densite_2010;
	}

	/**
	 * @param float $ville_surface
	 */
	public function setVille_surface($ville_surface)
	{
		$this->ville_surface = $ville_surface;
	}

	/**
	 * @return the $ville_surface
	 */
	public function getVille_surface()
	{
		return $this->ville_surface;
	}

	/**
	 * @param float $ville_longitude_deg
	 */
	public function setVille_longitude_deg($ville_longitude_deg)
	{
		$this->ville_longitude_deg = $ville_longitude_deg;
	}

	/**
	 * @return the $ville_longitude_deg
	 */
	public function getVille_longitude_deg()
	{
		return $this->ville_longitude_deg;
	}

	/**
	 * @param float $ville_latitude_deg
	 */
	public function setVille_latitude_deg($ville_latitude_deg)
	{
		$this->ville_latitude_deg = $ville_latitude_deg;
	}

	/**
	 * @return the $ville_latitude_deg
	 */
	public function getVille_latitude_deg()
	{
		return $this->ville_latitude_deg;
	}

	/**
	 * @param varchar $ville_longitude_grd
	 */
	public function setVille_longitude_grd($ville_longitude_grd)
	{
		$this->ville_longitude_grd = $ville_longitude_grd;
	}

	/**
	 * @return the $ville_longitude_grd
	 */
	public function getVille_longitude_grd()
	{
		return $this->ville_longitude_grd;
	}

	/**
	 * @param varchar $ville_latitude_grd
	 */
	public function setVille_latitude_grd($ville_latitude_grd)
	{
		$this->ville_latitude_grd = $ville_latitude_grd;
	}

	/**
	 * @return the $ville_latitude_grd
	 */
	public function getVille_latitude_grd()
	{
		return $this->ville_latitude_grd;
	}

	/**
	 * @param varchar $ville_longitude_dms
	 */
	public function setVille_longitude_dms($ville_longitude_dms)
	{
		$this->ville_longitude_dms = $ville_longitude_dms;
	}

	/**
	 * @return the $ville_longitude_dms
	 */
	public function getVille_longitude_dms()
	{
		return $this->ville_longitude_dms;
	}

	/**
	 * @param varchar $ville_latitude_dms
	 */
	public function setVille_latitude_dms($ville_latitude_dms)
	{
		$this->ville_latitude_dms = $ville_latitude_dms;
	}

	/**
	 * @return the $ville_latitude_dms
	 */
	public function getVille_latitude_dms()
	{
		return $this->ville_latitude_dms;
	}

	/**
	 * @param mediumint $ville_zmin
	 */
	public function setVille_zmin($ville_zmin)
	{
		$this->ville_zmin = $ville_zmin;
	}

	/**
	 * @return the $ville_zmin
	 */
	public function getVille_zmin()
	{
		return $this->ville_zmin;
	}

	/**
	 * @param mediumint $ville_zmax
	 */
	public function setVille_zmax($ville_zmax)
	{
		$this->ville_zmax = $ville_zmax;
	}

	/**
	 * @return the $ville_zmax
	 */
	public function getVille_zmax()
	{
		return $this->ville_zmax;
	}


}