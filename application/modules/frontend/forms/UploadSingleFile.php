<?php
/**
 * UploadSingleFile form
 *
 * @category mede
 * @package mede_forms
 * @copyright RCWEB
 */

class UploadSingleFile extends App_Mede_Form
{

	private $_isInvalidFile = false;
	private $_isEmptyFile = false;


	private $_idAAPConefile = null;
	private $_idPREPAonefile = null;
	//private $_getDceIdonefile = null;
	private $_getBibIdonefile = null;
	private $_userPreparationIdonefile = null;
	/**
	 *
	 * @var Entreprise
	 */
	private $_entrepriseonefile = null;

	/**
	 *
	 * @var Preparation
	 */
	private $_modelPreparation = null;
	private $_stage = null;
	private $_page = null;


    public function __construct($param, $controller, $options = null) {
    	if(array_key_exists("idAAPConefile", $param)) {
    		$this->_idAAPConefile =   $param['idAAPConefile'];
    		//debug('recuperation param aapc id: '.$this->_idAAPConefile);
    		$this->_modelPreparation = new Preparation($this->_idAAPConefile,false,"prepa_aapcId");
    	}
    	if(array_key_exists("idPREPAonefile", $param)) $this->_idPREPAonefile =   $param['idPREPAonefile'];
    	if(array_key_exists("entrepriseonefile", $param)) $this->_entrepriseonefile =   $param['entrepriseonefile'];
    	if(array_key_exists("userPreparationIdonefile", $param)) $this->_userPreparationIdonefile =   $param['userPreparationIdonefile'];

    	if(array_key_exists("page", $param)) $this->_page =   $param['page'];
    	if(array_key_exists("stage", $param)) $this->_stage =   $param['stage'];
    	/*if(array_key_exists("idDce", $param)) $this->_idDce =   $param['idDce'];*/

    	/*if(array_key_exists("idBibliotheque", $param)){
    		$this->_idBibliotheque =  $param['idBibliotheque'];
    		$modelPreparationDce = new PreparationDce($param['idBibliotheque'],false,"dce_bibliothequeId");
    		$this->_idDce = $modelPreparationDce->getDce_id();
    	}*/

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

    	$element = new Zend_Form_Element_Hidden('idAAPConefile');
    	$element->setValue($this->_idAAPConefile);
    	$this->addHiddenFields($element);

    	$element = new Zend_Form_Element_Hidden('idPREPAonefile');
    	$element->setValue($this->_idPREPAonefile);
    	$this->addHiddenFields($element);


		// field file
    	/*$element = new Zend_Form_Element_File('newDceFileFile');
    	$filePath = MEDE_PREPA_PATH_ABS. '/'.$this->_entrepriseonefileonefile->getEnt_siren().MEDE_BIBLIOTHEQUE_PATH_ABS;
    	$element->setDestination($filePath)->setValueDisabled(true); // ->setValueDisabled(true) : empeche fichier charger && permet controlleur get values)
    	$element->addValidator('Count', false, 1);
    	$element->addValidator('ExcludeExtension', false, 'zip');
    	$element->setAttrib("style", "width:260px;");
    	$element->setAttrib("class", "fileInput");
    	$element->setLabel('Document:');
    	$element->setDecorators(array('File'));
    	$element->setRequired(true);
    	$this->addElement($element);*/

    	$element = new Zend_Form_Element_File('newDceFileFile');
    	$filePath = MEDE_PREPA_PATH_ABS. '/'.$this->_entrepriseonefile->getEnt_siren().MEDE_BIBLIOTHEQUE_PATH_ABS.'/'.$this->_idPREPAonefile.'/Dce';
    	$element->setDestination($filePath);
    	$element->setValueDisabled(true); // ->setValueDisabled(true) : empeche fichier charger && permet controlleur get values)
    	$element->addValidator('Count', false, 1);
    	$element->setAttrib("data-buttonText"," Sélectionner le fichier");
    	$element->setAttrib("class", "filestyle");
    	$element->setAttrib("style", "width:303px;display: none;"); /* !important display none to display bootstrap nice upload button */
    	//$element->setAttrib("class", "fileInput");
    	$element->setLabel('Document:');
    	$element->setDecorators(array('File'));
    	$this->addElement($element);



    	// field intitule
    	$element = new Zend_Form_Element_Text('newDceIntitule');

    		// custom validator -- check if intitule already exist
    		// recherche libelle dans la bibliotheque - /entreprise /idprepa(via liste idBibByIdprepa type bibliotheque 0 (dce -- concretement on laisse la possibilité de nommer un dce comme un document autre que type 0 (document de preparation ou prédéfinis ou de type 0 sur un autre idPrepa)



    	$validator_NOBibliothequeIntituleExists = new App_Validate_NOBibliothequeIntituleExists(null,$this->_entrepriseonefile->getEnt_id(),null,null,0,null);
    	//$validator_regexMatchLibelleBibliotheque = new Zend_Validate_Regex('/^[\sa-zA-Z0-9ÀÂÇÈÉÊËÎÔÙÛàâçèéêëîôöùû\.\(\)\[\]\"\'\-,;:\/!\?]{3,125}/');

    	$validator_regexMatchLibelleBibliotheque = new Zend_Validate_Regex('/^[a-zA-Z0-9ÀÂÇÈÉÊËÎÔÙÛàâçèéêëîôöùû\- _.]{3,125}+$/i');

    	$validatorSelectionArray = array('NotEmpty',$validator_regexMatchLibelleBibliotheque);

    	//debug($this->_modelPreparation);
		if($this->_modelPreparation->getPrepa_dce()){
			$modelPreparationDce = new PreparationDce();
			$idBibByIdprepa = array();
			$idBibByIdprepa = (count($modelPreparationDce->getListeByprepaIdALL($this->_idPREPAonefile,true)))? $modelPreparationDce->getListeByprepaIdALL($this->_idPREPAonefile,true) : null;
			//debug($idBibByIdprepa);
			$validator_NOBibliothequeIntituleExists = new App_Validate_NOBibliothequeIntituleExists(null,$this->_entrepriseonefile->getEnt_id(),null,null,0,$idBibByIdprepa);
			array_push($validatorSelectionArray, $validator_NOBibliothequeIntituleExists);
		}



			//public function __construct(Zend_Form_Element $element = NULL, $entId = NULL, $prepaState = NULL, $excludeThis = NULL, $bibliothequeType = NULL, $idBibliothequeArray = NULL) {


    	$element->setOptions(
    			array(
    					'required'   => TRUE,
    					'validators' => $validatorSelectionArray,
    			)
    	);
    	$element->setAttrib("style", "width:260px");
    	$element->setAttrib("maxlength", "125");
    	$element->setRequired(true);
    	$this->addElement($element);




		// field commentaire
    	$validator_regexMatchCommentaireBibliotheque = new Zend_Validate_Regex('/^[\sa-zA-Z0-9ÀÂÇÈÉÊËÎÔÙÛàâçèéêëîôöùû\.\(\)\[\]\"\'\-,;:\/!\?]{3,255}/');
    	$element = new Zend_Form_Element_Text('newDceCommentaire');
    	$element->setOptions(
    			array(
    					'validators' => array(
    							$validator_regexMatchCommentaireBibliotheque,
    					),
    			)
    	);
    	$element->setAttrib("style", "width:260px");
    	$element->setAttrib("maxlength", "255");
    	$this->addElement($element);
    }


