<?php

class courier_library_Forms_Courier extends FormDb_Connect_Parent{

	public function init(){
	parent::init();
	
	$this->addelement ( new Forms_Elements_aTextPl ('courier_name'));
	
	$this->addelement ( new Zend_Form_Element_Submit('Edytuj'));
	
	}
	
}

