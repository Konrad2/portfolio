<?php
/**
 * Klasa przesiaduje w Zend_Auth_Storage.
 * @author Konrad
 *@package Log
 */
	 
class LogIn_Log_library_Client {
	
	
	private $role;// = 'guest'; 
	
	private $authRow;
	
	
	/**
	 * Zwracea nazwę roli np.:'admin'.
	 */
	public function getRole () {
		
		
		if ( empty ( $this->role ) )
		
			return 'guest';
			
		else
		
			return $this->role;
		
	}
	
	/**
	 * Zwraca id osoby zalogowanej.
	 */
	public function getId () {

		
		return $this->authRow->id;
		
	}
	
	
	/**
	 * Ustawia AuthRow. Warzne !! w tej wersji niezbędne do działania klasy.
	 * @param $authRow
	 */
	public function setAuthObj( $authRow ) {

	
		$this->authRow = $authRow;

		$this->setRole( $authRow->id_privilege );

	}
	
	
	/**
	 * Zwraca Zend_Auth_Row_Object.
	 */
	public function getAuthObj () { 
		
		
		return $this->authRow;
		
	}
	
	
	/**
	 * Ustawia $this->role na przypisan do id nazwę roli.
	 * @param unknown_type $id_privilage
	 */
	
	private function setRole ( $id_privilage ) {
		
		
		$privilage = new Class_Privilages_Privilages();
		//$privilage = new Acl_Privilages_Privilages();
		
		$role = $privilage->getRole( $id_privilage );
	
		
		if ( $role === null)
		
				throw new Exception('model nie zwrucił roli w Class_Auth_Client lini 54(setRole)');
			
			
		$this->role = $role;
		
	}

}


?>