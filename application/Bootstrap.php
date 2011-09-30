<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initConfig()
    {
        $config = new Zend_Config($this->getOptions(), true);
        Zend_Registry::set('config', $this->_config = $config);

        return $config;
    } 
    
    protected function _initSession() 
    {
        Zend_Session::start();
    }
}

