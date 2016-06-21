<?php

class searcherModel extends ViewEntites_models_viewModel {
	
	/**
	 * Kryteria wyszukiwania w sql. Tablica zawiera warunki np.: "id_entity = 43".  
	 * @var array
	 */
	
	private $__criterions = array();
	
	/**
	 * Dodaje kryteria where.
	 * @param $criterions
	 */
	public function setCriterion( array $criterions ) {
		
		
		foreach ( $criterions as $what => $value)
		
				$this->__criterions [] = $this->getAdapter()->quoteInto( $what . ' ?= ', $value );
						
	}

	
	/**
	 * dodatkowo uwzględnia kryteria wyszukiwania.
	 * @param unknown_type $select
	 */
	public function getSelect( $select = null ) {
		
		
		$select = parent::getSelect( $select);
		
		throw new Exception('konrad searcher model');
		
		foreach ( $this->__criterions as $c ) {
			
				$select->where( $c );
		}
		
		return $select;
		
	}
	
}

?>