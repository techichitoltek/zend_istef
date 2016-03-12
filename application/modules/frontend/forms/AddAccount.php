<?php
/**
 * AddAccount - Ajouter un compte Acheteur && vendeur
 *
 * @category frontend
 * @package frontend_form
 * @copyright
 */

class AddAccount extends App_Frontend_Form
{
	Use Tools;
	/**
	 *
	 * @var User
	 */
	private $_user = null;



    public function __construct($param, $controller, $options = null) {
    	//if(array_key_exists("stageUrl", $param)) $this->_stageUrl =  $param['stageUrl'];
        parent::__construct($param, $controller, $options);
    }

    /**
     * Overrides init() in Zend_Form
     *
     * @access public
     * @return void
     */
    public function init() {
    	// init the parent
    	parent::init();

    	// set the form's method
    	$this->setMethod('post');

    	$regex_name = new Zend_Validate_Regex('/^[a-zA-Z0-9]{1,200}/');
    	$regex_location = new Zend_Validate_Regex('/^[a-zA-Z0-9]{1,255}/');
    	$regex_code_commune = new Zend_Validate_Regex('/^[a-zA-Z0-9]{5}/');
    	$regex_location_facultatif = new Zend_Validate_Regex('/^[a-zA-Z0-9]{1,255}/');
    	$regex_phone = new Zend_Validate_Regex('/^[0-9]{10}/');
    	$regex_pwd = new Zend_Validate_Regex('/^[a-zA-Z0-9]{8,50}/');
    	$validate_email = new Zend_Validate_EmailAddress();
    	$validate_not_exist = new Zend_Validate_Db_NoRecordExists('frontend_users_infos', 'userinfos_mail');
    	$validate_cp = new Zend_Validate_PostCode('fr_FR');


    	// Ville hidden
    	$code_commune = new Zend_Form_Element_Hidden('code_commune');
    	$code_commune->setValue($this->_cpsearch);
    	$code_commune->setOptions(
    			array(
    					'validators' => array($regex_code_commune),
    			)
    	);
    	$this->addHiddenFields($code_commune);

    	// nom
    	$element = new Zend_Form_Element_Text('nom');
    	$element->addFilters(array('StringTrim', 'StripTags'));
    	$element->setOptions(
    			array(
    					'required'   => TRUE,
    					'validators' => array($regex_name),
    			)
    	);
    	$element->setAttrib("class", "form-control");
    	$element->setAttrib("maxlength", "125");
    	$this->addElement($element);


    	// Prénom
    	$element = new Zend_Form_Element_Text('prenom');
    	$element->addFilters(array('StringTrim', 'StripTags'));
    	$element->setOptions(
    			array(
    					'required'   => TRUE,
    					'validators' => array($regex_name),
    			)
    	);
    	$element->setAttrib("class", "form-control");
    	$element->setAttrib("maxlength", "125");
    	$this->addElement($element);

    	// Mot de passe
    	$element = new Zend_Form_Element_Password('password');
    	$element->addFilters(array('StringTrim', 'StripTags'));
    	$element->setOptions(
    			array(
    					'required'   => TRUE,
    					'validators' => array($regex_name),
    			)
    	);
    	$element->setAttrib("class", "form-control");
    	$element->setAttrib("maxlength", "40");
    	$this->addElement($element);

    	// confirmation mot de passe
    	$element = new Zend_Form_Element_Password('passwordconfirm');
    	$element->addFilters(array('StringTrim', 'StripTags'));
    	if(@$_POST['password'] && @$_POST['password']!=''){
    		$validate_same_pwd = new Zend_Validate_Identical(@$_POST['password']);
    		$validate_pwd = array('required'   => TRUE,'validators' => array($validate_same_pwd));
    		$element->setOptions($validate_pwd);
    	}
    	$element->setAttrib("class", "form-control");
    	$element->setAttrib("maxlength", "40");
    	$this->addElement($element);


    	// Type de compte (acheteur OU acheteur+vendeur)
    	$element = new Zend_Form_Element_Radio('typeaccount');
    	$element->setMultiOptions(array(
    			'0' => 'Compte gratuit [ Acheteur ]',
    			'1' => 'Compte payant [ Acheteur + Vendeur ]'
    	));

    	$element->setAttrib('label_class', 'giveInfo');
    	$element->setValue(0);
    	$element->setAttrib("style", "cursor:pointer;");
    	$element->setSeparator(''); // retir br separator to display inline
    	$this->addElement($element);

    	// Compte vendeur -- Type de vendeur
    	$element = new Zend_Form_Element_Radio('typevendeur');
    	$element->setMultiOptions(array(
    			'1' => 'Vous êtes un particulier',
    			'0' => 'Vous êtes un professionnel'
    	));
    	$element->setAttrib('label_class', 'giveInfo');
    	//$element->setValue(1);
    	if(@$_POST['typeaccount']=="1"){
    		$this->_view->showvendeur = true;
    		$element->setOptions(
    				array(
    						'required'   => TRUE,
    				)
    		);
    	}
    	$element->setAttrib("style", "cursor:pointer;");
    	$element->setSeparator(''); // retir br separator to display inline
    	$this->addElement($element);



    	// cp
    	$element = new Zend_Form_Element_Text('cp');
    	$element->addFilters(array('StringTrim', 'StripTags'));
    	$element->setOptions(
    			array(
    					'required'   => TRUE,
    					'validators' => array($validate_cp),
    			)
    	);
    	$element->setAttrib("class", "form-control");
    	$element->setAttrib("maxlength", "7");
    	$element->setAttrib("onblur", "chgCommune()");
    	$this->addElement($element);

    	// ville -- check si value(code_insee)==ville_code_postal(cpville) pour les malins
    	$element = new Zend_Form_Element_Select('ville');

    //-------


    	$element = new Zend_Form_Element_Select('ville');
    	if(@$_POST['cp'] !='' ){
    		$villes_array = array();
    		$mod_cpville = new Cpville();
    		$listecpville = $mod_cpville->getListeByCodePost(@$_POST['cp']);
    		foreach($listecpville as $cpville){/* @var $cpville Cpville */
    			$villes_array[$cpville->getVille_code_commune()] = $cpville->getVille_nom_reel();
    		}
    		$element->addMultiOptions($villes_array);


    		debug('on a bien un cp');
    		//$inseeSelected = new Insee('0'.@$_POST['ville']);
    		//$tabVille = array();
    		//$listeVilles = $mod_cpville->getListeByCodePost( @$_POST['cp']);
    		//foreach ($listeVilles as $cpville): /* @var $cpville Cpville */

    		//endforeach;



    		//$elt->setRequired(true)
    		//->addValidator('NotEmpty', true, array('messages' => "La ville est obligatoire"));
    	}

    //-------

    	$element->addFilters(array('StringTrim', 'StripTags'));
    	$element->setOptions(
    			array(
    					'required'   => TRUE,
    					'validators' => array($regex_code_commune),
    			)
    	);
    	$element->setAttrib("class", "form-control");
    	$element->setAttrib("maxlength", "255");
    	$this->addElement($element);

    	// adresse 1
    	$element = new Zend_Form_Element_Text('adresse1');
    	$element->addFilters(array('StringTrim', 'StripTags'));
    	$element->setOptions(
    			array(
    					'required'   => TRUE,
    					'validators' => array($regex_location),
    			)
    	);
    	$element->setAttrib("class", "form-control");
    	$element->setAttrib("maxlength", "255");
    	$this->addElement($element);


    	// adresse 2
    	$element = new Zend_Form_Element_Text('adresse2');
    	$element->addFilters(array('StringTrim', 'StripTags'));
    	$element->setOptions(
    			array(
    					'validators' => array($regex_location_facultatif),
    			)
    	);
    	$element->setAttrib("class", "form-control");
    	$element->setAttrib("maxlength", "255");
    	$this->addElement($element);

    	// téléphone
    	$element = new Zend_Form_Element_Text('phone');
    	$element->addFilters(array('StringTrim', 'StripTags'));
    	$element->setOptions(
    			array(
    					'required'   => TRUE,
    					'validators' => array($regex_phone),
    			)
    	);
    	$element->setAttrib("class", "form-control");
    	$element->setAttrib("maxlength", "10");
    	$this->addElement($element);

    	// email
    	$element = new Zend_Form_Element_Text('mail');
    	$element->addFilters(array('StringTrim', 'StripTags'));
    	$element->setOptions(
    			array(
    					'required'   => TRUE,
    					'validators' => array($validate_not_exist,$validate_email),
    			)
    	);
    	$element->setAttrib("class", "form-control");
    	$element->setAttrib("maxlength", "255");
    	$this->addElement($element);

    	// checkbox cgu
    	$element = new Zend_Form_Element_Checkbox('"checkCGU" ','checkCGU',
    			array(	'checkedValue'  => 1,
    					'uncheckedValue' => 0
    			)
    	);
    	//$element  ->setLabel('winMarche?');
/*    	if($this->_oldAttributaire == '*WIN*'){
    		$element->setValue(1);
    	} else $element->setValue(0);*/
    	$this->addElement($element);


    	// $validator_NoLibellePreparationEnveloppeExist = new App_Validate_NoLibellePreparationEnveloppeExist(null ,$this->_prepaId,null,$this->_stageUrl);

    	/*
    	// nom
    	 $element = new Zend_Form_Element_Text('nom');
    	$element->addFilters(array('StringTrim', 'StripTags'));
    	$element->setOptions(
    			array(
    					'required'   => TRUE,
    					'validators' => $validatorSelected,
    			)
    	);
    	$element->setAttrib("style", "width:303px");
    	$element->setAttrib("maxlength", "125");
    	$this->addElement($element);*/

    }


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
    		if($formData){
    			$this->traitementFormData($formData,$confirmation);
    		}

