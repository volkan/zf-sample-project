<?php

class My_View_Helper_Messenger extends Zend_View_Helper_Abstract
{
 
    public function messenger()
    {   
        return $this;
    }
    
    public function getInstance()
    {
        return new My_Module_Messenger();
    }
    
    public function getMessages()
    {
        return My_Module_Messenger::getMessages();
    }
}
