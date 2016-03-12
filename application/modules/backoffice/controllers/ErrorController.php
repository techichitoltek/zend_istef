<?php
/**
 * Error Controller
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright RCWEB
 */

class ErrorController extends App_ErrorController
{
    /**
     * List of Zend_Exceptions for which we display
     * the 404 page
     *
     * @var array
     * @access protected
     */
    protected $_dispatch404s = array(
            Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE,
            Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER,
            Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION
    );

    /**
     * Overrides init() defined in App_Backoffice_Controller
     *
     * @access public
     * @return void
     */
    public function init(){
        parent::init();

        $this->_helper->layout()->setLayout('layout');
    }


}