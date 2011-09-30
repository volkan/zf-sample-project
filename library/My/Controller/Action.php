<?php

abstract class My_Controller_Action 
    extends Zend_Controller_Action
{
    
    public $session;
    
    public function init() 
    {
        $this->session = new Zend_Session_Namespace('Action');
    }
   
}
