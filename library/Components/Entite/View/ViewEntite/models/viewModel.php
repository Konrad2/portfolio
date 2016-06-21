<?php
/**
 * Klasa abstrakcyjna niezbedna do kontrolera dziedziczcedo po abstract_viewController
 *
 * klase nalerzy umiescic w kataogu models o nazwie nazwa moduo+View.php.
 * Je�li chcemy wywietlac  z bazy danych wed�ug
 * jakiego� kryterum, nalerzy odpowiednio zmodyfikowa
 * select, nast�pnie je zwr�ci�.
 * @author Konrad
 * @package View
 */
	   
 class ViewEntite_models_viewModel extends Abstract_models_viewModel {

		
	/**
	 * Chcc wywietlić jakie dane w innym module dostaniemy jaki wiersz. Akcja viewlabel pobiera klucz 
	 * z kolumny, zdefiniowanć jako foreignKey. Według tego klucza pobiera wiersz z bazy danych. Następnie wywietla skojarzony wiersz. 
	 * 
	 * @var string Klucz obcy według kturego wycigniemy dane z naszej tablicy.
	 */
	
	protected  $foreignKey;
	
	
	//protected $_name ;
	
	
	/**
	 * 
	 * @var string nazwa modułu
	 */
	
	protected $_moduleName;

	
	/**
	 * Chc�c wywietlić informacje w innym module modu� musi znać klucz obcy według kturego będziemy się odwoływać:
	 * setForeignKey() klucz obcy z innego modułu.
	 */
	
	public function init(){}
	
	
	public function getOne( $id ) {
		
		
		$myConfig = new Class_Config_myConfig();

		//$col = $myConfig->getRowNamesForOutput($this->_moduleName);
		$col =  $this->getColsRow();

		$id = $this->getAdapter()->quoteInto( 'id = ?', $id );

		$r = new Zend_Db_Table_Row();

		
		if ( count($col) > 0 ) {

				$select = $this->select();

			//$select->from( $this->_moduleName, $col );

			if ( $col )
			
					$select->from( $this->_name, $col );
					
			else 
			
					$select->from( $this->_name );

					
			$select->where( $id );			

			$r = $this->fetchRow( $select );

			
		} else
		
					$r = $this->fetchRow($id);

					
		return $r;
	
	}
	
	
	/**
	 * Urzywana przez viewoneAction().
	 * Dzia�a tak samo jak funkcja getCol.
	 */
	protected function getColsRow() {
		
		return false;
	}
	
	
	/**
	 * @return Zwraca nazwe tabeli.
	 */
	
	public function getName() {

		return $this->_name;
		
	}
	
	
	
}
?>