    /**
     * Overrides myStdTraitement() in App_Form
     *
     * @param array $data
     * @access public
     * @return bool
     */
    public function myStdTraitement($partialValidation = false,$confirmation=2){
    	//debug('mystdtraitement en cours!');
    	if ($this->_controller->getRequest()->isPost() && $this->_controller->getRequest()->getParam('fromForm') == $this->_form_name) { // si méthode post && requete provient bien du formulaire MajDocDceForm.php
    		$formData = false;
    		$formulaireIsValide = false;

    		if($partialValidation){
    			// recupération type mime / extension du fichier -- chargement requis via traitementFormData
    			if($this->_isInvalidFile){
    				//debug('invalid file in PARTIAL VALIDATION');
    				$formulaireIsValide = false; $formData = false;
    				$this->traitementMessageError();
    			}
    		}else{

    			if($this->isValid($_POST)){
    				$formData = $this->getValues();

    				if(NULL !== $formData['newDceFileFile']){
    					//debug('file is not null');
    					$formulaireIsValide = true;
    					$this->_isEmptyFile = false;
    				} else {
    					//debug('file is null detected');
    					//$formData = false;
    					$this->_isEmptyFile = true;
    					//$this->_view->isEmptyFile = true;
    				}
    			}
    		}

    		if($formData){
    			if(NULL === $formData['newDceFileFile']) {
    				$this->_isEmptyFile = true;
    			} else $this->_isEmptyFile = false;
    			$this->traitementFormData($formData,$confirmation);
    		}

    		if($formulaireIsValide){
    			if(NULL === $formData['newDceFileFile']) {
    				$this->_isEmptyFile = true;
    				$formulaireIsValide = false;
    				$this->traitementMessageError();
    			} else $this->_isEmptyFile = false;

    			$this->traitementRedirect($formData,$confirmation);

    		}else{

    			$formData = $this->getValues();
    			if(NULL === $formData['newDceFileFile']) {
    				$this->_isEmptyFile = true;
    			} else $this->_isEmptyFile = false;

    			$this->traitementMessageError();
    		}

    	}
    	debug($this->getValues());
    	debug($this->getErrors());
    	$this->_view->form_AddDceFileFile = $this;
    }


