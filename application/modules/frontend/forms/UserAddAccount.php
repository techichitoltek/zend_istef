<?php
/**
 * UserAddAccount form
 *
 * @category mede
 * @package mede_forms
 * @copyright RCWEB
 */

class UserAddAccount extends App_Mede_Form
{


	/**
	 *
	 * @var Entreprise
	 */
	//private $_entrepriseonefile = null;



    public function __construct($param, $controller, $options = null) {
    	//if(array_key_exists("idPREPAonefile", $param)) $this->_idPREPAonefile =   $param['idPREPAonefile'];
        parent::__construct($param, $controller, $options);
    }

    /**
     * Overrides init() in Zend_Form
     *
     * @access public
     * @return void
     */
    public function init() {
    	$this->setMethod('post');


		// HIDDEN
		/*
    	$element = new Zend_Form_Element_Hidden('idAAPConefile');
    	$element->setValue($this->_idAAPConefile);
    	$this->addHiddenFields($element);
		*/


    }


    /**
     * Overrides myStdTraitement() in App_Form
     *
     * @param array $data
     * @access public
     * @return bool
     */
    public function myStdTraitement($partialValidation = false,$confirmation=2){
    	if ($this->_controller->getRequest()->isPost() && $this->_controller->getRequest()->getParam('fromForm') == $this->_form_name) {
    		$formData = false;
    		$formulaireIsValide = false;
    		if($partialValidation){
    			$formData = $this->getValidValues($_POST);
    			$formulaireIsValide = $this->isValid($_POST);
    		}else{
    			if($this->isValid($_POST)){
    				$formulaireIsValide = true;
    				$formData = $this->getValues();
    			}
    		}
    		// On traite les données du formulaires
    		if($formData){
    			$this->traitementFormData($formData,$confirmation);
    		}

    		if($formulaireIsValide){
    			$this->traitementRedirect($formData,$confirmation);

    		}else{
    			$this->traitementMessageError();
    		}

    	}
    	$this->_view->form_Addprixoffre = $this;
    	debug($this->getErrors());
    }


    public function traitementMessageError(){
/*    	$errors = $this->getErrors();

    	$retourErrorMessage = '<span class="important">Erreur(s) dans le formulaire:</span>';
    	$retourErrorMessage .= '<span class="likeTr"></span>';
    	$retourErrorMessage .= '<span style="display:block;padding-left:20px;">';

    	$retourErrorMessage .= '<span class="errorWrapModal">';
    	$retourErrorMessage .= '<span class="errorTitle"><i class="fa fa-arrow-right"></i> Veuillez indiquer prix valide.</span>';
    	$retourErrorMessage .= '<span class="errorHelp"><i class="fa fa-bullhorn"></i> Max: 9 chiffres ( 0 est exclu )</span>';
    	$retourErrorMessage .= '<span class="likeLightTr">';
    	$retourErrorMessage .= '</span>';

    	$this->_view->retourErrorMessage = $retourErrorMessage;*/
    }

    public function traitementFormData($formData,$confirmation){
    	//$formData['nomchamps']
    }

    public function traitementRedirect($formData,$confirmation){
    	//$this->_controller->getHelper("redirector")->gotoRoute(array(),"route_alias");
    }



}