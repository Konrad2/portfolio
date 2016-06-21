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

abstract class abstract_viewModel extends Zend_Db_Table {

	
	
	/**
	 * Chc�c wy�wietli� jakie� dane w innym module dostaniemy jaki� wiersz. Akcja viewlabel pobiera klucz 
	 * z kolumny, zdefiniowan� jako foreignKey. Wed�uk tego klucza pobiera wiersz z bazy danych. Nast�pnie wy�wietla skojarzony wiersz. 
	 * 
	 * @var string Klucz obcy wed�ug kturego wyci�gniemy dane z naszej tablicy.
	 */
	
	protected  $foreignKey;
	
	
	protected $_name ;
	
	
	/**
	 * 
	 * @var string nazwa modu�u
	 */
	
	protected $_moduleName;

	
	/**
	 * Chc�c wy�wietli� informacje w innym module modu� musi zna� klucz obcy wed�ug kturego b�dziemy si� odwo�ywa�:
	 * setForeignKey() klucz obcy z innego modu�u.
	 */
	
	public function init(){}
	
	
	/**
	 * 
	 * Zwraca obiekt typu Zend_Db_Select do paginatora.
	 * 
	 * @return Zend_Db_Select
	 *  
	 * @param array $select Zend_Db_Table_Select
	 * 
	 */
	
	public function getSelect( $select = null ) {
		
	
		if ($select === null) {
			
			$select = $this->select();
			
		}	
					
		
		// Kt�re kolumny.
		$keys = $this->getCol();
		
		
		if ( $keys ) {
			
			$select->from($this->_name, $keys);
					
		}
		
		
		$select->where( $this->_name . '.exist = 1' );
		
		
		return $select;		
		
	}

		
	/**
	 * @todo ciekawe czy pojeszcze potrzebne.
	 * @param unknown_type $key
	 */
	
	public function setForeignKey( $key ) {

		$this->foreignKey = $key;
	}
	
	
	
	/**
	 * Zwraca wiersz o podanym id.
	 * Robi to samo co find fetch row.
	 * @param int $id id kture ma zosta� wy�wietlone. 
	 */
	
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
	* S�urzy do wywietlania jaki informacji w innym module. Powi�zane z akcj� showlabel w kontrolerze "View".
	* Aby pobra� dane z tabeli niezb�dne jest zdefiniowanie klucza obcego. Nalerzy w takim wypadku wpisa� atrybut foreignKey za pomoc� metody setForeignKey($ kewy );.
	* @return array Zend_Db_Table_Row 
	* @param Zend_Db_Table_Row $row wiersz tabeli kturego klucz znajduje si� w tabeli tego modelu.
	* @param array nazwy tabel oraz jak maj� si� wy�wietla�.
	*/
	//public function getCustom($row , $rowsName = null)
	
	public function getCustom( $row ) {

		
		$t = $row->toArray();
		
		
		if ( ! isset ( $this->foreignKey ) )
		
			throw new Exception("Nie zdefiniowany klucz obcy");
		
			
		$id = $t[$this->foreignKey];

	
		$id = $this->getAdapter()->quoteInto('id = ?', $id );

		$r = new Zend_Db_Table_Row();

		$rowsName = $this->customCol();
		
		
		//if( $rowsName != null )	{
			
			
				$select = $this->select();

				$select->from( $this->_moduleName, $rowsName );

				$select->where( $id );

				$r = $this->fetchRow($select);	
			
	//	}
	//	else
		
		//	$r = $this->fetchRow($id);

		return $r;
	}

	
	
	/**
	 * Urzywana przez getSelect().
	 * Funkca domy�lnie zwraca false. Chc�c zdefiniowa� nazwy pod jakimi maj� sie wy�wietla� dane z tabeli, nalerzy zwr�ci� tablic� z kluczami jako nazwy tabeli oraz warto�ciami jako nazwy wy�wietlane.
	 * Tablica Mo�e wy� podstawiana do funkcji $select->from
	 * @return Nazwy kolumn tabeli zwracanej do metody viewController->viewallAction(). 
	 */
	
	protected function getCol() {
		
		return false;
	}
	
	
	
	/**
	 * Urzywana przez viewoneAction().
	 * Dzia�a tak samo jak funkcja getCol.
	 */
	protected function getColsRow() {
		
		return false;
	}
	
	
	
	/**
	 * Definicja kolumn jakie maj� si� pojawi� poprzez funkcje viewlabel
	 * @return array tablica nazw kolumn oraz nazwy pod jakimi maj� si� wy�wietla�. domy�lnie false czyli pobrane zostanie wszystko. 
	 */
	
	protected function customCol() {
		
		return null;
	}
	
	
	
	/**
	 * @return Zwraca nazwe tabeli.
	 */
	
	public function getName() {

		return $this->_name;
		
	}
	
	
	
}
?>