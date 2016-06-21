<?php

/**
 * 
 * @author Konrad
 * @package Sale
 *@link library forms
 */
class dataFromClient  extends  abstract_formDbParent //forms_factoryClient
{
	public function init(){
		//!---Shout be in config---!
		//require_once ('../library/forms/alNum20Req.php');
		$name = new Class_forms_alNum20Req('name');
		$name->setLabel('Imi�');				

		$surname = new Class_forms_alNum20Req('surname');
		$surname->setLabel('Nazwisko');
		
		//$this->setAction('sale/transaction/step1');
		$this->setAction('step1');
		
		/*						  
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
		

		 
		*/
		 
      //   $this->addElement($name);
     //    $this->addElement($surname);
		/* $this->addElement($street);
         $this->addElement($homeNr);
         $this->addElement($flat);
		 $this->addElement($postcode);
		 $this->addElement($city);
		 $this->addElement($mail);
		 
*/		
		 $submit = new Zend_Form_Element_Submit('Zamów');
		 $submit->setIgnore(true);	
		 $this->addElement($submit);	
		 
		 $this->patchToModel = '../application/modules/sale/models/sale.php';
		 $this->modelName = 'sale';
	}
	
	
	
	//public function insert($row=null, $data=null, $values=null){
	public function formToDb($row=null, $data=null, $values=null){
	
		require_once ('../application/modules/Sale/models/sale.php');
		
		$s = new sale();
		
		$params = $this->getValues();
		
		$newRow = $s->makeOrder($params, $values);		
		
		//if ($this->child != null)
			//$this->child->insert($newRow, $params);
			
		if( $this->child != null )
			 $this->child->formToDb($newRow, $params);
	}
	
}
?>