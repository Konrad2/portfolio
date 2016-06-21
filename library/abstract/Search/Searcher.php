<?php

/**
 * 
 * Gwna klasa yapewniajca interfejs do dodawania, usuwania krzteriw wzsyukiwania. 
 *  
 * @author Konrad
 * 
 * @package Search 
 * 
 */

abstract class abstract_Search_Searcher implements interfaces_search_searcher {
	
	
	private $sesName;	
	
	
	public function __construct( $modName ) {
		
		
		$this->sesName = $modName.'Search';
	
	}
	
	
	
	/**
	 * Dodaje parametr wyszukiwania.
	 * 
	 * @param unknown_type $param
	 */
	
	public function addParam( $param ) {
		
		
		$this->add($param);
		
	}
	
	
	
	/**
	 * Zwraca kryteria wyszukiwania jako tablie. Klucze tablicy stanowi nazwe parametru. Wartsc tablicy zawiera parametr wyszukiwania np.: array('category'=>'new').
	 * 
	 *  @return Array
	 */
	
	public function getParams() {
		
		
		$ns = new Zend_Session_Namespace( $this->sesName );
		
		$result = array();
		
		if ( isset ( $ns->params ) )
			
				$result = $ns->params;
				
			 
		return $result;
		
	}
	
	
	
	/**
	 * 
	 * Usuwa wszystkie parametry.
	 * 
	 */
	
	public function clear() {
		
		
		$ns = new Zend_Session_Namespace( $this->sesName );
		
		
		unset ($ns->params);
				
	}
	
	
	
	/**
	 * Zwraca parametry wyszukiwanie jako Zend_Db_Select. Naogu nadpisane w klasie dziedziczacej.
	 * @return Zend_Db_Select
	 */
	
	public function select() {
		
		/*
	SELECT *
	FROM things, category_things
	WHERE things.id = category_things.id_thing
	AND category_things.id_category = 11
	*/
	
		$searcher = new Class_searcher('system');	
		
		$adapter = Zend_Db_Table::getDefaultAdapter();
		
		$select = new Zend_Db_Select($adapter);
		
		$p = $searcher->getParams();
		
		
		if ( count ( $p ) > 0 ) {
			//$select->from('things');
			
			//$select->join('category_things', 'things.id=category_things.id_thing');		
			$select->join('category_things', 'things.id=category_things.id_thing',null);
					
			$select->where( $adapter->quoteInto( 'category_things.id_category = ? ', array_shift( $p ) ) );

			
		} else {
			
			//$select->from('things');
			
		}
		
		
		return $select;
		
	}
		
	
	
	/**
	 * 
	 * Dodaje kryterium wyszukiwania.
	 * 
	 * @param unknown_type $p
	 * 
	 */
	
	protected function add( $p, $key = null ) {
		
		
		$ns = new Zend_Session_Namespace( $this->sesName );
		
		
		if ( ! isset ( $ns->params ) )
		
			$ns->params = array();
			
			
	    $ns->params[ $key ] = $p;
	    	
	}
	
	
	
}

?>