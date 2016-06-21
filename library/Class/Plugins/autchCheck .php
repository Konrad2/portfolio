<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_Plugins_autchCheck  extends Zend_Controller_Plugin_Abstract {
	
	public function preDispatch(Zend_Controller_Request_Abstract $r)	
	{	
		$log = new Zend_Session_Namespace();
		Zend_Loader::loadClass('Zend_Auth');
		Zend_Loader::loadClass('myAcl');
		
		$acl = new myAcl();

		$resource = $r->getControllerName();
		$role= (Zend_Auth::getInstance()->hasIdentity())? 'staff' : 'user';
	
		
			if(!$acl->isAllowed($role, $resource)) 
			{
				$r->setControllerName('log')              
	              ->setActionName('loguj');
			}
	
	}
	

}

?>