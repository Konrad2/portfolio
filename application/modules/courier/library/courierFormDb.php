<?php

/** 
 * @author Konrad
 * 
 * 
 */
class courierFormDb extends abstract_formDbParent {
	//ToDo DRY
	public function init(){
	
        $this->setMethod('post'); 
    		
		
		$name = new Class_forms_alNum20Req('courier_name');
		$name->setLabel('Nazwa kuriera');
		
		$price= new Class_forms_alNum20Req('package_price');
		$price->setLabel('cena przesylki');
		
		$submit = new Zend_Form_Element_Submit('Dodaj');
		$submit->setIgnore(true);	
		
		$this->addElement($name);
        $this->addElement($price);
        $this->addElement($submit);
        
        //namiary na klase dodaj�c� do bazy implem�tuj�c� interfejs implements_formDb_model
        $this->patchToModel = '../application/modules/courier/models/courier.php';
        $this->modelName = 'courier';
	}
	
}

?>