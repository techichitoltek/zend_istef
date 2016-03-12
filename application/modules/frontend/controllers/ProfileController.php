<?php
/**
 * Default entry point in the application
 *
 * @package rcweb_controllers
 * @copyright RCWEB
 */

class ProfileController extends App_Frontend_Controller
{
    public function preDispatch(){
        parent::preDispatch();
        $this->myPreDispatch();
    }

    public function postDispatch(){
        parent::postDispatch();
        $this->myPostDispatch();
    }

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
        $this->_redirect('/');
    }

    /**
     * Login entry point
     *
     * @access public
     * @return void
     */
	public function loginAction(){
		$this->_helper->layout()->setLayout('layout-login');
	    if($this->user->getId()){
	    	$this->getHelper("redirector")->gotoRoute(array(),"user_accueil");
	    }
        $this->title = 'Authentification';

        $form = new LoginForm(array(),$this);
        if ($this->getRequest()->isPost()) {
            if($form->isValid($this->getRequest()->getPost())){
                $userModel = new FrontendUser();
                if($userModel->login($form->getValue('username'), $form->getValue('password'))){
                    $session = new Zend_Session_Namespace('App.'.CURRENT_MODULE.'.Controller');
                    $request = unserialize($session->request);

                    if(!empty($request)){
                       // $previousUri = $request->getRequestUri();
                        //$this->_redirect($previousUri);
                    }else{
                    	debug('we are connected');
                    	$this->getHelper("redirector")->gotoRoute(array(),"user_accueil");
                       // $this->_redirect('/profile/');
                    }
                }
            }

            $this->view->error = TRUE;
        }

        $this->view->form = $form;
    }

    /**
     * Allows users to log out of the application
     *
     * @access public
     * @return void
     */
    public function logoutAction(){
        // log the user out
        App_Auth::getInstance()->clearIdentity();

        // destroy the session
        Zend_Session::destroy();

        // go to the login page
        //$this->_redirect('/profile/login/');

        // go to index
        $this->_redirect('/');
    }


    /**
     * Index mon compte
     *
     * @access public
     * @return void
     */
    public function monCompteAction()
    {
        $this->_redirect('/');
    }

}