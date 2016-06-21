<?php

class Components_Acl_AclManagement{

	private $__mPrivilages;
	private $__mResources;
	private $__mRoles;
	
	private $__myAcl;
		
	public function __construct(){
		
		$this->__mPrivilages = new Components_Acl_Model_Privilages();
		$this->__mResources = new  Components_Acl_Model_Resources();
		$this->__mRoles = new Components_Acl_Model_Roles();
		$this->__myAcl = Class_myAcl::getInstance();
	} 
	
	
	public function initializeResource(){
		
		//add roles
		$roles = $this->__mRoles->getRoles();			

		$this->__myAcl->removeRoleAll();
                
		foreach ($roles as $role){			
			if ($role['ancestor'])
				$this->__myAcl->addRole( new Zend_Acl_Role($role['role']), $role['ancestor'] );
			else 
				$this->__myAcl->addRole( new Zend_Acl_Role($role['role']));

	}
       
		//add resource		
		$resources = $this->__mResources->fetchAll();
		$this->__myAcl->removeAll();
				
		foreach ($resources  as $row) {	
                   
					$this->__myAcl->add( new Zend_Acl_Resource( $row['resource'] ) );								
		}		
				
		//add rule
		$roules = $this->__mPrivilages->getAllowRoules();
		
		foreach ($roules  as $roule){	
                  //  echo $roule['role'].' '. $roule['resource'].' '. $roule['privilage'].'<br/>';
			$this->__myAcl->allow( $roule['role'], $roule['resource'], $roule['privilage'] );
		}
		
	
	Class_myAcl::setInstance($this->__myAcl);
	}
	
	
}

?>