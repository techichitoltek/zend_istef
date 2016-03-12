<?php
class UserInfos extends App_Model_Std {


    /* Champs de la table */

	protected $userinfos_id = 0;
	protected $userinfos_userId = null;
	protected $userinfos_nom = null;
	protected $userinfos_prenom = null;
	protected $userinfos_telephone = null;
	protected $userinfos_mail = null;
	protected $userinfos_active = 1;
	protected $userinfos_mailConfirm = null;
	protected $userinfos_dateCgu = null;
	protected $userinfos_isVendeur = 0;
	protected $userinfos_cp = "";
	protected $userinfos_ville = "";
	protected $userinfos_code_departement = "";
	protected $userinfos_code_region = "";
	protected $userinfos_code_pays = 250;
	protected $userinfos_adresse1 = "";
	protected $userinfos_adresse2 = null;
	protected $userinfos_evaluation_moyenne = null;
	protected $userinfos_deleted = null;
	protected $userinfos_dateAdded = null;
	protected $userinfos_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_UserInfos";
		$this->_myDbPrimary         = "userinfos_id";
		$this->_myMetierClassName   = "UserInfos";
		$this->_myDbTableName       = "frontend_users_infos";
		$this->_myDbFieldPrefix     = "";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $userinfos_id
	 */
	public function setUserinfos_id($userinfos_id)
	{
		$this->userinfos_id = $userinfos_id;
	}

	/**
	 * @return the  $userinfos_id
	 */
	public function getUserinfos_id()
	{
		return $this->userinfos_id;
	}

	/**
	 * @param int $userinfos_userId
	 */
	public function setUserinfos_userId($userinfos_userId)
	{
		$this->userinfos_userId = $userinfos_userId;
	}

	/**
	 * @return the  $userinfos_userId
	 */
	public function getUserinfos_userId()
	{
		return $this->userinfos_userId;
	}

	/**
	 * @param varchar $userinfos_nom
	 */
	public function setUserinfos_nom($userinfos_nom)
	{
		$this->userinfos_nom = $userinfos_nom;
	}

	/**
	 * @return the  $userinfos_nom
	 */
	public function getUserinfos_nom()
	{
		return $this->userinfos_nom;
	}

	/**
	 * @param varchar $userinfos_prenom
	 */
	public function setUserinfos_prenom($userinfos_prenom)
	{
		$this->userinfos_prenom = $userinfos_prenom;
	}

	/**
	 * @return the  $userinfos_prenom
	 */
	public function getUserinfos_prenom()
	{
		return $this->userinfos_prenom;
	}

	/**
	 * @param varchar $userinfos_telephone
	 */
	public function setUserinfos_telephone($userinfos_telephone)
	{
		$this->userinfos_telephone = $userinfos_telephone;
	}

	/**
	 * @return the  $userinfos_telephone
	 */
	public function getUserinfos_telephone()
	{
		return $this->userinfos_telephone;
	}

	/**
	 * @param varchar $userinfos_mail
	 */
	public function setUserinfos_mail($userinfos_mail)
	{
		$this->userinfos_mail = $userinfos_mail;
	}

	/**
	 * @return the  $userinfos_mail
	 */
	public function getUserinfos_mail()
	{
		return $this->userinfos_mail;
	}

	/**
	 * @param int $userinfos_active
	 */
	public function setUserinfos_active($userinfos_active)
	{
		$this->userinfos_active = $userinfos_active;
	}

	/**
	 * @return the  $userinfos_active
	 */
	public function getUserinfos_active()
	{
		return $this->userinfos_active;
	}

	/**
	 * @param string $userinfos_mailConfirm
	 */
	public function setUserinfos_mailConfirm($userinfos_mailConfirm)
	{
		$this->userinfos_mailConfirm = $userinfos_mailConfirm;
	}

	/**
	 * @return the $userinfos_mailConfirm
	 */
	public function getUserinfos_mailConfirm()
	{
		return $this->userinfos_mailConfirm;
	}

	/**
	 * @param datetime $userinfos_dateCgu
	 */
	public function setUserinfos_dateCgu($userinfos_dateCgu)
	{
		$this->userinfos_dateCgu = $userinfos_dateCgu;
	}

	/**
	 * @return the  $userinfos_dateCgu
	 */
	public function getUserinfos_dateCgu()
	{
		return $this->userinfos_dateCgu;
	}

	/**
	 * @param int $userinfos_isVendeur
	 */
	public function setUserinfos_isVendeur($userinfos_isVendeur)
	{
		$this->userinfos_isVendeur = $userinfos_isVendeur;
	}

	/**
	 * @return the  $userinfos_isVendeur
	 */
	public function getUserinfos_isVendeur()
	{
		return $this->userinfos_isVendeur;
	}

	/**
	 * @param varchar $userinfos_cp
	 */
	public function setUserinfos_cp($userinfos_cp)
	{
		$this->userinfos_cp = $userinfos_cp;
	}

	/**
	 * @return the  $userinfos_cp
	 */
	public function getUserinfos_cp()
	{
		return $this->userinfos_cp;
	}

	/**
	 * @param varchar $userinfos_ville
	 */
	public function setUserinfos_ville($userinfos_ville)
	{
		$this->userinfos_ville = $userinfos_ville;
	}

