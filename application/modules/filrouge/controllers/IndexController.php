<?php
/**
 * Default entry point in the application
 *
 * @package filrouge_controllers
 * @copyright RCWEB
 */

class IndexController extends App_Filrouge_Controller
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
        $this->_helper->layout()->setLayout('blank');
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



}