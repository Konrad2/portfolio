<?php
class initAppli extends Zend_Controller_Plugin_Abstract
{
	function initAppli()
	{			
		if (!Zend_Session::sessionExists())		
		{		
			//try{				
				 Zend_Session::start();
				 Zend_Session::setOptions( array('remember_me_seconds'=>10000) ); 
				 
				$registry = new Class_myRegistry();
				$registry->start();
				
				
				
				$auth = new auth();
				$auth->start();
		/*	}
			catch(Exception $e){
				
				if (Zend_Session::sessionExists())			
					Zend_Session::destroy(true);
					
				echo "b³±…d przy starcie sesji<br/>";
				echo  $e->getMessage();
			}
		*/
		
		}	
	}
}

?>
