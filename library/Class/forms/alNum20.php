<?php 
/** 
 * @author Konrad
 * @package Form
 * 
 * 
 */
class Class_forms_alNum20 extends Zend_Form_Element_Text
{
	public function init()
	{
		$this->addValidator(new Zend_Validate_StringLength(0, 20), true)
			->addFilter(new Zend_Filter_Alnum());
		
	}
}
?>