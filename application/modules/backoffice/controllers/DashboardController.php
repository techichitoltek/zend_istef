<?php
/**
 * Default entry point in the dashboard
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright RCWEB
 */

class DashboardController extends App_Backoffice_Controller
{
    /**
     * Overrides Zend_Controller_Action::init()
     *
     * @access public
     * @return void
     */
    public function init(){
        // init the parent
        parent::init();
    }

    /**
     * Controller's entry point
     *
     * @access public
     * @return void
     */
    public function indexAction(){
        $onlineModel = new Online();

        $webUser = new App_WebUser();
        // TDTODO : Purger les utilisateurs qui ne sont plus en ligne
        $onlineModel->updateOnline();

        $listeUserOnline = $onlineModel->getListe();


        $this->view->listeUserOnline = $listeUserOnline;
        $this->view->webUser = $webUser;
    }
}