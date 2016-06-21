<?php

/** 
 * @author Konrad
 * Do getSelect przekazujemy tablice.
 * 
 */
class Class_View_ModelSearchTab extends abstract_viewModel  {

	/**
	 * @param Zend_Db_Select $select Zend_Db_Select 
	 */
	public function getSelect($criterions = null){
	
		$select = $this->select();		
		
		if ( is_array($criterions) ){
			
			foreach ( $criterions as $criterion => $value )
			{
				$select->where( $this->getAdapter()->quoteInto( $criterion.'=?',$value ) );
			}
		}
		else {
			throw new Exception("To nie tablica. Class_View_ModelTab");
		}
		
		// Które kolumny.
		$keys = $this->getCol();
		
		if ($keys)
		{
			$select->from($this->_name, $keys);		
		}	
		
		$select->where( $this->_name.'.exist = 1' );
		
		echo $select;
		
		return $select;		
	}
	
	
}

?>