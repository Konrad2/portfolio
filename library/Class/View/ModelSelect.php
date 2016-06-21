<?php


/**
 * Do wywoania metody getSelect przekazujemy Zend_Db_Select.
 * 
 * @author Konrad
 *
 */

class Class_View_ModelSelect extends abstract_viewModel {
	
	/**
	 * 
	 * @param Zend_Db_Select $select
	 * @todo przeniesc do abstract.
	 */
	
	public function getSelect( $select = null ) {
		
		if ( $select === null ){
			
			
			$select = $this->select();
			
		}			
		
		
		// Które kolumny.
		$keys = $this->getCol();
		
		
		if ( $keys ) {
			
			//$select->from($this->_name, $keys);
			$select->columns($keys);
			
		}	
		

		$select->where($this->_name.'.exist = 1');	

		echo '<br/>z modelu'.$select;

		
		return $select;
		
	}
	
	
}

?>