<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_Search_searcher implements interfaces_search_searcher {


	
	public function __construct($modName){
		
		$this->sesName = $modName.'Search';
	}
	
	
	
	public function addParam( $param ) {
		
		$ns = new Zend_Session_Namespace( $this->sesName );
		
		if ( !isset ($ns->params))
			$ns->params = array();
			
	    $ns->params[] = $param;
	}
	
	/**
	 * @return Array
	 * @assert-out array
	 */
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
	
	
	/**
	 * @return null.
	 */
	
	public function select() {
		
		
		return null;
		
	}
	
	
}

?>