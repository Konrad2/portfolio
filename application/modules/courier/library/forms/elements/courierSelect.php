<?php

class courier_library_forms_elements_courierSelect extends Zend_Form_Element_Select {

	 public function __construct($spec, $options = null){
    	parent::__construct($spec, $options);
    	
    	require_once '../application/modules/courier/models/courier.php';
    	$m = new courier();
    	
		$s = Class_forms_myHandling::createSelect( $m->getNames('courier_name')->toArray(),'id_courier');
		$s->setLabel('Kurier');
    }
	
}

