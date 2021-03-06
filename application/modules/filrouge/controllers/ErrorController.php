<?php
/**
 * Error Controller
 *
 * @package application_filrouge_controllers
 * @copyright RCWEB
 */

class ErrorController extends App_ErrorController
{
    public $user = null;

    /**
     * Overrides preDispatch() from App_Controller
     * Fetch and prepare the cart system in the namespace
     *
     * @access public
     * @return void
     */
    public function preDispatch(){
        parent::preDispatch();
    }

    /**
     * Overrides postDispatch() from App_Controller
     *
     * @access public
     * @return void
     */
    public function postDispatch(){
        parent::postDispatch();
    }

    /**
     * List of Zend_Exceptions for which we display
     * the 404 page
     *
     * @var array
     * @access protected
     */
    protected $_dispatch404s = array(
            Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE,
            Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER,
            Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION
    );

    /**
     * Overrides init() defined in App_Backoffice_Controller
     *
     * @access public
     * @return void
     */
    public function init(){
        parent::init();
    }

    /**
     * Handles all errors in the application
     *
     * @access public
     * @return void
     */
    public function error_sauvAction(){
        $content = null;
        $errors = $this->_getParam('error_handler');

        switch($errors->type){
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
                // ... get some output to display...
                $content .= '<h1>' . $this->t->_('404 Page not found!') . '</h1>' . PHP_EOL;
                $content .= '<p>' . $this->t->_('The page you requested was not found.') . '</p>';
                break;
            default:
                // application error; display error page, but don't change
                // status code
                $content .= '<h1>' . $this->t->_('Error!') . '</h1>' . PHP_EOL;
                $content .= '<p>' . $this->t->_('An unexpected error occurred with your request. Please try again later.') . '</p>';

                // Log the exception
                $exception = $errors->exception;
                App_Logger::log(sprintf("%s\n\n%s", $exception->getMessage(), $exception->getTraceAsString()), Zend_Log::ERR);
                break;
        }

        // Clear previous content
        $this->getResponse()->clearBody();
        $this->view->content = $content;
    }

    /**
     * Handles the Flag and Flipper errors
     *
     * @access public
     * @return void
     */
    public function flagflippersAction(){
        if (Zend_Registry::get('IS_DEVELOPMENT')) {
            $this->title = $this->t->_('Flag and Flipper not found');

            $this->view->originalController = $this->_getParam('originalController');
            $this->view->originalAction = $this->_getParam('originalAction');
        } else {
            $this->_dispatch404();
        }
    }

    /**
     * Displays the forbidden page
     *
     * @access public
     * @return void
     */
    public function forbiddenAction(){
        $this->title = 'Forbidden';
    }

    /**
     * Dispatches the 404 error page as it should be seen
     * by the end user.
     *
     * @access protected
     * @return void
     */
    protected function _dispatch404(){
        $this->title = 'Page not found';
        $this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');

        $this->render('error-404');
    }
}