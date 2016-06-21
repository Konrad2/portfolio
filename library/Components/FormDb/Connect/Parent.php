<?php

/**
 * Nadrzedna klasa odpowiadajaca za po��czenie formularfza z baz� danych. Dodatkowo inne modu�y mog� dodawa� pola do formularza.
 * Aby doda� elem�ty z innych modu��w do formularza obiekt w innym module musi dziedziczy� po klasie abstract_formDbClient
 * @author Konrad
 * @package formDb
 *	@todo Dry
 */

class FormDb_Connect_Parent extends FormDb_Connect_aConnect implements  interfaces_formDb_parent {
//ToDo DRY

	
	
 public function __construct($options = null) {	 	
	 	
	 	parent::__construct( $options );	 	
	 	
	 		$this->_modelStringName = 'FormDb_Connect_models_Parent';
	 	
	 }
	
	
	/**
	 * Tworzy strukture z powizanych klas z innych modulw 
	 *  @param Class_param $param
	 */
	 
	
	public function build( Class_param $param ) {
		
		  $children = Components_System_library_System::service('iFormDb')->build( $param );	
		
		//$system = new Class_system();

	//	$children = $system->build( $param );

	 if ($children !== null ){
	 	
	 	
			$this->add( $children );
		
			$this->addForm( $children );
	 }

	}

	

	/**
	 * 
	 * @param unknown_type $subForm
	 */
	
	protected function addForm( $subForm ) {
		

		$fo = $subForm->getElements();

		
			foreach ($fo as $elem)
			
				$this->addElement( $elem );
				
	}

	
	
	/**
	 * Przys�ania metod� z interfaces_formDb_parent poniewarz musi przekazac nowy wiersz do dziecka
	 * @param unknown_type $row
	 * @param unknown_type $data
	 * @param unknown_type $values
	 */

	//public function insert($row=null, $data=null){
	 public function formToDb ($row = null, $data = null, $values = null ) {

	 	
		$s = $this->getModel();
		
		$t = $this->get();
		
		$params = $t->getValues();
		//$params = $this;//->getValues();

		$newRow = $s->doInsert( $row, $params, $values, $this->foreignKey );
		
		$newRow->save();
		
		
		//TODO - wrzucic do funkcji hasChild - return bool
		if ($this->child != null)
		
				$this->child->formToDb($newRow, $params, $values);

			
		$newRow->save();
		
		
		return $newRow;
		
	}
	
	
	
 	public function updateDb($row = null, $data = null, $values = null) {

 		
	//	require_once $this->patchToModel;
		
		$s = $this->getModel();

		$t = $this->get();
		
		$params = $t->getValues();
		//$params = $this;//->getValues();

		$freshRow = $s->doUpdate($row, $params, $this->getElement('id')->getValue(), $this->foreignKey);		
		
		if ($this->child != null)
		//	$this->child->doUpdate($freshRow , $params, $values);
			$this->child->updateDb($freshRow , $params, $values);
			
		
		return $freshRow;
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
		
		
		// po tym zerowało się id	
	/*	if ($this->child != null)
		
			$this->child->fill($row);
			*/
	
	}
	
	
	
	/**
	 * @return FormDbModel Zwraca model skojarzony z klas�. 
	 */
	/*
	public function getModel() {
		
	
		$model = new FormDb_models_formDbModelParent( array ( 'name' => $this->_tableName ) );
		
		return $model;
		
	}

	*/
}
