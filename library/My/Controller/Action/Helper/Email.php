<?php
/**
 * 
 * @author Volkan
 * @version
 */

class My_Controller_Action_Helper_Email extends Zend_Controller_Action_Helper_Abstract
{	
    protected $_email;

    public function __construct() 
    {
        $this->_email = new My_Module_Email();
    }

    /**
     * @example
     *  $to = array ( 
            array('mail' => 'volkanaltan@gmail.com', 'name' => 'Yönetim Paneli')
        );
     * @param string $userId
     * @param string $security
     * @param type $to 
     */
    public function forgetPassword($userId, $security, $to = array()) 
    {
        // Mail phtml
        $view = new Zend_View;
        $view->setScriptPath(APPLICATION_PATH . '/modules/admin/views/mails/');

        $view->assign('security', md5($security));
        $view->assign('userId', $userId);

        $message = $view->render('forget-password.phtml'); 

        $subject='Şifre Resetleme -- Sample Project';	
        
        $this->_email->sendEmail($to, array(),array(),$subject,null,$message);
    }
    
    public function error($message)
    {
        $subject='Hata Oluştu -- SampleProject';
        
        $mail = Zend_Registry::get('config')->prj->mail->admin->toArray();
        $to = array ( 
            array('mail' => $mail['email'], 'name' => $mail['name'])
        );
        $this->_email->sendEmail($to, array(),array(),$subject,null,$message);        
    }
 
    public function direct()
    {
        return $this;
    }    
}
