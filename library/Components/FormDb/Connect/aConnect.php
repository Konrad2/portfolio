<?php

/** 
 * @author Konrad
 * 
 * @package formDb
 */

abstract class FormDb_Connect_aConnect extends FormDb_Editable {
	

	
	protected $child;
	
	
/**
	 * Podiera wiersz z bazy o danym id, nastempnie
	 * Wypełnia formularz danymi z rekordu.
	 * @param Zend_Db_Table_Row $parentRow
	 */
	
	//public function fill( Zend_Db_Table_Row $parentRow) {
	public function fill( $parentRow) {
		 
	
		parent::fill( $parentRow );	
		
		
		if ($this->child != null)
		
				$this->child->fill( $parentRow );
				
	}
	
	
	public function formToDb($row = null, $data = null, $values = null) {
		
		
		parent::formToDb( $row, $data, $values);
		
		
		if ($this->child != null)
		
				$this->child->formToDb( $row, $data, $values );
		
	}
	
/**
	 * Dodaje obiekt do struktury
	 * @param interface_factoryClient
	 */
	public function add( $child ){
		
		if ( $child != null)
		{
			if ($this->child != null){
				$this->child->add($child);
			}
			else 
				$this->child = $child;
		}
	}
	
	
	/**
	 * @return Zend_Form
	 * 
	 * Wywouje rekurencyjnie get u dziecka nastpnie pobiera elementy i tworzy jeden wspólny formularz.
	 */
	
	public function get() {

		
		if( isset ( $this->child ) ) {
			
			
				$form = $this->child->get();
			
				$fo = $this->getElements();
			
				
				foreach ( $fo as $elem )
				
						$form->addElement( $elem );			
				

				return $form;
			
		} else

				return $this;
	}
	
	
	
	public function delete( $id ) {
		
		

		
		parent::delete($id);
		
		
		if ( $this->child != null )
		
			 	$this->child->delete( $id );
	}
	
	
	public function doUpdate( $row = null, $data = null, $values = null, $foreignKey = null ) {		

		
			try {
				
				parent::doUpdate( $row, $data, $values, $foreignKey );	
			}
			catch ( Models_Exceptions_noRowFoundException $ex ) {
				
					$this->doInsert( $row, $data, $values, $foreignKey );
			}
	
			return $row;		
	}
	
}

?>