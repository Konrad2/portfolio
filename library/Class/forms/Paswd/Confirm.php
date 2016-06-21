<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_forms_Paswd_Confirm extends Zend_Form_Element_Password {
	
	
	
	public function init(){
		
		$this->addValidator( new Class_Validators_Paswd_ConfirmPaswd() );
		
	}

}

?>