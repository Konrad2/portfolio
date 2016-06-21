<?php
/**
 * Klasa abstrakcyjna niezbedna do kontrolera dziedziczcedo po abstract_viewController
 *
 * klase nalerzy umiescic w kataogu models o nazwie nazwa moduo+View.php.
 * Jeli chcemy wywietlac  z bazy danych wedlug
 * jakiego� kryterum, nalerzy odpowiednio zmodyfikowa
 * select, następnie je zwr�ci�.
 * @author Konrad
 
 * @package Related
 */

class Components_Entite_View_ViewRelated_models_RelatedModel extends Components_Entite_View_Search_models_View{

	
	
	/**
	 * Chc�c wy�wietli� jakie� dane w innym module dostaniemy jaki� wiersz. Akcja viewlabel pobiera klucz 
	 * z kolumny, zdefiniowan� jako foreignKey. Wed�uk tego klucza pobiera wiersz z bazy danych. Nast�pnie wy�wietla skojarzony wiersz. 
	 * 
	 * @var string Klucz obcy wed�ug kturego wyci�gniemy dane z naszej tablicy.
	 */
	
	protected  $foreignKey;
	
	/*
	 * Jakie kolumny ma wyświetlać
	 * @var array
	 
	private $__whatShowInCu;
	*/
	
	

	
	/**
	 * Chc�c wy�wietli� informacje w innym module modu� musi zna� klucz obcy wed�ug kturego b�dziemy si� odwo�ywa�:
	 * setForeignKey() klucz obcy z innego modu�u.
	 */
	
	public function init(){}
	
	
	/**
	 * @todo ciekawe czy pojeszcze potrzebne.
	 * @param unknown_type $key
	 */
	
	public function setForeignKey( $key ) {

		$this->foreignKey = $key;
	}
	
	
	
	/**
	* Słurzy do wywietlania jaki informacji w innym module. Powiązane z akcją showlabel w kontrolerze "View".
	* Aby pobrać dane z tabeli niezbędne jest zdefiniowanie klucza obcego. Nalerzy w takim wypadku wpisać atrybut foreignKey za pomocą metody setForeignKey($ kewy );.
	* @return array Zend_Db_Table_Row 
	* @param Zend_Db_Table_Row $row wiersz tabeli kturego klucz znajduje sie w tabeli tego modelu.
	* @param array nazwy tabel oraz jak mają się wyświetlać.
	*/
	//public function getCustom($row , $rowsName = null)
	
	public function getCustom( Zend_Db_Table_Row $row ) {

		
		$t = $row->toArray();
		
		
		if ( ! isset ( $this->foreignKey ) )
		
			throw new Exception("Nie zdefiniowany klucz obcy");
		

			
		$id = $t [ $this->foreignKey ];
		
	// ponieważ nie działa w nadrzędnym module w przypadku gdy przekierowanie było z podrzędnego modułu. 
		if ( ! $id ){
			throw new Exception('nie można odnaleść klucza obcego w RelatedModel. linia 82. '.$this->foreignKey);
		}
		
	
		$id = $this->getAdapter()->quoteInto('id = ?', $id );

		$r = new Zend_Db_Table_Row();

	
		
		
		//if( $rowsName != null )	{
			
			
				$select = $this->select();

			
//				/$select->from( $this->_name, $this->__customRowsName );
				$select->from( $this->_name);

				$select->where( $id );

				$rowset = $this->fetchAll($select);	
				
			if ( count($rowset) == 0 ){
				
				throw new Exception('Nie można odnaleść rekordu w Related model. Linia 104.'.$select  );
			}
				//	}
	//	else
		
		//	$r = $this->fetchRow($id);

		return $rowset->current();
	}

	
}

