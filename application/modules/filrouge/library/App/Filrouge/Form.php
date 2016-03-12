<?php
/**
 * Parent form for all the filrouge forms
 *
 * @category App
 * @package App_Frontend
 * @copyright RCWEB
 */

abstract class App_Filrouge_Form extends App_FormStd
{
    /**
     * Overrides init() in App_Form
     *
     * @access public
     * @return void
     */
    public function init(){
        parent::init();


        /*$config = App_DI_Container::get('ConfigObject');

        // add an anti-CSRF token to all forms
        $csrfHash = new Zend_Form_Element_Hash('csrfhash');
        $csrfHash->setOptions(
            array(
                'required'   => TRUE,
                'filters'    => array(
                    'StringTrim',
                    'StripTags',
                ),
                'validators' => array(
                    'NotEmpty',
                ),
                'salt' => $config->security->csrfsalt . get_class($this),
            )
        );
        //$this->addElement($csrfHash);

        $formName = new Zend_Form_Element_Hidden('formName');
        $formName->setOptions(
            array(
                'filters'    => array(
                    'StringTrim',
                    'StripTags',
                ),
                'value' => get_class($this)
            )
        );
        $this->addElement($formName);
        */
    }

    /**
     * Overrides render() in App_Form
     *
     * @param Zend_View_Interface $view
     * @access public
     * @return string
     */
    public function renderBis(Zend_View_Interface $view = NULL){
        $this->clearDecorators();
        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => $this->_partial, 'form' => $this, 'view' => $this->getView()))
        ));

        foreach($this->getElements() as $element){
            $element->clearDecorators();

            if($element instanceof Zend_Form_Element_File){
                $element->setDecorators(array(
                    array('File'),
                    array('Errors')
                ));
            }else{
                $element->setDecorators(array(
                    array('ViewHelper'),
                    array('Errors')
                ));
            }

            $element->getView()->getHelper('FormErrors')->setElementStart('<strong class="error"><em>');
            $element->getView()->getHelper('FormErrors')->setElementEnd('</em></strong>');
            $element->getView()->getHelper('FormErrors')->setElementSeparator('</em><em>');
        }

        if(NULL === $this->getAttrib('id')) {
            $controllerName = Zend_Registry::get('controllerName');
            $actionName = Zend_Registry::get('actionName');

            $this->setAttrib('id', $controllerName . '-' . $actionName);
        }

        return parent::render($view);
    }

    function renderFieldErrors($field,$class="error",$style=""){
        $html = "";
        if($this->{$field}->hasErrors()){
            $html .= '<ul class="error_list">';
            foreach ($this->{$field}->getErrors() as $message){
                $html .= "<li>".$message."</li>";
            }
            $html .= '</ul>';
        }
        return $html;
    }

    function renderFieldCustomErrors($field,$class="error",$style=""){
        $html = "";
        if($this->{$field}->hasErrors()){
            $html .= '<ul class="error_list">';
            foreach ($this->{$field}->getErrorMessages() as $message){
                $html .= "<li>".$message."</li>";
            }
            $html .= '</ul>';
        }
        return $html;
    }
}