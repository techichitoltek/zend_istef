<?php
/**
 *  models/Metier/Users.php
 */


/**
 * Générateur version 2.0
 */
class Users extends App_Model_Std {


	/* Champs de la table */

	protected $user_id = 0;
	protected $user_mail = '';
	protected $user_pseudo = null;
	protected $user_pwd = null;
	protected $user_avatar = null;
	protected $user_notification = null;
	protected $user_nbsignalements = null;
	protected $user_seuilcredibilite = null;
	protected $user_dateAdded = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Users";
		$this->_myDbPrimary         = "user_id";
		$this->_myMetierClassName   = "Users";
		$this->_myDbTableName       = "filrouge_users";
		$this->_myDbFieldPrefix     = "user";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $user_id
	 */
	public function setUser_id($user_id)
	{
		$this->user_id = $user_id;
	}

	/**
	 * @return the $user_id
	 */
	public function getUser_id()
	{
		return $this->user_id;
	}

	/**
	 * @param string $user_mail
	 */
	public function setUser_mail($user_mail)
	{
		$this->user_mail = $user_mail;
	}

	/**
	 * @return the $user_mail
	 */
	public function getUser_mail()
	{
		return $this->user_mail;
	}

	/**
	 * @param varchar $user_pseudo
	 */
	public function setUser_pseudo($user_pseudo)
	{
		$this->user_pseudo = $user_pseudo;
	}

	/**
	 * @return the $user_pseudo
	 */
	public function getUser_pseudo()
	{
		return $this->user_pseudo;
	}

	/**
	 * @param varchar $user_pwd
	 */
	public function setUser_pwd($user_pwd)
	{
		$this->user_pwd = $user_pwd;
	}

	/**
	 * @return the $user_pwd
	 */
	public function getUser_pwd()
	{
		return $this->user_pwd;
	}

	/**
	 * @param varchar $user_avatar
	 */
	public function setUser_avatar($user_avatar)
	{
		$this->user_avatar = $user_avatar;
	}

	/**
	 * @return the $user_avatar
	 */
	public function getUser_avatar()
	{
		return $this->user_avatar;
	}

	/**
	 * @param int $user_notification
	 */
	public function setUser_notification($user_notification)
	{
		$this->user_notification = $user_notification;
	}

	/**
	 * @return the $user_notification
	 */
	public function getUser_notification()
	{
		return $this->user_notification;
	}

	/**
	 * @param int $user_nbsignalements
	 */
	public function setUser_nbsignalements($user_nbsignalements)
	{
		$this->user_nbsignalements = $user_nbsignalements;
	}

	/**
	 * @return the $user_nbsignalements
	 */
	public function getUser_nbsignalements()
	{
		return $this->user_nbsignalements;
	}

	/**
	 * @param int $user_seuilcredibilite
	 */
	public function setUser_seuilcredibilite($user_seuilcredibilite)
	{
		$this->user_seuilcredibilite = $user_seuilcredibilite;
	}

	/**
	 * @return the $user_seuilcredibilite
	 */
	public function getUser_seuilcredibilite()
	{
		return $this->user_seuilcredibilite;
	}

	/**
	 * @param timestamp $user_dateAdded
	 */
	public function setUser_dateAdded($user_dateAdded)
	{
		$this->user_dateAdded = $user_dateAdded;
	}

	/**
	 * @return the $user_dateAdded
	 */
	public function getUser_dateAdded()
	{
		return $this->user_dateAdded;
	}


}