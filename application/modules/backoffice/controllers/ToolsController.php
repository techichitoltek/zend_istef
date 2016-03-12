<?php
/**
 * Outils divers
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright RCWEB
 */

class ToolsController extends App_Backoffice_Controller
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
     * Index des outils
     *
     * @access public
     * @return void
     */
    public function indexAction(){

    }

    /**
     * Vide le cache de l'application
     *
     * TDTODO : mettre en place une sécurité ex : filtre sur ip
     * @return void
     */
    public function cleancacheAction() {
        $cacheHandler = App_DI_Container::get('CacheManager')->getCache('default');
        // On vide totalement le cache
        $cacheHandler->clean(Zend_Cache::CLEANING_MODE_ALL);
    }


    /**
     * Adminer
     *
     * @return void
     */
    public function adminerAction() {
        // use the login layout
        $this->_helper->layout()->setLayout('empty');

        require_once '/Adminer/adminer-conf.php';
        require_once '/Adminer/adminer.php';
        //exit();
    }
}