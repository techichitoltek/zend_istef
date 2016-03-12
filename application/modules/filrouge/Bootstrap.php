<?php
/**
 * Filrouge bootstrap
 *
 * @package Frontend
 * @copyright RCWEB
 */

class Filrouge_Bootstrap extends App_Bootstrap_Abstract
{
    protected function _initConf(){
        define("FILROUGE_MODULE","/filrouge");
        define("FILROUGE_PATH",ROOT_PATH."/application/modules".FILROUGE_MODULE);

    }

    /**
     * Inits the session for the frontend
     *
     * @access protected
     * @return void
     */
    protected function _initSession(){
        Zend_Session::start();
    }

    /**
     * Inits the Zend Paginator component
     *
     * @access protected
     * @return void
     */
    protected function _initPaginator(){
        Zend_Paginator::setDefaultScrollingStyle(App_DI_Container::get('ConfigObject')->paginator->scrolling_style);
        Zend_View_Helper_PaginationControl::setDefaultViewPartial(
            'default.phtml'
        );
    }

    /**
     * Initializes the view helpers for the application
     *
     * @access protected
     * @return void
     */
    protected function _initViewHelpers() {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        if (NULL === $viewRenderer->view) {
            $viewRenderer->initView();
        }

        $viewRenderer->view->addHelperPath('App/Filrouge/View/Helper', 'App_Filrouge_View_Helper');
    }
}