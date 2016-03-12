<?php
/**
 * User login form
 *
 * @category Rcweb
 * @package rcweb_forms
 * @copyright RCWEB
 */

class LoginForm extends App_Frontend_Form
{
    /**
     * This form does not have a cancel link
     *
     * @var mixed
     * @access protected
     */
    protected $_cancelLink = false;

    /**
     * Overrides init() in Zend_Form
     *
     * @access public
     * @return void
     */
    public function init() {
        // init the parent
        parent::init();

        // set the form's method
        $this->setMethod('post');

        $username = new Zend_Form_Element_Text('username');  //<input type="email" class="form-control" placeholder="Email">
        $username->setOptions(
            array(
                'label'      => 'Username',
                'required'   => true,
                'class'      => 'iform-control',
            	'placeholder'=>'Email',
                'filters'    => array(
                                    'StringTrim',
                                    'StripTags',
                                ),
                'validators' => array(
                                    'NotEmpty',
                                ),
            )
        );
        $this->addElement($username);

        $password = new Zend_Form_Element_Password('password');
        $password->setOptions(
            array(
                'label'      => 'Password',
                'required'   => true,
                //'class'      => 'input-text full-width',
                'filters'    => array(
                                    'StringTrim',
                                    'StripTags',
                                ),
                'validators' => array(
                                    'NotEmpty',
                                ),
            )
        );
        $this->addElement($password);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setOptions(
            array(
                'label'      => 'Identifiez-vous →',
                //'class'      => 'btn btn-primary',
                //'required'   => true,
            )
        );
        //$this->addElement($submit);
    }
}