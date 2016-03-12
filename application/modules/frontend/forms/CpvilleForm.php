<?php
/**
 * CpvilleForm - webservice cpville
 *
 * @category frontend
 * @package frontend_form
 * @copyright
 */

class CpvilleForm extends App_Frontend_Form
{

	/**
	 *
	 * @var Entreprise
	 */
	//private $_entreprise = null;

	private $_cpsearch = null;


    public function __construct($param, $controller, $options = null) {
    	if(array_key_exists("search_cp", $param)) $this->_cpsearch =  $param['search_cp'];
        parent::__construct($param, $controller, $options);
    }

    /**
     * Overrides init() in Zend_Form
     *
     * @access public
     * @return void
     */
    public function init() {

    	$validateur_cp = new Zend_Validate_PostCode('fr_FR');
    	$validate_exist = new Zend_Validate_Db_RecordExists('frontend_cpville', 'ville_code_postal');


    	$search_cp = new Zend_Form_Element_Hidden('search_cp');
    	$search_cp->setValue($this->_cpsearch);
    	$search_cp->setOptions(
    			array(
    					'validators' => array($validateur_cp,$validate_exist),
    			)
    	);
    	$this->addHiddenFields($search_cp);

    }

    public function isValid($data)
    {
    	$isValid = parent::isValid($data);
    	$errors = $this->getErrors();
    	$values = $this->getValues();
    	$select = 'undefined';
    	$errorMessage = array();
		$checkcpvalide = $errors['search_cp'];
    	if(empty($checkcpvalide)){
    		$select = $this->traitementFormData($values['search_cp']);
    	} else {
	    	$cp_erreur = $errors['search_cp'];
	    	if(count($cp_erreur)){
	    		array_push($errorMessage, $this->traitementMessageError($value));
/*	    		foreach ($cp_erreur as $key => $value){

	    		}*/
	    	}
    		$isValid = false;
    	}
    	return array($isValid,$errorMessage,$select);
    }

    public function traitementMessageError(){
    	$errors = $this->getErrors();
    	$cp_error = $errors['search_cp'];
    	if(count($cp_error)){
    		foreach ($cp_error as $key => $value){
    			switch ($value){
    				default:
						return 'Code postal non valide';
    				break;

    			}
    		}
    	}
    }

    public function traitementFormData($cp){
    	// attendu : <select class='form-control'><option>Ambérieu-en-Bugey</option><option>Saint-Didier-d'Aussiat</option></select>

    	//$select = "<select class='form-control'>";

    	$modCpville = new Cpville();
    	$matchcp = $modCpville->getListeByCodePost($cp);
    	$select = '';
    	foreach ($matchcp as $cpville): /* @var $cpville Cpville */
    		$select .= "<option value='".$cpville->getVille_code_commune()."'>".$cpville->getVille_nom_reel()."</option>";
    	endforeach;

    	//$select .= "</select>";
    	return $select;
    }

}