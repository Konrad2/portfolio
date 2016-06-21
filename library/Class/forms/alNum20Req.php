<?php 
/** 
 * @author Konrad
 * @package Form
 * 
 * 
 */
class Class_forms_alNum20Req extends Zend_Form_Element_Text
{
	
	 public function __construct($spec, $options = null) {
	
	 	
	 	parent::__construct($spec, $options);
	 	
	 	
		$this->addValidator(new Zend_Validate_StringLength(1, 20), true)
			->addFilter(new Zend_Filter_Alnum())
			->setRequired(true);
			
	}
}
?>