	/**
	 * @return the  $userinfos_ville
	 */
	public function getUserinfos_ville()
	{
		return $this->userinfos_ville;
	}

	/**
	 * @param varchar $userinfos_code_departement
	 */
	public function setUserinfos_code_departement($userinfos_code_departement)
	{
		$this->userinfos_code_departement = $userinfos_code_departement;
	}

	/**
	 * @return the  $userinfos_code_departement
	 */
	public function getUserinfos_code_departement()
	{
		return $this->userinfos_code_departement;
	}

	/**
	 * @param int $userinfos_code_region
	 */
	public function setUserinfos_code_region($userinfos_code_region)
	{
		$this->userinfos_code_region = $userinfos_code_region;
	}

	/**
	 * @return the  $userinfos_code_region
	 */
	public function getUserinfos_code_region()
	{
		return $this->userinfos_code_region;
	}

	/**
	 * @param int $userinfos_code_pays
	 */
	public function setUserinfos_code_pays($userinfos_code_pays)
	{
		$this->userinfos_code_pays = $userinfos_code_pays;
	}

	/**
	 * @return the  $userinfos_code_pays
	 */
	public function getUserinfos_code_pays()
	{
		return $this->userinfos_code_pays;
	}

	/**
	 * @param varchar $userinfos_adresse1
	 */
	public function setUserinfos_adresse1($userinfos_adresse1)
	{
		$this->userinfos_adresse1 = $userinfos_adresse1;
	}

	/**
	 * @return the  $userinfos_adresse1
	 */
	public function getUserinfos_adresse1()
	{
		return $this->userinfos_adresse1;
	}

	/**
	 * @param varchar $userinfos_adresse2
	 */
	public function setUserinfos_adresse2($userinfos_adresse2)
	{
		$this->userinfos_adresse2 = $userinfos_adresse2;
	}

	/**
	 * @return the  $userinfos_adresse2
	 */
	public function getUserinfos_adresse2()
	{
		return $this->userinfos_adresse2;
	}

	/**
	 * @param float $userinfos_evaluation_moyenne
	 */
	public function setUserinfos_evaluation_moyenne($userinfos_evaluation_moyenne)
	{
		$this->userinfos_evaluation_moyenne = $userinfos_evaluation_moyenne;
	}

	/**
	 * @return the  $userinfos_evaluation_moyenne
	 */
	public function getUserinfos_evaluation_moyenne()
	{
		return $this->userinfos_evaluation_moyenne;
	}

	/**
	 * @param int $userinfos_deleted
	 */
	public function setUserinfos_deleted($userinfos_deleted)
	{
		$this->userinfos_deleted = $userinfos_deleted;
	}

	/**
	 * @return the $userinfos_deleted
	 */
	public function getUserinfos_deleted()
	{
		return $this->userinfos_deleted;
	}

	/**
	 * @param datetime $userinfos_dateAdded
	 */
	public function setUserinfos_dateAdded($userinfos_dateAdded)
	{
		$this->userinfos_dateAdded = $userinfos_dateAdded;
	}

	/**
	 * @return the  $userinfos_dateAdded
	 */
	public function getUserinfos_dateAdded()
	{
		return $this->userinfos_dateAdded;
	}

	/**
	 * @param timestamp $userinfos_dateUpdated
	 */
	public function setUserinfos_dateUpdated($userinfos_dateUpdated)
	{
		$this->userinfos_dateUpdated = $userinfos_dateUpdated;
	}

	/**
	 * @return the  $userinfos_dateUpdated
	 */
	public function getUserinfos_dateUpdated()
	{
		return $this->userinfos_dateUpdated;
	}

	/**
     * Check if a route is allowed for the user
     *
     * @param string $routeName
     * @param string $role
     * @return boolean
     */
    public function isRouteAllowed($routeName,$role=null){
        if($this->user == null){
            $this->user = new User($this->userinfos_userId);
        }

        $objRoute = Zend_Controller_Front::getInstance()->getRouter();
        $objRoute =  $objRoute->getRoute($routeName);

        $defaults = $objRoute->getDefaults();
        $controller = $defaults['controller'];
        $action = $defaults['action'];

        // On vérifie d'abord dans les ACL
        $role = $this->user->getRoles();
        //Zend_Debug::dump($role);exit();

        $allowed = App_FlagFlippers_Manager::isAllowed($role, $controller, $action);

        return $allowed;
    }

    public function IsAllowed($ressource=null,$action=null){
        if($this->user == null){
            $this->user = new User($this->userinfos_userId);
        }
        // On vérifie d'abord dans les ACL
        $role = $this->user->getRoles();

        $allowed = App_FlagFlippers_Manager::isAllowed($role, $ressource, $action);

        return $allowed;

    }

    public function IsRole($role){
        if($this->user == null){
            $this->user = new User($this->userinfos_userId);
        }
        // On vérifie d'abord dans les ACL
        $roles = $this->user->getRoles();

        foreach($roles as $r){
            if($r->name == $role){
                return true;
            }
        }
        return false;
    }

    public function getIdentity(){
    	return $this->getUserinfos_prenom().' '.$this->getUserinfos_nom();
    }

}