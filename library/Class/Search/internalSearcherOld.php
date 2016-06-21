<?php
/**
 * Klasa urzywana wewntzrz moduu. Do obsugi kryteriów wyszukiwania.
 * @author Konrad
 *
 */
class Class_Search_internalSearcher// implements// interfaces_search_searcher {
{
public function __construct($modName){
		
		$this->sesName = $modName.'Search';
	}
	
	public function addParam( $param ){
		
		if (!is_array($param))
		{
			$ns = new Zend_Session_Namespace( $this->sesName );
			
			if ( !isset ($ns->params))
				$ns->params = array();
				
		    $ns->params[] = $param;
		}
		else
		{
			/**
			 * @todo implementacja gdy urzytkownik przekarze tablice. np.: wyszukiwanie zaawansowane.
			 */
		}
	}
	
	/**
	 * @return Array
	 */
	public function getParams(){
		
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
	
	
}

?>