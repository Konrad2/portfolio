<?php 

class Class_logCheck extends Zend_Controller_Plugin_Abstract {
	
	
	
	public function preDispatch(Zend_Controller_Request_Abstract $r) {		

		throw new Exception('Class_logCheck');
		$acl = new Class_myAcl();

		$resource = $r->getModuleName().':'.$r->getControllerName();		
		
		
		require_once '../application/modules/accounts/library/AuthStorage.php';	 

		
		$client = Zend_Auth::getInstance()->getStorage()->getData();

		
	 	$role = Zend_Auth::getInstance()->getStorage()->read();
		
	  	
		//$role = $storage->read();
		//$role = $storage->read();
		
		//echo $role;
		
		//echo '<br/>------	'.$role.' == '.$resource.' ----'.$r->getActionName().'<br/>';
		
	
		
		if ( ! $acl->isAllowed ( $role, $resource, $r->getActionName() ) ) {
				
			
			$r->setControllerName('log')     
			         
	             ->setActionName('log')
	             
	             ->setModuleName('Log');
	             
		}
		
		
	}
	
	//protected function getRole(){
		
	//}
	
	
 }
?>