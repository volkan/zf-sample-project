<?php

class Admin_IndexController 
    extends My_Controller_Action
{

    public function init()
    {
        parent::init();
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        /*
        $this->_helper->layout->setLayout ( 'admin/default' );
        $this->_helper->viewRenderer->setNeverRender(true);
        $this->_helper->layout()->disableLayout();
        */
        
        //$a = $this->render('static');
        
        // action body
        $this->session->deneme = "sss";
        /*
        $a = $this->renderScript('static/static.phtml');
        
        echo $a;
         
         */
    }


}

