<?php
	  
class Cms_ManagementController extends Components_Cms_controllers_CmsController {
	
	
	public function init(){
		
		$this->_tableName = 'cms';
		$this->_helper->layout->setLayout('cms');
	}	
	
	public function sendmessageAction(){
		/*
		$message = new Components_Actions_Messages_SendMessage($this);
		
		$result = $message->sendMessageAction();
		*/
		
		
		
		$this->view->form = $form = new SendMessage_Form_SendMessage();
		
		if ($this->_request->isPost()){
			
			if ( $form->isValid($_POST)){
				
				$email = new Zend_Mail();				
				$val = $form->getValues();
				$email->setBodyText($val['messaage'])
    			->setFrom('ala.63@interia.pl', $val['name'])
    			->addTo($val['email'], 'Some Recipient')
    			->setSubject($val['subiect'])
    			->send();			

    			echo "wiadomość została wysłana";
			} else {
				echo "nie udało się ";
			}
			
		}
	}
	
}
