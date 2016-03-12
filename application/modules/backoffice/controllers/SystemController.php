<?php
/**
 * Allow the admins to manage critical info, users, groups, permissions, etc.
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright RCWEB
 */

class SystemController extends App_Backoffice_Controller
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
    }

    /**
     * Theme example page
     *
     * @access public
     * @return void
     */
    public function exampleAction(){
    }

    /**
     * Errors example page
     *
     * @access public
     * @return void
     */
    public function exampleErrorsAction(){
        $typeError = $this->_request->getParam("typeError","");
        $controllerError = $this->_request->getParam("controllerError","view");

        if($controllerError == "controller"){
            switch ($typeError) {
                case "undefinedVariable":
                    if($toto) break;
                break;
                case "undefinedAttrib":
                    $toto->getToto = true;
                break;
                case "notArray":
                    foreach($toto as $var){
                        if($var) true;
                    }
                break;

                default:
                    ;
                break;
            }
        }



        //echo $toto->getToto();
        /*trigger_error("controller notice",E_USER_NOTICE);
        trigger_error("controller warning",E_USER_WARNING);
        trigger_error("controller error",E_USER_ERROR);
        throw new ErrorException("Test throw ErrorException");
        throw new Exception("Test throw exception");*/
    }

    /**
     * Phpinfo point
     *
     * @access public
     * @return void
     */
    public function phpinfoAction(){
    }
}