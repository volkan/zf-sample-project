<?php
/**
 * 
 * @author Volkan
 * @version
 */

class Zend_View_Helper_Code extends Zend_View_Helper_Abstract {
	
	/**
	 * @var Zend_View_Interface 
	 */
	public $view;
    
	public function code() 
    {
		return $this;		
	}
    
    public function rand()
    {
        return rand(9999, 999999);
    }
	/**
	 * Sets the view field 
	 * @param $view Zend_View_Interface
	 */
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}    
}