    		if($formulaireIsValide){
    			$this->traitementRedirect($formData,$confirmation);

    		}else{
    			$this->traitementMessageError();
    		}

    	}
    	debug($this->getErrors());
    	debug($this->getValues());
    	$this->_view->form_addaccount = $this;
    }

    public function traitementMessageError(){
    	$errors = $this->getErrors();

		// nom
    	$libelle_err = '';
		$err_nom = $errors['nom'];
		if(count($err_nom)){
			foreach ($err_nom as $key => $value){
				switch ($value){
					case 'isEmpty':	$libelle_err = 'Veuillez renseigner votre nom.';break;
					default:$libelle_err = 'Nom non valide.';break;
				}
			}
		}
    	$this->_view->err_nom = $libelle_err;

    	// prenom
    	$libelle_err = '';
    	$err_prenom = $errors['prenom'];
    	if(count($err_prenom)){
    		foreach ($err_prenom as $key => $value){
    			switch ($value){
    				case 'isEmpty':	$libelle_err = 'Veuillez renseigner votre prénom.';break;
    				default:$libelle_err = 'Prénom non valide.';break;
    			}
    		}
    	}
    	$this->_view->err_prenom = $libelle_err;

    	// mot de passe
    	$libelle_err = '';
    	$err_password = $errors['password'];
    	if(count($err_password)){
    		foreach ($err_password as $key => $value){
    			switch ($value){
    				case 'isEmpty':	$libelle_err = 'Veuillez renseigner votre mot de passe.';break;
    				default:$libelle_err = 'Mot de passe non valide.';break;
    			}
    		}
    	}
    	$this->_view->err_password = $libelle_err;

    	// confirmation mot de passe
    	$libelle_err = '';
    	$err_passwordconfirm = $errors['passwordconfirm'];
    	if(count($err_passwordconfirm)){
    		foreach ($err_passwordconfirm as $key => $value){
    			switch ($value){
    				case 'isEmpty':	$libelle_err = 'Veuillez confirmer votre mot de passe.';break;
    				default:$libelle_err = 'Les deux mots de passe ne sont pas identiques.';break;
    			}
    		}
    	}
    	$this->_view->err_passwordconfirm = $libelle_err;

    	// type de compte
    	$libelle_err = '';
    	$err_typeaccount = $errors['typeaccount'];
    	if(count($err_typeaccount)){
    		foreach ($err_typeaccount as $key => $value){
    			switch ($value){
    				default:$libelle_err = 'Type de compte non valide.';break;
    			}
    		}
    	}
    	$this->_view->err_accounttype = $libelle_err;

    	// type de vendeur
    	$libelle_err = '';
    	$err_typevendeur = $errors['typevendeur'];
    	if(count($err_typevendeur)){
    		foreach ($err_typevendeur as $key => $value){
    			switch ($value){
    				default:$libelle_err = 'Type de vendeur non valide.';break;
    			}
    		}
    	}
    	$this->_view->err_typevendeur = $libelle_err;

    	// cp
    	$libelle_err = '';
    	$err_cp = $errors['cp'];
    	if(count($err_cp)){
    		foreach ($err_cp as $key => $value){
    			switch ($value){
    				case 'isEmpty':	$libelle_err = 'Veuillez renseigner votre code postal.';break;
    				default:$libelle_err = 'Code postal non valide.';break;
    			}
    		}
    	}
    	$this->_view->err_cp = $libelle_err;

    	// ville
    	$libelle_err = '';
    	$err_ville = $errors['ville'];
    	if(count($err_ville)){
    		foreach ($err_ville as $key => $value){
    			switch ($value){
    				case 'isEmpty':	$libelle_err = 'Veuillez renseigner votre ville.';break;
    				default:$libelle_err = 'Ville non valide.';break;
    			}
    		}
    	}
    	$this->_view->err_ville = $libelle_err;

    	// adresse1
    	$libelle_err = '';
    	$err_adresse1 = $errors['adresse1'];
    	if(count($err_adresse1)){
    		foreach ($err_adresse1 as $key => $value){
    			switch ($value){
    				case 'isEmpty':	$libelle_err = 'Veuillez renseigner votre adresse.';break;
    				default:$libelle_err = 'Adresse non valide.';break;
    			}
    		}
    	}
    	$this->_view->err_adresse1 = $libelle_err;

    	// adresse1
    	$libelle_err = '';
    	$err_adresse2 = $errors['adresse2'];
    	if(count($err_adresse2)){
    		foreach ($err_adresse2 as $key => $value){
    			switch ($value){
    				default:$libelle_err = 'Adresse non valide.';break;
    			}
    		}
    	}
    	$this->_view->err_adresse2 = $libelle_err;

    	// phone
    	$libelle_err = '';
    	$err_phone = $errors['phone'];
    	if(count($err_phone)){
    		foreach ($err_phone as $key => $value){
    			switch ($value){
    				case 'isEmpty':	$libelle_err = 'Veuillez renseigner votre numéro de téléphone.';break;
    				default:$libelle_err = 'Numéro de téléphone non valide (ex: 0201010101 ).';break;
    			}
    		}
    	}
    	$this->_view->err_phone = $libelle_err;

    	// mail
    	$libelle_err = '';
    	$err_mail = $errors['mail'];
    	if(count($err_mail)){
    		foreach ($err_mail as $key => $value){
    			switch ($value){
    				case 'isEmpty':	$libelle_err = 'Veuillez renseigner votre email.';break;
    				case 'recordFound': $libelle_err = 'Cette adresse email est déjà utilisée.';break;
    				default:$libelle_err = 'Adresse email non valide.';break;
    			}
    		}
    	}
    	$this->_view->err_mail = $libelle_err;

    	// checkCGU
    	$libelle_err = '';
    	$err_mail = $errors['checkCGU'];
    	if(count($err_mail)){
    		foreach ($err_mail as $key => $value){
    			switch ($value){
    				case 'isEmpty':	$libelle_err = 'Veuillez accepter les CGU afin de bénéficier de nos services';break;
    				default:$libelle_err = 'Veuillez accepter les CGU afin de bénéficier de nos services.';break;
    			}
    		}
    	}
    	$this->_view->err_checkCGU = $libelle_err;


    }

    public function traitementFormData($formData,$confirmation){
		//$formData['libelle']
		$now = new Zend_Date();

    	$user = new User();
    	$username = $user->generateUsername($formData['nom'],$formData['prenom']);
    	$user->setUsername($username);
    	$user->setPassword(sha1(ParamCustom::param("FRONTEND.FRONTEND_PWD_SUFFIX").$formData['password']));
		$user->setUser_dateAdded($now->get(Zend_Date::ISO_8601));
   		$idUser = $user->save();

   		$this->_user = $user;

		//debug('id user: '.$idUser);

    	$userinfos = new UserInfos();
    	$userinfos->setUserinfos_userId($idUser);
    	$userinfos->setUserinfos_nom($formData['nom']);
    	$userinfos->setUserinfos_prenom($formData['prenom']);
    	$userinfos->setUserinfos_telephone($formData['phone']);
    	$userinfos->setUserinfos_mail($formData['mail']);
    	$userinfos->setUserinfos_dateCgu($now->get(zend_date::ISO_8601));

    	// voir paiment paypal -- todo
    	// group (5:frontend_membre (acheteur) - 6:frontend_vendeur)
    	if($formData['typeaccount']=="1"){ // cpte vendeur
    		$userinfos->setUserinfos_isVendeur($checkValidVendeur);
    		$group_id = 6;
			//$this->sendMailConfirm($typeaccount,$mail,$nom);


    	} else {
    		// cpte acheteur
    		$group_id = 5;

    		// send confirm mail adresse acheteur
    		//$this->sendMailConfirm("acheteur",$userinfos->getUserinfos_mail(),$userinfos->getIdentity());
    	}


    	// geoloc
    	$userinfos->setUserinfos_cp($formData['cp']);

    	$codeInsee = '0'.$formData['ville'];
    	try {
    		$location = new Insee($codeInsee);
    		$userinfos->setUserinfos_ville($location->getNCCENR());
    		$userinfos->setUserinfos_code_departement($location->getDEP());
    		$userinfos->setUserinfos_code_region($location->getREG());
    		$userinfos->setUserinfos_code_pays(250);
    	} catch (Exception $e) {
    		print 'failed: '.$e->getMessage();
    	}
		$userinfos->setUserinfos_adresse1($formData['adresse1']);
		$userinfos->setUserinfos_adresse2($formData['adresse2']);
		$userinfos->setUserinfos_dateAdded($now->get(zend_date::ISO_8601));
		$userinfos->setUserinfos_mailConfirm($this->getHashConfirmMail());
		$userinfos->save();

		// Add user to member (acheteur) group
		$group = new FrontendUserGroups();
		$group->setId($this->getNextUserGroupId());
		$group->setUser_id($user->getId());
		$group->setGroup_id($group_id);
		$group->save();

		// send email confirm
		$sendmail = $this->sendMailConfirm($group_id, $this->_user->getUserInfos()->getUserinfos_mail(), $this->_user->getUserInfos()->getIdentity());
		if($sendmail[0]){
			$this->_view->valideform = true;
			$this->_view->mailsend = $this->_user->getUserInfos()->getUserinfos_mail();
		} else {

		}
		debug($sendmail);



    }

    public function sendMailConfirm($group_id,$usermail,$identity){
    	$userId = $this->_user->getId();
    	$sign = $this->_user->getUserInfos()->getUserinfos_mailConfirm();
    	$urlconfirm = ParamCustom::param("FRONTEND.FRONTEND_URL").'/user-confirmemail/'.$userId.'/'.$sign;
    	switch ($group_id){
    		case 5: // acheteur
    			$mail = new App_Mail("FRONTEND.ALERTE.COMMON");
    			$mailText = 'Votre compte '.ParamCustom::param("NOM.APPLI","FRAMEWORK").'est en cours d\'activation.<br />';
    			$mailText .= 'Veuillez confirmer votre adresse mail en cliquant sur le lien ci-dessous:<br /><br />';
    			$mailText .= '<a href="'.$urlconfirm.'">Activer mon compte</a>';
    			$mail->subject = 'Activation de votre compte '.ParamCustom::param("NOM.APPLI","FRAMEWORK");
    		break;
    		case 6: // vendeur
/*    			$mail = new App_Mail("FRONTEND.ALERTE.COMMON");
    			$mailText = 'Afin de confirmer votre enregistrement, veuillez cliquer sur le lien suivant:<a href="'.$urlconfirm.'">lien</a>'; // todo + fournir le username
    			$mail->subject = 'EXECUTIVE PROJECT .. veuillez confirmer votre adresse mail';*/
    		break;
    	}
    	$mail->AddAddress($usermail);
    	$mail->content = '<span style="font-size:14px; color:#660000;">'.$identity.'</span> ,<br /><p>'.$mailText.'</p>';
    	try {
    		$mail->send();
    		return array(true,'Message envoyé à '.$usermail);
    	} catch (Exception $e){
    		//print 'failed: '.$e->getMessage();
    		return array(false,$e->getMessage());
    	}
    }

    public function getNextUserGroupId(){
    	$modelUserGroups = new FrontendUserGroups();
    	$lastUserGroupId = $modelUserGroups->getLastUserGroupId();
    	$nextUserGroupId = $lastUserGroupId +1;
    	return $nextUserGroupId;
    }

    public function traitementRedirect($formData,$confirmation){
    	//$this->_controller->getHelper("redirector")->gotoRoute(array(),"prepa_accueil");
    }



}