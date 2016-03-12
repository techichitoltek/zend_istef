<?php
/**
 * Default entry point in the application
 *
 * @package frontend_controllers
 * @copyright RCWEB
 */

class WebserviceController extends App_Frontend_Controller
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
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
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
     * CP VILLE entry point
     *
     * @return void
     */
    public function cpvilleAction()
    {
/*    	if(!App_FlagFlippers_Manager::isRouteAllowed("profil_ajxrofileameexist")){
    		$this->getHelper("redirector")->gotoRoute(array(),"user_accueil");
    	}*/


    	$param['search_cp'] = /*addslashes(*/$_POST['search_cp']/*)*/;
    	$param['noCsrf'] = true;
    	$form = new CpvilleForm($param, $this);
    	$form->init();

    	if ($this->getRequest()->isPost() && $_POST['search_cp']) {

    		$isValideForm = $form->isValid($_POST);

    		if(!count($isValideForm[1])){ // formulaire valide
    			die('{"isvalid" : "1", "villes" : "'.$isValideForm[2].'"}');
    			exit;
    		} else { // formulaire valide
    			die('{"isvalid" : "0", "villes" : "'.$isValideForm[1][0].'"}');
    			exit;
    		}

    	} else {
    		die('{"villes" : "non post request"}');
    		exit;
    	}


    }



}