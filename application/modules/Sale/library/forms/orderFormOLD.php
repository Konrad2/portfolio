<?php
require_once ('../library/forms/wrapForm.php');
class orderForm extends wrapForm
{
	public function init()
	{
	require_once ('../library/forms/alNum20Req.php');
		$name = new alNum20Req('name');
		$name->setLabel('Imiê');				

		$surname = new alNum20Req('surname');
		$surname->setLabel('Nazwisko');
		
								  
        $street = new alNum20Req('street');
		$street->setLabel('ulica');
		
		$homeNr= new alNum20Req('house_nr');
		$homeNr->setLabel('Numer lokalu');
		
		$flat = new alNum20Req('flat_nr');
		$flat->setLabel('Mieszkanie');
		
		$postcode= new alNum20Req('postcode_city');
		$postcode->setLabel('Kod pocztowy');


		$city = new alNum20Req('city');
		$city->setLabel('Miasto');
		
		$mail = new Zend_Form_Element_Text('mail');
		$mail->setLabel('mail')
			 ->addValidator( new Zend_Validate_EmailAddress());
		

		 $submit = new Zend_Form_Element_Submit('btn-submit');		 
		
		 
         $this->addElement($name);
         $this->addElement($surname);
		 $this->addElement($street);
         $this->addElement($homeNr);
         $this->addElement($flat);
		 $this->addElement($postcode);
		 $this->addElement($city);
		 $this->addElement($mail);
		 
		
		 $this->addElement($submit);		
	}
}
?>