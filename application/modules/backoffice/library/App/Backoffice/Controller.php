<?php
/**
 * Default parent controller for all the backoffice controllers
 *
 * @category App
 * @package App_Backoffice
 * @copyright RCWEB
 */

abstract class App_Backoffice_Controller extends App_Controller
{

    /**
     * Overrides init() from App_Controller
     *
     * @access public
     * @return void
     */
    public function init(){
        parent::init();
    }

    /**
     * Overrides preDispatch() from App_Controller
     *
     * @access public
     * @return void
     */
    public function preDispatch(){
        parent::preDispatch();

        $controllerName = $this->getRequest()->getControllerName();
        $actionName = $this->getRequest()->getActionName();

        Zend_Registry::set('controllerName', $controllerName);
        Zend_Registry::set('actionName', $actionName);
        // check the Flag and Flippers
        $this->_checkFlagFlippers();
    }

    /**
     * Overrides postDispatch() from App_Controller
     *
     * @access public
     * @return void
     */
    public function postDispatch(){
        parent::postDispatch();

        $this->_helper->layout()->getView()->headTitle($this->title);
    }


}