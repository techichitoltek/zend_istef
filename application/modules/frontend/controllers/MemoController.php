<?php
/**
 * Default entry point in the application
 *
 * @package frontend_controllers
 * @copyright RCWEB
 */

class MemoController extends App_Frontend_Controller
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
     * Css entry point
     *
     * @return void
     */
    public function cssAction()
    {

    }

    /**
     * Javascript entry point
     *
     * @return void
     */
    public function javascriptAction()
    {

    }

    /**
     * Php entry point
     *
     * @return void
     */
    public function phpAction()
    {

    }

    /**
     * Zend common entry point
     *
     * @return void
     */
    public function zendcommonAction()
    {

    }

    /**
     * Datatable entry point
     *
     * @return void
     */
    public function datatableAction()
    {

    }

    /**
     * Putty entry point
     *
     * @return void
     */
    public function puttyAction()
    {

    }
}