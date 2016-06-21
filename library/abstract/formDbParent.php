<?php

/**
 * Nadrz�dna klasa odpowiadaj�ca za po��czenie formularfza z baz� danych. Dodatkowo inne modu�y mog� dodawa� pola do formularza.
 * Aby doda� elem�ty z innych modu��w do formularza obiekt w innym module musi dziedziczy� po klasie abstract_formDbClient
 * @author Konrad
 * @package FormDb
 *
 */

abstract class abstract_formDbParent extends abstract_formDbClient implements  interfaces_formDb_parent {
//ToDo DRY

	public function __construct($options = null) {
		
		
		parent::__construct($options);
		
		
		$elem = new Zend_Form_Element_Hidden('id');
		
		$elem->addFilter( new Zend_Filter_Int());
		
		
		$this->addElement($elem);
		
		
	}
	
	
	/**
	 * Tworzy strukture z powizanych klas z innych modułów
	 */
			
	public function build( Class_param  $param ) {
		
		
		$system = new Class_system();

		$children = $system->build( $param );

		$this->add($children);
				
	}

	
	protected function addForm( $subForm ) {
		

		$fo = $subForm->getElements();

		
			foreach ($fo as $elem)
			
				$this->addElement( $elem );
				
	}

	
	
	/*
	 * Przys�ania metod� z interfaces_formDb_parent poniewarz musi przekaza� nowy wiersz do dziecka
	 * @param unknown_type $row
	 * @param unknown_type $data
	 * @param unknown_type $values
	 */

	//public function insert($row=null, $data=null){
	 public function formToDb($row = null, $data = null, $values = null) {

	 	
		require_once $this->patchToModel;
		
		
		$s = new $this->modelName();

		
		$t = $this->get();
		
		$params = $t->getValues();
		//$params = $this;//->getValues();

		$newRow = $s->doInsert($row, $params, $values, $this->foreignKey);
		
		$newRow->save();
		
		
		
		//TODO - wrzucic do funkcji hasChild - return bool
		if ($this->child != null)
			$this->child->formToDb($newRow, $params, $values);

			
		$newRow->save();
		
		return $newRow;
		
	}
	//--------client
	
	/*
		require_once $this->patchToModel;

		$model = new $this->modelName();

		$model->doInsert($row, $data, $values, $this->foreignKey);
		//$model->doInsert($row, $this->getValues(), $values, $this->foreignKey);

		if( $this->child != null )
			 $this->child->formToDb($row, $data, $values);
			 
		return $row;
		*/
	//---
 	public function updateDb($row = null, $data = null, $values = null) {

 		
		require_once $this->patchToModel;
		
		$s = new $this->modelName();

		$t = $this->get();
		
		$params = $t->getValues();
		//$params = $this;//->getValues();

		$freshRow = $s->doUpdate($row, $params, $this->getElement('id')->getValue(), $this->foreignKey);		
		
		if ($this->child != null)
		//	$this->child->doUpdate($freshRow , $params, $values);
			$this->child->updateDb($freshRow , $params, $values);

	}
	
	
	
	/**
	 * Podiera wiersz z bazy o danym id, nastempnie
	 * Wype�nia formularz danymi z rekordu.
	 * @param int $parentRow
	 */
	
	public function fill($parentRow) {
		
		
		$id = $parentRow;
		
		$m = $this->getModel();
		
		$rowset = $m->find($id);
		
		$row = $rowset->current();
		
		$elements = $this->getElements();
		//for ($i = 0; $i<count($element); $i++ ){
		
		
		foreach($elements as $elem) {	
			
			
			if( isset( $row[ $elem->getName() ] ) )	{
				
				
				$elem->setValue( $row[ $elem->getName() ] );
				 
				$this->addElement( $elem );
				
			}
			
		}
		
		
		if ($this->child != null)
		
			$this->child->fill($row);
			
	}

	
}
?>