    public function traitementMessageError(){
    	$errors = $this->getErrors();
    	/*debug('we are message errror');
    	debug($errors);*/
    	$retourErrorMessage = '<span class="important">Erreur(s) dans le formulaire:</span>';
    	$retourErrorMessage .= '<span class="likeTr"></span>';
    	$retourErrorMessage .= '<span style="display:block;padding-left:20px;">';


    	// field "fichier"
    	$errFile_File = $errors['newDceFileFile'];
    	if(count($errFile_File)){
    		$retourErrorMessage .= '<span class="errorWrapModal">';
    		$retourErrorMessage .= '<span class="errorTitle"><i class="fa fa-arrow-right"></i> Veuillez sélectionner le fichier à ajouter au DCE.</span>';
    		$retourErrorMessage .= '<span class="errorHelp"><i class="fa fa-bullhorn"></i> Les fichiers compressés de type archive ne sont pas acceptés.</span>';
    		$retourErrorMessage .= '<span class="likeLightTr">';
    		$retourErrorMessage .= '</span>';
    	}

    	if($this->_isInvalidFile){
    		$retourErrorMessage .= '<span class="errorWrapModal">';
    		$retourErrorMessage .= '<span class="errorTitle"><i class="fa fa-arrow-right"></i> Veuillez sélectionner un fichier valide.</span>';
    		$retourErrorMessage .= '<span class="errorHelp"><i class="fa fa-bullhorn"></i> Les fichiers de type archive ou les fichiers compressés ne sont pas autorisés.<br>Un seul fichier par envoi.</span>';
    		$retourErrorMessage .= '<span class="likeLightTr">';
    		$retourErrorMessage .= '</span>';
    	}
    	if($this->_isEmptyFile){
    		$retourErrorMessage .= '<span class="errorWrapModal">';
    		$retourErrorMessage .= '<span class="errorTitle"><i class="fa fa-arrow-right"></i> Veuillez sélectionner le fichier à ajouter au DCE.</span>';
    		$retourErrorMessage .= '<span class="likeLightTr">';
    		$retourErrorMessage .= '</span>';
    	}


    	$err_newDceIntitule = $errors['newDceIntitule'];
    	if(count($err_newDceIntitule)){

    		foreach ($err_newDceIntitule as $key => $value){
    			switch ($value){
    				case 'regexNotMatch':
    					$retourErrorMessage .= '<span class="errorWrapModal">';
    					$retourErrorMessage .= '<span class="errorTitle"><i class="fa fa-arrow-right"></i> Veuillez indiquer un intitulé valide.</span>';
    					$retourErrorMessage .= '<span class="errorHelp"><i class="fa fa-bullhorn"></i> <u>Ne pas utiliser</u> de caractères spéciaux ou de ponctuation tels que :;\'*&amp;[ et indiquer au moins 3 caractères.</span>';
    					$retourErrorMessage .= '<span class="errorHelp">Cet intitulé fait office de nom de fichier lorsque vous téléchargez le fichier.';
    					$retourErrorMessage .= '<br>Pour optimiser la compatibilité sur les différents systèmes, évitez au possible les caractères accentués et les espaces (que vous pouvez remplacer par le tiret "-" ou l\'underscore "_").</span>';
    					$retourErrorMessage .= '<span class="likeLightTr">';
    					$retourErrorMessage .= '</span>';
    				break;

    				case 'intituleBibliothequeEXIST':
    					$retourErrorMessage .= '<span class="errorWrapModal">';
    					$retourErrorMessage .= '<span class="errorTitle"><i class="fa fa-arrow-right"></i> Cet intitulé est déjà utilisé par un document du DCE. Veuillez en choisir un autre.</span>';
    					$retourErrorMessage .= '<span class="likeLightTr">';
    					$retourErrorMessage .= '</span>';
    				break;
    			}
    		}
    	}



    	$err_newDceCommentaire = $errors['newDceCommentaire'];
    	if(count($err_newDceCommentaire)){
    		$retourErrorMessage .= '<span class="errorWrapModal">';
    		$retourErrorMessage .= '<span class="errorTitle"><i class="fa fa-arrow-right"></i> Veuillez indiquer un commentaire valide.</span>';
    		$retourErrorMessage .= '<span class="errorHelp"><i class="fa fa-bullhorn"></i> <u>Ne pas utiliser</u> de caractères spéciaux tels que *&amp;[ et indiquer au moins 3 caractères.</span>';
    		$retourErrorMessage .= '<span class="likeLightTr">';
    		$retourErrorMessage .= '</span>';

    	}

    	$this->_view->retourErrorMessageFileFile = $retourErrorMessage;



    }


