<?php
/**
 * Gestion du paramétrage des mails
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright RCWEB
 */
class MailsController extends App_Backoffice_Controller
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
     * Index du paramétrage des mails
     *
     * @access public
     * @return void
     */
    public function indexAction(){
        $email = new Email();
        $listeEmails = $email->getListe();

        $this->view->listeEmails = $listeEmails;
    }

    /**
     * Test envoi de mail
     *
     * @access public
     * @return void
     */
    public function testAction(){
        $mail = new App_Mail("BACKOFFICE.TEST");

        $mail->AddAddress("tech@rcweb.io","your name");

        $res = $mail->send();
        Zend_Debug::dump($res);
    }
}