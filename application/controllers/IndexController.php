<?php
/**
 * Zend Framework Örnek Proje
 * Zend Framework Sample Project
 */
class IndexController 
    extends My_Controller_Action
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        
        // action body
        $this->session->deneme = "sss";
    }


}

