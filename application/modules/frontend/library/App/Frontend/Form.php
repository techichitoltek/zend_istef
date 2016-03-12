<?php
/**
 * Parent form for all the frontend forms
 *
 * @category App
 * @package App_Frontend
 * @copyright RCWEB
 */

abstract class App_Frontend_Form extends App_FormStd
{
    /**
     * Overrides init() in App_Form
     * 
     * @access public
     * @return void
     */
    public function init(){
        parent::init();
        
        
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