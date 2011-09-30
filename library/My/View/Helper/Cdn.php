<?php
/**
 *
 * @tutorial
 * echo $this->cdn('dev-tools.js')->get('f');
 * echo $this->cdn('layout.css')->get('b');//admin
 * echo $this->cdn('vladstudio_underwater2.jpg')->get();
 */
class My_View_Helper_Cdn extends Zend_View_Helper_Abstract
{
    protected $_cdn;
    protected $_path;
    protected $_ext;
    
    /**
     * tiplere göre hangi klasöre bakacağına karar veriyoruz
     * @var type 
     */
    protected $_extPath = array(
        'css' => 'css',
        'js'  => 'scripts',
        'jpg' => 'images',
        'png' => 'images',
        'gif' => 'images',
    );

    public function  __construct()
    {
        $this->_cdn = Zend_Registry::get('config')->cdn;
    }
    
    /**
     * Uzantıya göre hangi yolun seçileceğini belirtiyoruz
     * @param type $vendor 
     */
    protected function _setExtPath($vendor)
    {
        $this->_extPath = array(
            'css' => $vendor->css,
            'js'  => $vendor->js,
            'jpg' => $vendor->img,
            'png' => $vendor->img,
            'gif' => $vendor->img,
        );
    }
   
    public function cdn($path)
    {
        $this->_path = $path;
        $pathInfo = pathinfo($path);
        $this->_ext = $pathInfo['extension'];
        
        return $this;
    }
    
    /**
     * f = frontend
     * @param type $type
     * @param type $scheme
     * @return string 
     */
    public function get($type = 'f', $scheme = null)
    {     

        $vendor = $this->_cdn->{$type};
        $this->_setExtPath($vendor);

        $prePath = isset($this->_extPath[$this->_ext]) ? $this->_extPath[$this->_ext] . '/' : '';

        $cdn = $vendor->cdn . '/' . $vendor->path . '/' . $prePath . $this->_path;
 
        return $cdn;
    }
}
