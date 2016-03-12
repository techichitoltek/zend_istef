<?php
/**
 * Gestion des url portails
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright RCWEB
 */

class PortailurlController extends App_Backoffice_Controller
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
     * Index des urls
     *
     * @access public
     * @return void
     */
    public function indexAction(){
        $portailUrlModel = new PortailUrl();
        $listePortailUrl = $portailUrlModel->getListe(false,false,"portailurl_portail_id ASC");

        $this->view->listePortailUrl = $listePortailUrl;
    }
}