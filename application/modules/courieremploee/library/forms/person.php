<?php
class person extends  FormDb_Connect_Parent  {
	
		public function __construct($options = null) {
		
		parent::__construct($options );		
		$this->setTableName('person');
		
		
		$name = new Class_forms_alNUm20Req('name');
		$name->setLabel('Imie');
		$this->addElement($name);
		
		$sur = new Class_forms_alNUm20Req('surname');
		$sur->setLabel('Nazwisko');
		$this->addElement($sur);
		
		$phone = new Class_forms_alNUm20Req('phone');
		$phone->setLabel('Telefon');
		$this->addElement($phone);
		
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('e-mail')
			->addValidator(new Zend_Validate_EmailAddress() );
		
		$this->addElement($email);
		
		$this->addElement( new Zend_Form_Element_Submit('Edytuj'));
		}

}
