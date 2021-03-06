<?php

abstract class My_Controller_Action 
    extends Zend_Controller_Action
{
    
    /**
     * @example
     * $this->session->key = 'value'
     * @var Zend_Session_Namespace 
     */
    public $session;
    
    public function init() 
    {
        $this->session = new Zend_Session_Namespace('Action');
    }
    
    public function getMessenger()
    {
        return new My_Module_Messenger();
    }
   
}
