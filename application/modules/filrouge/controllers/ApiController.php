<?php
/**
 * Default entry point in the application
 *
 * @package filrouge_controllers
 * @copyright RCWEB
 */

class ApiController extends App_Filrouge_Controller
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
        //$this->_helper->layout()->setLayout('blank'); //active for debug
        $this->_helper->layout()->setLayout('empty');
    }

    /**
     * Controller's entry point
     *
     * @access public
     * @return void
     */
    public function indexAction()
    {
		echo 'welcome api index point';

    }

    /**
     * Call api entry point
     *
     * @access public
     * @return void
     */
    public function callapiAction()
    {
       	// url get incident GET : http://zend_istef_filrouge.dev/api/callapi?wstype=incident&typeresponse=json

		// get [ incident ]
    	if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
			if(isset($_GET['wstype']) && $_GET['wstype']!='' && isset($_GET['typeresponse']) && $_GET['typeresponse']!=''){
				switch ($_GET['wstype']){
					case 'incident':
						$this->getHelper("redirector")->gotoRoute(array("typeresponse"=>$_GET['typeresponse']),"api_getincident");
					break;
					case 'myaccount':

					break;
					default:
					echo 'Parmatère wstype incorrecte';
					break;
				}
			} else {
				echo 'Paramètres manquants';
			}
    	}


    }

    /**
     * Get incident entry point
     *
     * @access public
     * @return void
     */
    public function getincidentAction()
    {
    	$response_type = $this->getRequest()->getParam('typeresponse',null);
		$model_incident = new Incident();
		$response = $model_incident->getIncidentByLocationResponse($response_type,43.2967,5.37639,5);
		echo $response;
    }

    /**
     * Signal incident entry point
     *
     * @access public
     * @return void
     */
    public function addsignalAction()
    {
    	// url: http://zend_istef_filrouge.dev/api/addsignal

    	if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    		if(isset($_POST['wstype']) && $_POST['wstype']!='' && isset($_POST['userId']) && $_POST['userId']!='' && isset($_POST['lat']) && $_POST['lat']!='' && isset($_POST['long']) && $_POST['long']!=''){

    			switch ($_POST['wstype']){
    				case 'incident':
    					$new_signalement = new Signalement();
    					$response = $new_signalement->addSignalement($_POST['userId'],$_POST['lat'],$_POST['long'],$_POST['commentaire']);
    				break;
    				case 'myaccount':

    				break;
    				default:
    					$response =  'Parmatère wstype incorrecte';
    				break;
    			}
    		} else {
    			$response =  'Paramètres manquants';
    		}
    	} else {
    		$response = 'Requete is not a POST request';
    	}
		echo $response;

    }




}