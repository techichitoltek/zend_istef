<?php
/**
 * Default entry point in the application
 *
 * @package frontend_controllers
 * @copyright RCWEB
 */

class TestController extends App_Frontend_Controller
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
     * Accueil entry point
     *
     * @return void
     */
    public function accueilAction()
    {

    }

    /**
     * DateLib test entry point
     *
     * @return void
     */
    public function datelibAction()
    {
		$user = $this->user; /* @var $user User */
		$this->view->user = $user;
    }

    /**
     * Upload single file test entry point
     *
     * @return void
     */
    public function uploadsinglefileAction()
    {
    	$user = $this->user; /* @var $user User */
    	$this->view->user = $user;
    }

    /**
     * Parse file test entry point
     *
     * @return void
     */
    public function parsefileAction()
    {

    }

    /**
     * Parse file test entry point
     *
     * @return void
     */
    public function trycatchAction()
    {

    }

    /**
     * Datatable entry point
     *
     * @return void
     */
    public function datatableAction()
    {
    	//$this->_helper->layout()->setLayout('blank');

    }

    /**
     * Test divers entry point
     *
     * @return void
     */
    public function testdiversAction()
    {
    }

    /**
     * Test ajax entry page
     *
     * @return void
     */
    public function testajaxAction()
    {
    	// attention lors de appel ajax --> (type onclick :
    	/*/$('#add-comment').on('click', function(event){
    	event.preventDefault();*/

    	/*if(!App_FlagFlippers_Manager::isRouteAllowed("profil_ajxrofileameexist")){
    		$this->getHelper("redirector")->gotoRoute(array(),"user_accueil");
    	}
    	$user = $this->user; *//* @var $user User */
    	/*$entreprise = $user->getUserInfos()->getEntreprise();
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);

    	if (isset($_POST)) {
    		$libelle = $_POST['libelle'];
    		$recherche = new Recherche();
    		$checkLibelle = $recherche->libellealreadyExist($libelle,$user->getId()) ? 1:0;
    		die('{"alreadyexist" : "'.$checkLibelle.'"}');
    		exit;
    	}*/
    }


}