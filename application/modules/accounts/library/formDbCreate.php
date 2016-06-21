<?php
/**
 * @author Konrad
 * @version 1.0
 * @created 09-lip-2010 14:19:53
 */
class formDbCreate extends abstract_formDbParent {
	
	public function init() {
		
		
		$this->modelName = 'accountForm';
		
		$this->patchToModel = '../application/modules/accounts/models/accountForm.php';

		
		$login = new Class_forms_alNum20Req('login');
		
		$login->setLabel('Login');	
		
		require_once '../application/modules/accounts/library/ValidarorLoginExist.php';
		
		$login->addValidator( new ValidarorLoginExist()  );
		
		$this->addElement($login);
		
		
		$password = new Class_forms_Paswd_first('password');
		
		$password->setLabel('Haslo');
		
		
		
		//$password->addValidator( new Class_forms_alNum20Req() );
		$this->addElement($password);

		
		$passwordConfirm = new Class_forms_Paswd_Confirm('passwordConfirm');
		
		$passwordConfirm->setLabel('Potwierdz haslo');
		
	//	$passwordConfirm->addValidator(  );
		$this->addElement($passwordConfirm);
		
	
		
		$role = Zend_Auth::getInstance()->getStorage()->read();
		
		$prv = null;
		
		
		//TODO - zrobic powarzniej
		switch ( $role ) {
			
			
			case 'guest':
				
							$prv = new Zend_Form_Element_Hidden('id_privilege');
							
							$prv->addValidator( new Zend_Validate_Regex('/1/') )
														
								->setValue(1)
								
								->addValidator(new Zend_Validate_StringLength(1, 1), true);
								
							break;

							
			case 'employer':
				
							$prv = new Zend_Form_Element_Select( array(
								
							'label'=>'Rodzaj konta',
							'name' => 'id_privilege',
							
							)  );
							
							$prv->addMultioptions(array( '1'=>'Klient', '2'=>'Pracownik' )) 
							
								 ->addValidator(new Zend_Validate_StringLength(1, 1), true);
							
						break;
						
						
			case 'admin':
				
				$prv = new Zend_Form_Element_Select( array(
							'name' => 'id_privilege',	
							'label'=>'Rodzaj konta'
							
							)  );
							
							$prv->addMultioptions(array( '1'=>'Klient', '2'=>'Pracownik', '3'=>'Admin' )) 
								->addValidator(new Zend_Validate_StringLength(1, 1), true);
							
						break;
		}
		
		
		
		$this->addElement($prv);
		
		$submit = new Zend_Form_Element_Submit('submit');
		
		$submit->setIgnore(true);
		
		$this->addElement($submit);
		
	}
	
}
?>