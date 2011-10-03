<?php
/**
 * @tutorial
 * $this->getMessengerModule()
    ->message('Data ekleme sırasında hata meydana geldi.')
    ->type(2)
    ->redirect('/admin/index')
    ->run(); 
 */
class My_Module_Messenger
{    
    /**
     * Type
     */
    const SUCCESS = 1;  // SUCCESS: 
    const ERR     = 2;  // Error: error conditions
    const WARN    = 3;  // Warning: warning conditions
    const NOTICE  = 4;  // Notice: normal but significant condition
    
	public $messages = array ();
    public $isError  = false;
    protected $_option;
    
    public function __construct()
    {
        $this->_option = null;
        $this->_setDefaultOption();
    }
    
    protected function _setDefaultOption()
    {
        $this->_option['flashMessengerOption']['type'] = null;
        $this->_option['flashMessengerOption']['title'] = null;
        $this->_option['flashMessengerOption']['text'] = null;
        $this->_option['redirector']                   = false;
        $this->_option['redirectorOption']['url'] = null;
    }
    
    public function message($text)
    {
        $this->_option['flashMessengerOption']['text'] =  $text;
        
        return $this;
    }
    
    public function title($title)
    {
        $this->_option['flashMessengerOption']['title'] =  $title;
        
        return $this;
    }    
    
    /**
     * @tutorial
     * SUCCESS = 1, ERR = 2, WARN = 3, NOTICE = 4
     * @param integer $type
     * @return Messenger 
     */
    public function type($type)
    {
        $this->_option['flashMessengerOption']['type'] = $type;
        
        return $this;
    }
    
    /**
     * @tutorial
     * ..->redirect('/admin/index');
     * @param string $url
     * @return Messenger 
     */
    public function redirect($url)
    {
        $this->_option['redirector'] = true;
        $this->_option['redirectorOption']['url'] = $url;
        
        return $this;
    }
    
    public function run()
    {
        $this->_prepare();
    }
    
    protected function _prepare()
    {
        $title = $this->_option['flashMessengerOption']['title'];
        $array = array();
        if ($this->_option['flashMessengerOption']['type']){
            switch ($this->_option['flashMessengerOption']['type']) {
                case self::SUCCESS:
                    $array['class'] = 'message message-success';
                    $array['id'] = 'message-success';
                    $array['icon'] = 'success.png';
                    $array['text'] = 'success';
                    $title = ($title) ? $title : 'Success Message';
                    break;
                case self::ERR:
                    $array['class'] = 'message message-error';
                    $array['id'] = 'message-error';
                    $array['icon'] = 'error.png';
                    $array['text'] = 'error';
                    $title = ($title) ? $title : 'Error Message';
                    break;            
                case self::WARN:
                    $array['class'] = 'message message-warning';
                    $array['id'] = 'message-warning';
                    $array['icon'] = 'warning.png';
                    $array['text'] = 'warning';
                    $title = ($title) ? $title : 'Warning Message';
                    break;            
                case self::NOTICE:
                    $array['class'] = 'message message-notice';
                    $array['id'] = 'message-notice';
                    $array['icon'] = 'notice.png';
                    $array['text'] = 'notice';
                    $title = ($title) ? $title : 'Notice Message';
                    break;            
                default:
                    $array['class'] = 'message message-notice';
                    $array['id'] = 'message-notice';
                    $array['icon'] = 'notice.png';
                    $array['text'] = 'notice';  
                    $title = ($title) ? $title : 'Notice Message';
                    break;

            }
            //Title değeri yoksa default ata
            $this->_option['flashMessengerOption']['title'] = $title;
            $this->_option['flashMessengerOption']['attr'] = $array;        
            //\Zend_Debug::dump($this->_option['flashMessengerOption']);die;

            $messenger = Zend_Controller_Action_HelperBroker::getStaticHelper ( 'FlashMessenger' );
            $messenger->resetNamespace();
            //$messenger->setNamespace('default');
            $messenger->addMessage($this->_option['flashMessengerOption']);	
            //$messenger->resetNamespace();                
        }
        
        if ($this->_option['redirector'] == true
            && $this->_option['redirectorOption']['url']
        ) {
            $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper ( 'Redirector' );

            $redirector->gotoUrl($this->_option ['redirectorOption'] ['url']);
        }         
    }


	public function add(array $option)
    {        
        $messengerOption = $option['flashMessengerOption'];
        
		if ($messengerOption ['textSuccess'] != '') {
			$message = array('text' => $messengerOption['textSuccess'],
							'class' => 'success',
							'title' => 'Başarılı!');
		} else if ($messengerOption ['textFailed'] != '') {
			$message = array('text' => $messengerOption['textFailed'],
							'class' => 'error',
							'title' => 'Hata!');
		}
					
		if(isset($option['params'])){
			$message = array_merge($message, $option['params']);
		}
		
		$messenger = Zend_Controller_Action_HelperBroker::getStaticHelper ( 'FlashMessenger' );
		$messenger->resetNamespace();
		$messenger->setNamespace('default');
		$messenger->addMessage($message);	
		$messenger->resetNamespace(); 
        
        if (isset ( $option ['redirector'] )
            && $option ['redirector'] == true
        ) {
            $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper ( 'Redirector' );
            $url = false;
            if (isset ( $option ['redirectorOption'] ['gotoSuccess'] )) {
                $url = $option ['redirectorOption'] ['gotoSuccess'];
            }

            if (isset ( $option ['redirectorOption'] ['gotoFailed'] )) {
                $url = $option ['redirectorOption'] ['gotoFailed'];
            }

            if ($url){
                $redirector->gotoUrl($url);
            }
        }   
	}
	
	public function get()
    {
		$messenger = Zend_Controller_Action_HelperBroker::getStaticHelper ( 'FlashMessenger' );
		$messenger->clearMessages();
		$messenger->setNamespace('default');		
		$getFlashMessengerMessages = $messenger->getMessages ();
		$messenger->resetNamespace();
		
		if (sizeof ( $getFlashMessengerMessages ) >= 1) {
			return end($getFlashMessengerMessages);
		}
        
		return false;
	}
    
    public static function getMessages()
    {
		$messenger = Zend_Controller_Action_HelperBroker::getStaticHelper ( 'FlashMessenger' );
		//$messenger->clearMessages();
		//$messenger->setNamespace('default');		
		$getFlashMessengerMessages = $messenger->getMessages ();
		//$messenger->resetNamespace();
		//\Zend_Debug::dump($getFlashMessengerMessages);die;
		if (sizeof ( $getFlashMessengerMessages ) >= 1) {
			return end($getFlashMessengerMessages);
		}
        
		return false;        
    }
}