<?php
/**
 * Default entry point in the application
 *
 * @package frontend_controllers
 * @copyright RCWEB
 */

class UserController extends App_Frontend_Controller
{
    /**
     * Overrides Zend_Controller_Action::init()
     *
     * @access public
     * @return void
     */
    public function init()
    {
        // init the parent
        parent::init();

        $this->_addCommand(new App_Command_SendEmail());
    }

    /**
     * Controller's entry point
     *
     * @access public
     * @return void
     */
    public function indexAction()
    {

    }

    /**
     * Accueil entry point
     *
     * @return void
     */
    public function accueilAction()
    {
    	if(!App_FlagFlippers_Manager::isRouteAllowed("user_accueil")){
    		//$this->getHelper("redirector")->gotoRoute(array(),"login");
    	}
    	$this->_helper->layout()->setLayout('layout-members');
    	$user = $this->user; /* @var $user User */
    	$this->view->user = $user;
    	if($user->getId()){
    		//debug('utilisateur connecté: '.$this->user->getUserInfos()->getUserinfos_nom());
    	}
    }

    /**
     * Ajouter un compte utilisateur
     *
     * @return void
     */
    public function addaccountAction()
    {
    	$this->_helper->layout()->setLayout('layout-guest');

   		$param['form_name'] = "form_addaccount";
    	$param['form_id'] = "form_addaccount";
    	$param['paramname'] = 'paramvalue';
    	$param['noCsrf'] = true; // empeche le formulaire d'etre retransmis plusieurs fois
    	$form = new AddAccount($param, $this);
    	$form->myStdTraitement();
    }

    /**
     * Confirmer adresse email
     *
     * @return void
     */
    public function confirmemailAction()
    {
    	$this->_helper->layout()->setLayout('layout-guest');
    	$userId = $this->getRequest()->getParam('userId',null);
    	$sign = $this->getRequest()->getParam('sign',null);
    	debug($sign);
    	debug($userId);
    	if($sign!='' && $userId!=''){
    		$user_confirm = new User((int)$userId);
    		if($user_confirm->confirmMail($sign)){
    			$this->view->confirmvalide = true;
    		} else {
    			$this->view->confirmvalide = false;
    		}
    	} else {
    		debug('Erreur syntaxe URL');
    		$this->view->confirmvalide = false;
    	}


    }


}