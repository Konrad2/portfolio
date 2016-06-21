<?php

/** 
 * @author Konrad
 * 
 * 
 */

class abstract_Search_ManyCriterions extends abstract_Search_Searcher  {
	
	/*
	private $sesName;
	
	
	public function __construct( $modName ) {
		
		
		$this->sesName = $modName . 'Search';
		
	}
	*/
	
	
	/*
	public function addParam( $param ) {
		
		
		$this->add($param);
		
	}
	
	
	
	public function getParams() {
		
				
		$ns = new Zend_Session_Namespace( $this->sesName );
		
		$result = array();
		
		
		if ( isset ( $ns->params ) )
		
		
			$result = $ns->params;

			
		return $result;
		
	}

	
	
	public function clear() {

		
		$ns = new Zend_Session_Namespace( $this->sesName );
		
		unset ($ns->params);		
		
	}
	
	
	/*
	public function select(){
	
		$searcher = new Class_searcher('system');
	
		$adapter = Zend_Db_Table::getDefaultAdapter();
		$select = new Zend_Db_Select($adapter);
				
		$p = $searcher->getParams();
		
		if (count ($p) > 0)
		{
			//$select->from('things');			
			//$select->join('category_things', 'things.id=category_things.id_thing');		

			$select->join('category_things', 'things.id=category_things.id_thing',null);		
			$select->where($adapter->quoteInto('category_things.id_category = ? ', array_shift( $p )) );		
		}
		else
		{
			//$select->from('things');
		}
		
		return $select;
	}
	*/
	
	
	
}

?>