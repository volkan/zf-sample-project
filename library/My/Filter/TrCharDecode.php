<?php

class My_Filter_TrCharDecode implements Zend_Filter_Interface 
{
	
    public function filter($value) 
    {
        return $this->_htmlTrCharDecode($value);
    }
    
	protected function _htmlTrCharDecode ($value) 
    {
		$htmlEncoding = array('&Ccedil;','&#286;', '&#304;', '&Ouml;', '&#350;', '&Uuml;', '&ccedil;', '&#287;', '&#305;', '&ouml;', '&#351;', '&uuml;');
		$trCharacter = array('Ç','Ğ', 'İ', 'Ö', 'Ş', 'Ü', 'ç', 'ğ', 'ı', 'ö', 'ş', 'ü');
		$decode = str_replace($htmlEncoding, $trCharacter, $value);
		return $decode;
	}    
}