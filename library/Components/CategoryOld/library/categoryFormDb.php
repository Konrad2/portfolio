<?php
/**
 * 
 * @author Konrad
 * @package Category
 */
class categoryFormDb extends abstract_formDbParent {

	
	public function init() {
		
		
		$this->modelName = 'category';
		
		$this->patchToModel = '../application/modules/category/models/category.php';
		
		
		//require_once '../library/Class/forms/alNum20Req.php';
		$name = new Class_forms_alNum20Req('name');
		
		$name->setLabel('Nazwa kategori');
		
		$this->addElement($name);
		
		
		$this->foreignKey = 'id_subcategory';
		
		
		$sel = $this->getElemSelect('name','id_subcategory');
		
		$sel->setLabel('Podkategoria');
				
		$sel->setRequired(false);
		
		$this->addElement($sel);
		
		
		$submit = new Zend_Form_Element_Submit('submit');
		
		$submit->setIgnore(true);
		
		$this->addElement($submit);		
		
	}
	
	
	public function build( $param ) {
		
	}	
	
}

?>