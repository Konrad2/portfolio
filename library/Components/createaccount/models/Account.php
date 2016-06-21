<?php

class components_createaccount_models_Account extends Zend_Db_Table {
	
	protected $_name = "account";
	
	public function IfLoginExists( $login ){
		
		$select = $this->select();
		$select->where( $this->getAdapter()->quoteInto("login = ?" ,$login) );
	
		return count ($this->fetchRow( $select ) );
	}
	
	public function addUser( array $data){
		//echo "dodawanie urzytkowników";
		
                $passwordManager = new LogIn_Log_library_PasswordManager();	              
                $newRow = $this->createRow($data);
                $newRow->salt = md5( time());				
		$newRow->password = $passwordManager->salts( $data['password'] , $newRow->salt);
		$newRow->created_at = date('Y-m-d',time());
                $newRow->id_person = $data['id_person'];
                $newRow->id_privilege = 2;
		$newRow->save();
                
                return $newRow;
	}

}

