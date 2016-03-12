<?php
/**
 *  models/Metier/Commentaire.php
 */


/**
 * Générateur version 2.0
 */
class Commentaire extends App_Model_Std {


	/* Champs de la table */

	protected $comment_id = 0;
	protected $comment_texte = null;
	protected $comment_incidentId = null;
	protected $comment_dateAdded = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Commentaire";
		$this->_myDbPrimary         = "comment_id";
		$this->_myMetierClassName   = "Commentaire";
		$this->_myDbTableName       = "filrouge_commentaire";
		$this->_myDbFieldPrefix     = "comment";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $comment_id
	 */
	public function setComment_id($comment_id)
	{
		$this->comment_id = $comment_id;
	}

	/**
	 * @return the $comment_id
	 */
	public function getComment_id()
	{
		return $this->comment_id;
	}

	/**
	 * @param varchar $comment_texte
	 */
	public function setComment_texte($comment_texte)
	{
		$this->comment_texte = $comment_texte;
	}

	/**
	 * @return the $comment_texte
	 */
	public function getComment_texte()
	{
		return $this->comment_texte;
	}

	/**
	 * @param int $comment_incidentId
	 */
	public function setComment_incidentId($comment_incidentId)
	{
		$this->comment_incidentId = $comment_incidentId;
	}

	/**
	 * @return the $comment_incidentId
	 */
	public function getComment_incidentId()
	{
		return $this->comment_incidentId;
	}

	/**
	 * @param timestamp $comment_dateAdded
	 */
	public function setComment_dateAdded($comment_dateAdded)
	{
		$this->comment_dateAdded = $comment_dateAdded;
	}

	/**
	 * @return the $comment_dateAdded
	 */
	public function getComment_dateAdded()
	{
		return $this->comment_dateAdded;
	}


}