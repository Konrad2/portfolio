<?php

class FormDbClient extends abstract_formDbClient {

	public function init(){
		
		$this->modelName = 'formDb';
		$this->patchToModel = '../application/modules/category/models/formDb.php';
		
		$m = $this->getModel();
		
		$x = $m->getCategoryAndId();
		
		$x = Class_array::dimensionToArray($x);
			
//		$e = Class_forms_myHandling::createCheckBox( $x );
	//	$e = Class_forms_myHandling::createRadio( $x );
		$e = Class_forms_myHandling::createMultiCheckBox($x,'category');

		$this->addElement($e);

		//foreach($e as $x)
			//$this->addElement($x);
	}
	/*
	public function formToDb($row = null, $data = null, $values = null){
		
		$m = $this->getModel();
		$m->createRow();
		
	}
	*/
}

?>