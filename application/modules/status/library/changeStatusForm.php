<?php

/** 
 * @author Konrad
 * @package Status
 * 
 */
class changeStatusForm extends Zend_Form {
	//TODO - Insert your code here
	public function init(){
		
		$this->addElement(new Zend_Form_Element_Hidden('id'));
				
		$btn = new Zend_Form_Element_Submit('w');
		$btn->setLabel('Zmien status');
		$btn->setIgnore(true);
		
		$this->addElement($btn);
		
		$sel =  new Zend_Form_Element_Select('status');
		
		require_once '../application/modules/status/models/statusView.php';
		$input = Class_model::getColandId(new statusView(), 'status')->toArray();
		$sel = Class_forms_myHandling::createSelect($input ,'status');		
		$this->addElement( $sel );			
			
	//	$this->setAction($this->_request->getBaseUrl().'/status/admin/change');
	}

	/**
	 * Ustawia id rekordu w kturym dokonujemy zmian statusu.
	 * @param $id int
	 */
	public function setId($id){
		
		$elem = $this->getElement('id');
		$elem->setValue($id);
		$this->addElement($elem);
	}
	
	/**
	 * ustawia który element z select boxa powinienn byæ zaznaczony
	 * @param unknown_type $value
	 */
	public function setSelectValue($value){
		
		$elem = $this->getElement('status');
		$elem->setValue($value);
		$this->addElement($elem);
	}
	
}

?>