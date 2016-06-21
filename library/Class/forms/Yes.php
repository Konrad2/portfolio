<?php
/**
 * 
 * @author Konrad
 * @package Form
 */
class Class_forms_Yes extends Zend_Form {

	
	public function init(){
		
		
		$b = new Zend_Form_Element_Submit('answer');
		
		
		$b->addValidator( new Zend_Validate_Regex( array('pattern' => '/yes/') ) )
		
		  ->setLabel("Tak");

		$this->addElement($b);
		
	}
	
}
?>