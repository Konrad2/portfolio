<?php 
/**
 * autorization
 * @author Konrad
 * @package Log
 */
class Log_library_Autorization extends Zend_Controller_Plugin_Abstract {
	
	
	
	public function preDispatch(Zend_Controller_Request_Abstract $r) {		

	
		$acl = Class_myAcl::getInstance();

		$resource = $r->getModuleName().':'.$r->getControllerName();
		
		
		$AuthStorage = Zend_Auth::getInstance()->getStorage();
		
		$role = $AuthStorage->getRole();	 	
	
	 	$client = Zend_Auth::getInstance()->getStorage()->read();
	 	
		//echo 'resource: '. $resource .' przywilej: '.$r->getActionName();
                // echo $role;   
			
		try {
		
				if ( ! $acl->isAllowed ( $role, $resource, $r->getActionName() ) ) {
					
						$r->setControllerName('log')     
						     
				             ->setActionName('log')
				             
				             ->setModuleName('Log');			             	
				}
			
				 				
		}
		catch(Zend_Acl_Exception $ex){
			
			Zend_Registry::set ('errorMessage', '404-Strona nie istnieje. Najprawdopodobniej nie można odnaleć zasobu ' .$role.' == '.$resource.' ----'.$r->getActionName() );
			
					$r->setControllerName('Error')     
						     
				             ->setActionName('diferent')
				             
				             ->setModuleName('error');
				             
		}
		
		
	}
	
	
 }
