<?php
class Tests extends App_Model_Std {


    /* Champs de la table */

    protected $tests_id = 0;
    protected $tests_libelle = "";
    protected $tests_int = 1;
    protected $tests_dateAdded = null;
    protected $tests_dateUpdated = null;


    /* /Champs de la table */

    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_Tests";
        $this->_myDbPrimary         = "tests_id";
        $this->_myMetierClassName   = "Metier_Tests";
        $this->_myDbTableName       = "zf_tests";
        $this->_myDbFieldPrefix     = "tests";
        if($id !== false) $this->loadById($id,$full,$champ);
    }

    /**
     * @return the $tests_id
     */
    public function getTests_id() {
        return $this->tests_id;
    }

    /**
     * @param number $tests_id
     */
    public function setTests_id($tests_id) {
        $this->tests_id = $tests_id;
    }

    /**
     * @return the $tests_libelle
     */
    public function getTests_libelle() {
        return $this->tests_libelle;
    }

    /**
     * @param string $tests_libelle
     */
    public function setTests_libelle($tests_libelle) {
        $this->tests_libelle = $tests_libelle;
    }

    /**
     * @return the $tests_int
     */
    public function getTests_int() {
        return $this->tests_int;
    }

    /**
     * @param number $tests_int
     */
    public function setTests_int($tests_int) {
        $this->tests_int = $tests_int;
    }

    /**
     * @return the $tests_dateAdded
     */
    public function getTests_dateAdded() {
        return $this->tests_dateAdded;
    }

    /**
     * @param string $tests_dateAdded
     */
    public function setTests_dateAdded($tests_dateAdded) {
        $this->tests_dateAdded = $tests_dateAdded;
    }

    /**
     * @return the $tests_dateUpdated
     */
    public function getTests_dateUpdated() {
        return $this->tests_dateUpdated;
    }

    /**
     * @param string $tests_dateUpdated
     */
    public function setTests_dateUpdated($tests_dateUpdated) {
        $this->tests_dateUpdated = $tests_dateUpdated;
    }




}