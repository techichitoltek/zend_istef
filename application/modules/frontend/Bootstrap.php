<?php
/**
 * Frontend bootstrap
 *
 * @package Frontend
 * @copyright RCWEB
 */

class Frontend_Bootstrap extends App_Bootstrap_Abstract
{
	protected function _initConf(){
		define("ROOTPATH",__DIR__);
		define("FRONTEND_MODULE","/frontend");
		define("FRONTEND_PATH",ROOT_PATH."/application/modules".FRONTEND_MODULE);



		define("FRONTEND_CATALOGUE_IMG_PATH_ABS",ROOT_PATH."/public".FRONTEND_MODULE."/catalogue/img/");


	}

	/**
	 * Initialize App paths and App/Models paths
	 *
	 * @access protected
	 * @return void
	 */
	protected function _initPaths(){
/*		$paths = array(
				ROOT_PATH . '/library/App/Models',
				APPLICATION_PATH . '/modules/medebackoffice/models',
				get_include_path() ,
		);

		set_include_path(implode(PATH_SEPARATOR, $paths));*/
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

        $viewRenderer->view->addHelperPath('App/Frontend/View/Helper', 'App_Frontend_View_Helper');
    }
}