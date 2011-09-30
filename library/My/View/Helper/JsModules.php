<?php

class My_View_Helper_JsModules extends Zend_View_Helper_Abstract
{
    /**
     * @var Zend_View_Interface
     */
    public $view;
    
    /**
     * layoutda body tagında data-jsModules attribute sine hangi 
     *js modüllerinin çalışacağını bildiriyoruz
     */
    public function jsModules()
    {
        $r = $this->view->getRequest();
        $resource = $r->getActionName(). '.' 
                . $r->getControllerName() . '.'
                . $r->getModuleName();
        //echo $resource.' ';
        $modules = '';
        switch ($resource) {
            case 'index.index.default':
                $modules = 'index';
                break;           
            case 'index.deneme-index.default':
                $modules = 'denemeIndex';
            default:
                break;
        }
        
        return 'common ' . $modules;
    }
    
    
    /**
     * Sets the view field
     * @param $view Zend_View_Interface
     */
    public function setView (Zend_View_Interface $view)
    {
        $this->view = $view;
    }    
}
