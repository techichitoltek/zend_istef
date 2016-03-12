<?php
/**
 * Default parent controller for all the filrouge controllers
 *
 * @package App_Controller
 * @copyright RCWEB
 */

abstract class App_Filrouge_Controller extends App_Controller
{

	/**
	 *
	 * @var User
	 */
    public $user = null;


    /**
     *
     * @var BackadminUser
     */
    public $backadminuser = null;

    /**
     *
     * @var Zend_Session_Namespace
     */
    public $filrougeSession = null;

    /**
     * Overrides preDispatch() from App_Controller
     * Fetch and prepare the cart system in the namespace
     *
     * @access public
     * @return void
     */
    public function preDispatch(){

        parent::preDispatch();

        $this->view->forceMenu = $this->_request->getParam('forceMenu',null);

        $controllerName = $this->getRequest()->getControllerName();
        $actionName = $this->getRequest()->getActionName();

        Zend_Registry::set('controllerName', $controllerName);
        Zend_Registry::set('actionName', $actionName);
        Zend_Registry::set('Zend_Request', $this->getRequest());
        // check the Flag and Flipper
        $this->_checkFlagFlippers();


        $this->filrougeSession = new Zend_Session_Namespace('filrouge');

    }

    /**
     * Overrides postDispatch() from App_Controller
     *
     * @access public
     * @return void
     */
    public function postDispatch(){
        parent::postDispatch();

        if(isset($this->title)){
            $this->view->headTitle($this->title);
        }else{
            $this->view->headTitle('');
        }
    }



}