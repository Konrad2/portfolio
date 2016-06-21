<?php
/** 
 * Komponent odpowiada za pobieranie danych od urzytkownika i zapisywaniu ich w bazie danych.
 * Dane zapisywane są w tabelli o nazwie podanej w $this->_tableName. Zapisywanie odbywa się za pomocą metody $this->formToDb. Komponęt umożliwia równierz kasowanie rekordów poprzez metodę delete.
 * @package formDb  
 */
 
abstract class FormDb_aFormDb  extends Zend_Form {
	
	/**
	 * Nazwa tabeli w bazie
	 * @var string
	 */
	protected $_tableName;
	
	
	/**
	 * Nazwa klasy modelu.
	 */
	
	protected $_modelStringName;
	
	
	
	 public function __construct($options = null) {
	 	
	 	
	 	parent::__construct( $options );
	 	
	 }
	 
	//abstract public function doInsert();
	
	
	public function setTableName( $name ) {		
				
		$this->_tableName = $name;
	}
	
	
	/**
	 * 
	 * Ustawia nazwę klasy modelu. Urzyj funkcji aby zmienić domyślny model wykorzystywany przez kąponent.
	 * @param unknown_type $str
	 */
	
	protected function _setModelStr ( $str ) {
				
		$this->_modelStringName = $str;
		
	}
	
	
	/**
	 * @return FormDbModel Zwraca model skojarzony z klas�. 
	 */	
	 abstract public function getModel();
	
	/**
	 * Tworzy instancje modelu z danych zawartyw w $patchToModel oraz $modelName. Wywołuje metody doInsert w modelu.
	 * Zwraca Dodany wiersz.
	 * 
	 * @param $row
	 * @param $data
	 * @param $values
	 * @return Zend_Db_Table_Row
	 */
	
	abstract public function formToDb($row = null, $data = null, $values = null);
	

	/**
	 * Usuwa rekord według id.
	 * @param unknown_type $id
	 */
	
	abstract public function delete( $id );
	
	
	/**
	 * Surzy do zaimplementowania dodatkowych czynnosci sprawdzajcych np.: czy podany login jest wolny.
	 * @return wraca komunikat bledu. Jeli wszystko jest wporzadku, zwraca null.
	 * 
	 */
	
	public function isCorect() {
		
		return null;
	} 

	//---------------------
	/**
	 * Dodatkowo
	 */

		/**
	 * @return Zend_Form_Element_Select
	 * 
	 * @param string $colName nazwa kolumny z kturej maj� by� pobrane opcje selectBox.	 
	 * @assert-in model->_col{$colName} (tabela bazy danych zawiera kolumn� o nazwie podanej w $colName).	 
	 * @param string $name nazwa selectBox.
	 */
	
	public function getElemSelect( $colName, $name ) {

		
		$t = $this->getModel();

		$table = $t->getNames( $colName )->toArray();

		
		if ( count( $table ) > 0 ) {
						
				$sel = Class_forms_myHandling::createSelect( $table, $name );
		}
		

		return $sel;
		
	}
	

	/**
	 * Dodaje element select. Tworzy go z id oraz etykiet zawartych w kolumnie podanej w $colName.
	 * @param string Nazwa kolumny z kturej zawarto�ci zostan� wstawionw do select-a.
	 * @param string Pod jakim tytu�em wy �wietli si� select.
	 */

	public function addSelectFromTable( $label, $colName, $name ) {

		
		$t = $this->getModel();
		
		//$sel = $this->getElemSelect( $t->getNames($colName)->toArray(), $name);
		$sel = Class_forms_myHandling::createSelect( $t->getNames( $colName )->toArray(), $name );

		$sel->setLabel( $label );
		
		$this->addElement( $sel );
		
	}	
	
 public function build( Class_param $param ){
 	
 }

	/*
	public function addSelectFromTable($label, $colName){

		$t = $this->getModel();

		$table = $t->getNames($colName);

		
		if ( count($table) > 0 )
		{
			$sel= new Zend_Form_Element_Select( $this->foreignKey );
			$sel->setLabel($label);
				//->setRequired(false);

			foreach($table->toArray() as $r)
			{
				$sel->addMultiOption(array_shift($r), array_shift($r));
			}
			$this->addElement($sel);
		}
	}
*/
}

?>