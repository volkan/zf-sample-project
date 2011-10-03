<?php

class Admin_UserController 
    extends My_Controller_Action 
{
    
    public function init ( ) 
    {
        parent::init();
        
        $this->_helper->layout->setLayout ( 'user/login' );
    }

    public function indexAction ( ) 
    {
        $this->getMessenger()
            ->message('Yönlendirme test amaçlı.')
            ->type(4)
            ->redirect('/admin/user/login')
            ->run();          
    }
	
    public function loginAction()
    {
        $this->_helper->layout->setLayout ( 'admin/login' ); 
   
        /*
         * giriş yapmışsa ana sayfaya yönlendir
         */
        //if ($this->getUserService()->checkLogin()){         
        //}
        //Zend_Debug::dump(get_include_path());die;
        $form = new Form_User_Login ();        

        if ($this->_request->isPost()
            && $form->isValid ( $this->getRequest()->getPost() )
        ) {                
            $params = $form->getValues ();

            $user = new stdClass();
            $user->email = $params['email'];//'volkanaltan@gmail.com';
            $user->password = $params['password'];//'123456';
            $remember = $params['remember'];
            
        }
        
        $this->view->form = $form;        
    }
    
    public function logoutAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);       
    }
    
}
?>