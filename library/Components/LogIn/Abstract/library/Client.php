<?php

abstract class abstract_Auth_Client_Client implements Logx_interfaces_Iclient {
	
	
	private $role = 'guest'; 
	
	private $authRow;
	
	
	public function __construct ( $authRow ) {
		
		
		$this->authRow = $authRow;

		$privilage = new Class_Privilages_privilages();
		 
		$role = $privilage->getRole( $auth->id );
		
		
		if ( $role === null)
		
				throw new Exception('model nie zwrucił roli w Class_Auth_Client lini 16(konstruktor)');
			
				
		$this->role = $role;
		
	}
	
	
	public function setClientData( $data ){
		
	}
	
	
	public function getClientData(){
		
	}
	
	
	public function getRole () {
		
		
		return $this->role;
		
	}
	
	
	
	public function getId () {

		
		return $this->authRow->id;
		
	}
	
	
	public function getAuthRow () { 
		
		
		return $this->authRow;
		
	}
	
	

}


?>