<?php

class Components_Entite_library_Entite {

	private $row; 
	
	
	public function __construct( int $id = null ){
		
		  
		if ($id != null) {
			
			$col =  $this->getColsRow();

		$id = $this->getAdapter()->quoteInto( 'id = ?', $id );

		$r = new Zend_Db_Table_Row();

		
		if ( count($col) > 0 ) {

				$select = $this->select();

			//$select->from( $this->_moduleName, $col );

			if ( $col )
			
					$select->from( $this->_name, $col );
					
			else 
			
					$select->from( $this->_name );

					
			$select->where( $id );			

			$r = $this->fetchRow( $select );

			
		} else
		
					$r = $this->fetchRow($id);

					
		return $r;
		}
	}
	
	
}

?>