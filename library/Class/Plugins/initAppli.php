<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_Plugins_initAppli extends Zend_Controller_Plugin_Abstract{
	//TODO skasowa� sessje w razie b��du
	
	public function init()
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
					
				echo "b���d przy starcie sesji<br/>";
				echo  $e->getMessage();
			}
		*/
		
		}	

	}
}
?>