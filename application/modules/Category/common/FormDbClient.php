<?php
class FormDbClient extends FormDb_Connect_Client_Client {
	
	public function __construct($options = null) {
	 	
	 	
	 	parent::__construct( $options );
	 	
	 	
	 	$this->_tableName = 'category';
	 	 	
	 	$this->_modelStringName = 'Components_Category_models_formDbModel';
	 	
	 	
	 	$this-> setForeignKey ( 'id_category' );
	 
	 	$m = $this->getModel();
		
		$x = $m->getCategoryAndId();
		
		$x = Class_array::dimensionToArray($x);
	
		$x[] = null; 
		//$e = Class_forms_myHandling::createMultiCheckBox($x,'category');
		
		$e = new Zend_Form_Element_Select('category');
		
		
		$e->addMultiOptions($x);

		$this->addElement($e);	
	  
	 }

}
