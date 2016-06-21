<?php
/**
 * Acl
 * @author Konrad
 *	
 */
class Class_myAcl extends Zend_Acl {
	
	
	public function __construct()  {
		
		
	//	$this->addRole( new Zend_Acl_Role( 'guest' ) );
		
			
		//$this->addRole( new Zend_Acl_Role( 'admin' ), 'guest' );
		

		// footer
		
		
		//Log	
		
		
		//router
	
	/*	
				
		$this->add(new Zend_Acl_Resource( 'admin:index' ) );
		//$this->add(new Zend_Acl_Resource( 'Cms:management' ) );
		$this->add(new Zend_Acl_Resource( 'admin:instal' ) );
		$this->add(new Zend_Acl_Resource( 'default:log' ) );		
		
		$this->allow ('guest' , 'admin:index', array( 'index' ) );
		$this->allow ('guest' , 'default:log', array( 'log' ) );
	
		$this->add(new Zend_Acl_Resource( 'default:produkty' ) );
		$this->allow ('guest' , 'default:produkty', array('index') );
		*/
	}
	
	
	public static function getInstance() {
		
		
			$ns = new Zend_Session_Namespace('myAcl');
			
			
			$myAcl = null;
			
			
			if ( isset ($ns->myAcl) ) {
				
					$myAcl = $ns->myAcl;
					
			} else {
					
				 $myAcl = new Class_myAcl();
				 
			}
		
			return $myAcl;
	}
	
	
	public static function setInstance( Class_myAcl $myAcl ) {
		
		
			$ns = new Zend_Session_Namespace('myAcl');
		
			$ns->myAcl = $myAcl;
		
	}
	
}
?>