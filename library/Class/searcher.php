<?php

/** 
 * @author Konrad
 * @package Search
 * 
 */
class Components_Searcher_library_Searcher implements interfaces_search_searcher{
	
	
	private $sesName;
	
	
	public function __construct( $modName ) {
		
		$this->sesName = $modName.'Search';
	}
	
	
	public function addParam( $param ) {
		
		$ns = new Zend_Session_Namespace( $this->sesName );
		
		if ( !isset ($ns->params))
			$ns->params = array();
			
	    $ns->params[] = $param;		
	}
	
	
	public function getParams() {
		
		
		$ns = new Zend_Session_Namespace( $this->sesName );
		
		$result = array();
		
		if (isset ($ns->params) )
			$result = $ns->params;
			 
		return $result;
	}

	public function clear(){
		
		$ns = new Zend_Session_Namespace( $this->sesName );
		
		unset ($ns->params);		
	}
	
	public function select(){
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