    public function traitementFormData($formData,$confirmation){

    	function clean($string) {
    		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    	}

    	function friendly_url($url,$isFolder,$idPrepa) {
    		// everything to lower and no spaces begin or end
    		$url = strtolower(trim($url));
    		$pathArray = explode("/", $url);
    		$limiteArray = count($pathArray)-1;
    		if (in_array("", $pathArray)) $limiteArray--;
    		$type = ($isFolder)? 'dossier':'fichier';
    		//echo '<br>est un '.$type;


    		$builUrl = ''; $separator = '/';
    		for($i=0;$i<=$limiteArray;$i++):

    		$find = array(' ', '&', '+',',');
    		$pathArray[$i] = str_replace ($find, '-', $pathArray[$i]);

    		//delete and replace rest of special chars
    		$find = array('/[^a-z0-9-<>]/', '/[-]+/', '/<[^>]*>/');
    		$repl = array('-', '-', '');
    		$pathArray[$i] = preg_replace ($find, $repl, $pathArray[$i]);

    		if(!$isFolder  && $i==$limiteArray){
    			$separator = '';
    		}
    		$builUrl .= $pathArray[$i].$separator;
    		endfor;

    		$modelDce = new PreparationDce();
    		if($modelDce->ISpathAlreadyExist($builUrl, $idPrepa)){
    			$builUrl = uniqid().'_'.$builUrl;
    		}


    		//return the friendly url
    		return $builUrl;
    	}


		// update file
		$adapter = $this->getElement('newDceFileFile')->getTransferAdapter();
		if ($adapter->isUploaded('newDceFileFile')) {
			$values = $this->getValues();
			//debug($values);
			$filePath = MEDE_PREPA_PATH_ABS. '/'.$this->_entrepriseonefile->getEnt_siren().MEDE_BIBLIOTHEQUE_PATH_ABS.'/'.$this->_idPREPAonefile.'/Dce';
			//debug($filePath);
			$adapter = $this->getElement('newDceFileFile')->getTransferAdapter();
			$formFileArray = pathinfo($adapter->getFileName()); // tableau ['dirname'] ['filename'] ['extension'] ['basename']
			//debug($formFileArray); // get mime
			$oldname = $formFileArray['filename'];
			$path = friendly_url($oldname, false,$this->_idPREPAonefile);
			$newname = uniqid('user_',true).'.'.$formFileArray['extension'];
			//debug('new name: '.$newname);
			$adapter->addFilter('Rename', $newname);

			// detect archive mimetype

			if ($adapter->receive()){
				//debug('its receive');

				$file_url = MEDE_PREPA_PATH_ABS. '/'.$this->_entrepriseonefile->getEnt_siren().MEDE_BIBLIOTHEQUE_PATH_ABS.'/'.$this->_idPREPAonefile.'/Dce/'.$newname;
				//debug('file url: '.$file_url);
				$modelBibliotheque = new Bibliotheque();
				$mimetype = $modelBibliotheque->getFileMimeType($file_url);
				$extension = $formFileArray['extension'];
				//debug('recup mime type via myStdTraitement: '.$mimetype);
				//debug('recup extension type via myStdTraitement: '.$extension);

				$libelle = $values['newDceIntitule'];
				/*$libelle = clean($values['newDceIntitule']);
				if($modelBibliotheque->libelleExist($libelle, $this->_entrepriseonefile->getEnt_id(),null,0)){
					$libelle = uniqid().'_'.$libelle;
				}*/

				if($modelBibliotheque->addFileBibliothequeHasGoodMimeType($mimetype,$extension)){
					$modelBibliotheque = new Bibliotheque();
					$modelBibliotheque->setBibliotheque_libelle($libelle);
					$modelBibliotheque->setBibliotheque_commentaire($values['newDceCommentaire']);
					$modelBibliotheque->setBibliotheque_entId($this->_entrepriseonefile->getEnt_id());
					$modelBibliotheque->setBibliotheque_type(0); // 0 pour document de type DCE
					$modelBibliotheque->setBibliotheque_prepaUserId($this->_userPreparationIdonefile);
					$modelBibliotheque->setBibliotheque_fichier('/'.$this->_idPREPAonefile.'/Dce/'.$newname);
					$modelBibliotheque->setBibliotheque_originalfilename($oldname.'.'.$formFileArray['extension']);

					$modelPreparation = new Preparation($this->_idPREPAonefile);

					/* A CONFIRMER -- NE FAIT PAS PARTIE DES SPECS - les dce associes a idPrepa doivent être inclus dans l'archive de "dossiers à archiver" */
					/*if($modelPreparation->getPrepa_state() > 0){
						$modelBibliotheque->setBibliotheque_used(1);
					}*/
					$modelBibliotheque->save();

					$modelPreparationDce = new PreparationDce();
					$modelPreparationDce->setDce_prepaId($this->_idPREPAonefile);
					$modelPreparationDce->setDce_path($path);
					$modelPreparationDce->setDce_level(1);
					$modelPreparationDce->setDce_bibliothequeId($modelBibliotheque->getBibliotheque_id());
					$modelPreparationDce->save();



					if ($modelPreparation->getPrepa_dce() == 0) {
						$modelPreparation->setPrepa_dce(1);
						$modelPreparation->save();
					}

				} else {
					//debug('type mime fichier invalide dans traitementFormData');
					$this->_isInvalidFile = true; // for partial validation
					$this->_view->formIsValidFileValide = false;
					$this->myStdTraitement($partialValidation = true,$confirmation=2); // relance en mode partial
					unlink($file_url);
				}
			}




		} /* else debug('$adapter uploadfile failed');*/



    }

    public function traitementRedirect($formData,$confirmation){
    	//debug('we traitementRedirect');
        $this->_controller->getHelper("redirector")->gotoRoute(array("page"=>$this->_page,"stage"=>$this->_stage,"idPrepa"=>$this->_idPREPAonefile),"prepa_dceliste");
    }

}