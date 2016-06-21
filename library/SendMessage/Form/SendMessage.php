<?php

class SendMessage_Form_SendMessage extends Forms_Base  {
	
	 public function __construct($options = null){
	 	
		parent::__construct($options);
		
		
		$this->addElement(new Forms_Elements_Email('email',array('label'=>'Podaj swój e-mail')));
		$this->addElement(new Forms_Elements_Name('name', array('label'=>'Imię')));		
		$this->addElement(new Forms_Elements_TextPL64('subiect', array('label'=>'Temat')));
		$this->addElement(new Forms_Elements_TextPL65536('messaage', array('label'=>'Treść wiadomości')));
		
		$this->addElement(new Zend_Form_Element_Submit('Wyslij'));
		
	}
}

?>