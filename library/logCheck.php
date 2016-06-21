<?php 

class logCheck extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $r)	
	{	$log = new Zend_Session_Namespace();
		Zend_Loader::loadClass('Zend_Auth');
		Zend_Loader::loadClass('myAcl');
		
		$acl = new myAcl();
throw new Exception('logCheck');
		$resource = $r->getControllerName();
	/*	
		if ( $resource == "Error")
		{
			$r->setControllerName('Error')              
	              ->setActionName('badurl');
		}
		else
		{
		*/
			$role= (Zend_Auth::getInstance()->hasIdentity())? 'staff' : 'user';
	
		
			if(!$acl->isAllowed($role, $resource)) 
			{
				$r->setControllerName('log')              
	              ->setActionName('loguj');
			}
		//}
	
		//if ( $acl->isAllowed('staff', 'newsletter', 'publish'))
	/*	if ( $acl->isAllowed($group, $role, $resours))
		{
			// go on
		}		
		else
		{			
			//zaloguj			
		}
		*/
		/*
		$authNamespace = new Zend_Session_Namespace('Zend_Auth');

$authNamespace->user = $username;

$authNamespace->setExpirationSeconds(1200);[/PHP]$auth = Zend_Auth::getInstance();

		if ( $auth->hasIdentity())		
		echo "tożsamość istnieje";
		else echo "nie zalogowany";
		//nonce_timeout	
		    $authSession = new Zend_Session_Namespace('Zend_Auth');
  			$authSession->setExpirationSeconds(3600); 
	*/
		
	/*		
		
		if ($r->getControllerName() != 'index' )
		{
				$log = new Zend_Session_Namespace();	
				$log->setExpirationSeconds(9600);
				
	
				if ( $r->getActionName() != 'loguj')
				{					
					if ( isset($log->z) )
					{
						if ( $log->z == TRUE);
						else
						{
							$r->setActionName('loguj');
						}
					}
					else
					{
						$r->setActionName('loguj');
					}				
				}			
		}
		else
		{
			$log->z = false;
		}
*/
	}

 }


?>