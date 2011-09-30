<?php
/**
 *
 * @author volkan
 * @version 
 */

/**
 * {1} helper
 *
 * @uses viewHelper {0}
 */
class My_View_Helper_GetRequest 
{

	/**
	 *  
	 */
	public function getRequest() {
		// TODO Auto-generated {0}_{1}::{2}() helper 
		
		return Zend_Controller_Front::getInstance()->getRequest();
		//return null;
	}
}
