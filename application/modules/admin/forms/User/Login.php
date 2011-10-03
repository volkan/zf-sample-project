<?php

class Form_User_Login extends Zend_Form
{
    protected $_formType;
    
    public $formElements = array(
        'ViewHelper',
        'Errors',
        //array('HtmlTag', array('tag' => 'div'))      
    );
	public $buttonDecorators = array(
        'ViewHelper',
        //array('HtmlTag',array('tag' => 'td','class'=>'tdsubmit','colspan'=>2)),
        //array('Label', array('tag' => 'td','class'=>'lbl','style'=>'display:none')),
        //array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
    );
    /**
     * type = 1 : Login ekranı
     * type = 2 : Şifre Değiştir
     * type = 3 : Şifremi unuttum
     * @param type $type 
     */
    public function __construct($type = 1)
    {
        parent::__construct();
        $this->_formType = $type;
        
        $this->createForm();
        
    }

    public function createForm()
    {
    	$this->setDecorators(array(
			'FormElements',
			array('HtmlTag', array('tag' => 'table')),
		    'Form',
		));    	
    	$this->setAttribs(array(
                            'method'=>'post',
                            'name'=>'login',
                            'id'=>'login')
        );
        $this->setElementDecorators($this->formElements);
        
        switch ($this->_formType) {
            case 1:
                $this->addElement ('text', 'email', array (
                    'required' => true,
                    'validators' => array(
                        array (
                            'validator' => 'StringLength',
                            'options' => array (5, 30 ) 
                        ),
                        array ('validator' => 'EmailAddress')
                    ),
                    'style' => 'border:none;',
                    'size' => 32
                ));
                $this->addElement ('password', 'password', array (
                    'required' => true,
                    'validators' => array(
                        array (
                            'validator' => 'StringLength',
                            'options' => array (4, 30 ) 
                        ) 
                    ),            
                    'style' => 'border:none; border-color:#FFF'
                ));
                break;
            case 2:
                $this->addElement ('password', 'password', array (
                    'required' => true,
                    'validators' => array(
                        array (
                            'validator' => 'StringLength',
                            'options' => array (4, 30 ) 
                        ) 
                    ),            
                    'style' => 'border:none; border-color:#FFF'
                ));
                $this->addElement ('password', 'password2', array (
                    'required' => true,
                    'validators' => array(
                        array (
                            'validator' => 'StringLength',
                            'options' => array (4, 30 ) 
                        ) 
                    ),            
                    'style' => 'border:none; border-color:#FFF'
                ));                
                break;
            case 3:
                $this->addElement ('text', 'email', array (
                    'required' => true,
                    'validators' => array(
                        array (
                            'validator' => 'StringLength',
                            'options' => array (5, 30 ) 
                        ),
                        array ('validator' => 'EmailAddress')
                    ),
                    'style' => 'border:none;',
                    'size' => 32
                ));                
                break;
            default:
                break;
        }

        $this->addElement(
                    'submit',
                    'submit',
                    array(
                        'ignore'   => true,
                        'label'    => 'Giriş Yap',
                    	'class'    => 'loginbtn',
                    	'decorators' => $this->buttonDecorators
        ));
        $this->setElementFilters(array('StringTrim','StripSlashes','HtmlEntities')) ;
   		$this->addElementPrefixPaths(array('filter' => array(
        	'prefix' => 'My_Filter',
        	'path'   => 'My/Filter'
    	)));
    }
}
?>