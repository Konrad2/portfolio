<?php

class Components_Address_library_forms_Address extends  FormDb_Connect_Parent {
	
	
	public function __construct($options = null) {
		
		parent::__construct($options );
		
		$this->setTableName('address');
		
		$elements = array();		
		$elements[] = new Class_forms_elements_AlphaPl32Req('street',array('label'=>'Ulica'));  		
		$elements[] = new Class_forms_elements_Num5Unsigned ('house_nr',array('label'=>'Numer domu')); 
		$elements[] = new Class_forms_elements_Num5Unsigned ('flat_nr',array('label'=>'Numer lokalu'));
		$postcode =  new Zend_Form_Element_Text('postcode', array('label'=>'Kod Pocztowy'));
                $postcode->addValidator(New Zend_Validate_Regex('/^[0-9]{2}-?[0-9]{3}$/Du'));
                $elements[] = $postcode;
		$elements[] = new Class_forms_elements_AlphaPl32Req('city', array('label'=>'Miasto'));
		$elements[] = new Zend_Form_Element_Submit ('Edytuj');  
		$this->addElements ($elements);
                
               
	}
	

}
