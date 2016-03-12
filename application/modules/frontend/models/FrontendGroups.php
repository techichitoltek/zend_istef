<?php
class FrontendGroups extends App_Model_Std {

    const ROLE_FRONTEND_ADMINISTRATEUR	= 'frontend_administrateurs';
    const ROLE_FRONTEND_USER        	= 'frontend_user';

    /* Champs de la table */

    protected $id = 0;
    protected $name = null;
    protected $parent_id = 0;


    /* /Champs de la table */

    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_FrontendGroups";
        $this->_myDbPrimary         = "id";
        $this->_myMetierClassName   = "FrontendGroups";
        $this->_myDbTableName       = "zf_groups";
        $this->_myDbFieldPrefix     = "";

        if($id !== false) $this->loadById($id,$full,$champ);
    }

    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param number $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return the $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param field_type $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return the $parent_id
     */
    public function getParent_id() {
        return $this->parent_id;
    }

    /**
     * @param number $parent_id
     */
    public function setParent_id($parent_id) {
        $this->parent_id = $parent_id;
    }

}