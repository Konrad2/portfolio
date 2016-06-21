<?php
class auth implements istart
{
	public function start()
	{
		Zend_Loader::loadClass('Zend_Auth');
		$authSession = new Zend_Session_Namespace('Zend_Auth');
  		$authSession->setExpirationSeconds(3600); 
	}
}
?>