<?php
/**
 * Umożliwia edytowanie
 * @author Konrad
 * @package formDb
 */
class FormDb_Editable extends FormDb_FormDb  {
	
	
	public function __construct($options = null) {
		
		
		parent::__construct($options);
		
		
		$this->_modelStringName = 'FormDb_models_Edit';
			
		
		$elem = new Zend_Form_Element_Hidden('id');
		
		$elem->addFilter( new Zend_Filter_Int());
		
		
		$this->addElement($elem);		
	}
	/**
	 * Podiera wiersz z bazy o danym id, nastempnie
	 * Wype�nia formularz danymi z rekordu.
	 * @param Zend_Db_Table_Row $parentRow
	 */
	
	//public function fill( Zend_Db_Table_Row $parentRow) {
	public function fill( $parentRow) {
		 
		
		$m = $this->getModel();
		
		$rowset = $m->find($parentRow[$this->foreignKey]);
		
		$row = $rowset->current();
		
		$elements = $this->getElements();
		
		
		foreach( $elements as $elem ) {	
			
				$elem->setValue($row[$elem->getName()]);
			
				$this->addElement($elem);
				 
		}	
		
		
		//if ($this->child != null)
		
				//$this->child->fill( $parentRow );
				
	}
	
	
	
	/**
	 * Uaktualnia rekord w bazie danych.
	 * @param unknown_type $row
	 * @param unknown_type $data
	 * @param unknown_type $values
	 */
	
	public function updateDb($row = null, $data = null, $values = null){	
	 	 	
		
			
		//require_once $this->patchToModel;

		$model = $this->getModel();

		$updatedRow = $model->doUpdate($row, $data, $values, $this->foreignKey);

			
		if( $this->child != null )
		
				 $this->child->updateDb($row, $data, $values);
				 
				 
		return $updatedRow;
				 
	}
}
