<?php

class Admin_IndexController extends My_Controller_Action
{

    public function init()
    {
        parent::init();
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->session->deneme = "sss";
        /*
        $a = $this->renderScript('static/static.phtml');
        
        echo $a;
         
         */
    }


}

