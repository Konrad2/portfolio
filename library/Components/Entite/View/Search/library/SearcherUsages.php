<?php

/** 
 * Komponent jest stosowany do wyświetlania wyników według kryteriów.
 * @author Konrad 
 * @package Search 
 */

class Components_Entite_View_Search_library_SearcherUsages {//implements interfaces_search_searcher{
	
	
	protected $_sesName;
	
	
	public function __construct( $modName = 'system' ) {
		
		$this->_sesName = $_SERVER['DOCUMENT_ROOT'] . $modName.'Search';
	}
	
	
	/**
	 * Dodaje kryterium.
	 * @param string $key nazwa tabeli której dotyczy kryterium wyszukiwania
	 * @param unknown_type $value wartosć
	 * @param Zend_Navigation_Page_Mvc $navigation Musi zawierać nazwy: modułu, kontrolera oraz akcji których dotyczy kryterium.
	 * @example
	 * $search = new  Components_Entite_View_Search_library_Searcher();	 * 
	 * $search->add('category', 'cars', Zend_Navigation_Page_Mvc( array ( 'module'=>'pojazdy', 'controller'=>'management', 'action'=>'viewall') );
	 */
	public function add( $key, $value , Zend_Navigation_Page_Mvc $navigation ) {
		
			$ns = new Zend_Session_Namespace( $this->_sesName );
			

		    $ns->params[ $navigation->getModule() ] [ $navigation->getController() ] [ $navigation->getAction() ] = array ($key => $value);
		    
	}
	
	
	public function get( Zend_Navigation_Page_Mvc $navigation ) {
		
		
			$ns = new Zend_Session_Namespace( $this->_sesName );
			
			$result = array();
						
			if ( isset ( $ns->params[ $navigation->getModule() ] [ $navigation->getController() ] [ $navigation->getAction() ])){			
				$result =  $ns->params[ $navigation->getModule() ] [ $navigation->getController() ] [ $navigation->getAction() ];		
			}
					
			  return $result;
	
	}
	
	

	public function clear( Zend_Navigation_Page_Mvc $navigation ) {
		
			$ns = new Zend_Session_Namespace( $this->_sesName );		
			
			unset ( $ns->params[ $navigation->getModule() ] [ $navigation->getController() ] [ $navigation->getAction() ] );
					
	}
	
	
	
	public function select () {
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
		
		if (count ($p) > 0)	{
			
			//$select->from('things');
			
			//$select->join('category_things', 'things.id=category_things.id_thing');		
			$select->join('category_things', 'things.id=category_things.id_thing',null);
					
			$select->where($adapter->quoteInto('category_things.id_category = ? ', array_shift( $p )) );
					
		} else {
			
			//$select->from('things');
			
		}
		
		
		return $select;
		
	}
	
	
}

?>