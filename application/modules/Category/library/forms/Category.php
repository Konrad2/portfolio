<?php

class Category_library_forms_Category extends  FormDb_Connect_Parent {

	 public function __construct($options = null){
	 	
    	parent::__construct($options );
    	
    	$this->addelement ( new Forms_Elements_aTextPl ('name'));
	
		$this->addelement ( new Zend_Form_Element_Submit('Edytuj'));
    }   
}

