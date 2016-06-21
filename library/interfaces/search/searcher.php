<?php
/**
 * 
 * @author Konrad
 * @package Search
 *
 */
interface interfaces_search_searcher {
	
	/**
	 * 
	 * @param string $param 
	 * @assert-in ($param) strlen > 0 
	 */
	public  function addParam($param);
	/**
	 * @return array
	 * @assert-out array
	 */
	public function getParams();
	
	/**
	 * Kasuje parametry.
	 */
	public function clear();
	
	/**
	 * @return Zend_Db_String Zapytanie SQL.
	 */
	public function select();
}
?>