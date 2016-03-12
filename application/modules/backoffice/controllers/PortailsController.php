<?php
/**
 * Gestion des portails
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright RCWEB
 */

class PortailsController extends App_Backoffice_Controller
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
     * Index des portails
     *
     * @access public
     * @return void
     */
    public function indexAction(){
        $portailsModel = new Portail();
        $listePortails = $portailsModel->getListe();
        $this->view->listePortails = $listePortails;
    }
}