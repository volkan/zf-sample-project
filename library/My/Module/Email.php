<?php
class My_Module_Email
{
    protected $_config;
    protected $_smtpServer;
    
    protected $_fromName;
    protected $_fromEmail;
    protected $_replyTo;
    protected $_replyName;
    
    public function __construct() 
    {
        $configParam = $params = Zend_Registry::get('config')->prj->mail;

        $this->_smtpServer = $configParam->smtpServer;
        $this->_fromEmail  = $configParam->from->email;
        $this->_fromName   = $configParam->from->name;
        $this->_replyTo   = $configParam->reply->to;
        $this->_replyName = $configParam->reply->name;
        $this->_config     = $configParam->config->toArray();
    }
    
    public function setConfig(stdClass $config)
    {
        $this->_config = (array)$config;
    }    
    
	public function sendEmail ( $to = array(), $cc = array(), $bcc = array(), $subject = null, $text = null, $html = null, $arrFileData = array() ) 
    {
		$transport = new Zend_Mail_Transport_Smtp ( $this->_smtpServer, $this->_config );
		
		$mail = new Zend_Mail ( 'UTF-8' );
		
		if ( $text != null ){
			$mail->setBodyText ( $text );
		} else if ( $html != null ) {
			$mail->setBodyHtml ( $html );
		} else {
			$mail->setBodyText ( $text );
		}
		
		if (count($arrFileData)>0)	{
			foreach ($arrFileData as $value) {
    			$fileSize = $value['FileSize'];
    			$fileName = $value['FileName'];
    			$fullpath = $value['FilePath'];$attachment->type = Helper_Common::getMimeContentType($fullpath);
				$attachment = new Zend_Mime_Part(file_get_contents($fullpath));
				/*
				$attachment->type = Helper_Common::getMimeContentType($fullpath);
				$attachment->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
				*/
				$attachment->disposition = Zend_Mime::DISPOSITION_INLINE;
				$attachment->encoding = Zend_Mime::ENCODING_BASE64;				
				$attachment->filename = $fileName;	
				$mail->addAttachment($attachment);	
			}
		}
		
		

		foreach ( $to as $value ) {
			$name = (isset($value['name'])) ? $value['name'] : '';
			$mail->addTo ( $value['mail'], $name );
		}	
		
		if(count($cc)>0)
			foreach ( $cc as $value ) {
				$name = (isset($value['name'])) ? $value['name'] : '';
				$mail->addCc ( $value['mail'], $name );
			}

		if(count($bcc)>0)
			foreach ( $bcc as $value ) {
				$name = (isset($value['name'])) ? $value['name'] : '';
				$mail->addBcc ( $value['mail'], $name );
			}
            
        if ($this->_replyTo){
            $rn = ($this->_replyName) ? $this->_replyName : null;
            $mail->setReplyTo($this->_replyTo, $rn);
        }    

		$mail->clearFrom();
		$mail->setFrom ( $this->_fromEmail, $this->_fromName );
		$mail->setSubject ( $subject );
		$mail->send ( $transport );
	}
}