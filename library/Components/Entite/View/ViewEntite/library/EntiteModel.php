<?php
/**
 * @package View
 * @abstract
 */

abstract class Components_viewEntite_models_EntiteModel extends abstract_viewModel {

	
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

		
}
?>