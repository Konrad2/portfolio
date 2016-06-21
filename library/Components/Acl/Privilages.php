<?php

class Components_Acl_Privilages {
	
	protected $_name = 'acl_privilages';
	
	private $__privilegeName = 'role';
	//protected $_name = 'account';
	//TODO - Insert your code here Todo w tan spos�b.

	/**
	 * 
	 * @param Zend_Db_Table_Row $row Rerkord z tabeli account.
	 * 
	 * @return Nazwe roli. Pole z kolumny 'role', z tabeli privilage.
	 */
	
	public function getRole( $id ) {

		
	// Przeniesione z password.
	
		// Sprawdzamie asercji.
		
		if ($id === null )
		
			throw new Exception( 'Nie przekazano id przywileju do funkcji getRole. Klasa Privilages.' );
			
		
		//$role = 'guest';

		
		$row = $this->find( $id )->current();
		
		$role = $row[ $this->__privilegeName ];
				
		
		return $role;
		
	}
}

