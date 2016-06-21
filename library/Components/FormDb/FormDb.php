<?php

/**
 * 
 * @author Konrad
 * @package formDb
 */
class FormDb_FormDb  extends FormDb_aFormDb {
	
	
 	public function __construct($options = null) {
	 	
	 	
	 	parent::__construct( $options );
	 	
	 	$this->_modelStringName = 'FormDb_models_FormDb';
	 	
	 }
	

	/**
	 * Tworzy instancje modelu z danych zawartyw w $patchToModel oraz $modelName. Wywołuje metody doInsert w modelu.
	 * 
	 * @param $row
	 * @param $data
	 * @param $values
	 * @return row
	 */
	
	public function formToDb($row = null, $data = null, $values = null) {

	 	
		$model =  $this->getModel();

		$model->doInsert($row, $data, $values, $this->foreignKey);
		//$model->doInsert($row, $this->getValues(), $values, $this->foreignKey);

	//	if( $this->child != null )
		
		//	 	$this->child->formToDb($row, $data, $values);

			 	
		return $row;
		
	}

	
	/**
	 * @return FormDbModel Zwraca model skojarzony z klasy. 
	 */	
	public function getModel() {
		
	
		if ( empty ( $this->_tableName ) )
		
				throw new Exception('Nie zdefiniowano nazwy tabeli w bazie danych. Użyj metody setTableName');
				
				
		$model = new $this->_modelStringName( array ( 'name' => $this->_tableName ) );
		
		return $model;
		
	}
		

	/**
	 * Usuwa rekord według id.
	 * @param unknown_type $id
	 */
	
	public function delete( $id ){
	
		$this->getModel()->deleteEntite( $id );
		
		//if( $this->child != null )
		//	 $this->child->delete( $id );
	}
	
	
	/**
	 * Surzy do zaimplementowania dodatkowych czynnosci sprawdzajcych np.: czy podany login jest wolny.
	 * @return wraca komunikat bledu. Jeli wszystko jest wporzadku, zwraca null.
	 * 
	 */
	
	public function isCorect() {
		
		return null;
	} 
	


}
