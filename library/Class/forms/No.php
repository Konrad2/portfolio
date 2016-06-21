<?php
/**
 * 
 * @author Konrad
 * @package Form
 */
class Class_forms_No extends Zend_Form {

	public function init(){
		
		$b = new Zend_Form_Element_Submit('answer');
		
		$reg = new Zend_Validate_Regex( array('pattern' => '/no/') );
		
		$b->addValidator($reg )
			->setValue('no')
			->setLabel('Nie');

		$this->addElement($b);
	}
}

?>