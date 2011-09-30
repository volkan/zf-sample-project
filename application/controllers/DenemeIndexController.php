<?php

class DenemeIndexController extends My_Controller_Action
{

    public function init()
    {
        parent::init();
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        //$this->session->deneme = "sss";
        $this->view->degisken1 =  $this->session->deneme;
        
        $w = new Model_DbTable_Word();
        $data1 = $w->find(1)->toArray();
        $data2 = $w->fetchAll(array('id = ?' => 2))->toArray();
        
        Zend_Debug::dump($data1, 'data1');
        Zend_Debug::dump($data2, 'data2');
    }


}

