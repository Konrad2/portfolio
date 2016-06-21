<?php

class Packages_Products_library_forms_Product extends FormDb_Connect_Parent  {

	
 	public function __construct($options = null)
    {
    	parent::__construct($options );
    	
    	$this->addelement ( new Forms_Elements_aTextPl ('name'));
    	
    	$description = new Zend_Form_Element_Textarea('description');
						
						$description->addValidator(new Zend_Validate_StringLength( 0, 60000, 'UTF-8' ), true )
								->setRequired(true)
								//->addErrorMessage('Pole musi zawierać treść')
								->addValidator ( new  myZend_Validate_TextPl() )
								->addValidator(new myZend_Validate_NotEmpty(), true)						
								->setLabel('Opis')				
								->addFilter('StringTrim');
		$this->addelement ( $description);
	
		$this->addelement ( new Zend_Form_Element_Submit('wyslij'));
		
		$this->_modelStringName = 'Packages_Products_model_formDb';
    }
    
    public function fill($parentRow) {
    	
    	parent::fill($parentRow);
    	
    	$parentRow = $this->getModel()->find($parentRow)->current();
    	
    	//var_dump($parentRow);
    	$category = $this->child->getElement('category');
    	$category->setValue($parentRow->id_category);

    	 $this->child->addElement($category);

    }
    
    
    	
    
}
