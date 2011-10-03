<?php

class Admin_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initAutoload()
    {
        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
            'basePath'      => dirname(__FILE__) ,
            'namespace'     => '',
            'resourceTypes' => array(
                'form' => array(
                    'path'      => 'forms/',
                    'namespace' => 'Form',
                )
            ),
        ));
        
        return;
    }
}
