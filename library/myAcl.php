<?php
//Zend_Loader::loadClass('Zend_Acl');
class myAcl extends Zend_Acl {
	//function myAcl()
	function init(){
		
		Zend_Loader::loadClass('Zend_Acl_Role');
		$this->addRole(new Zend_Acl_Role('guest'));
		$this->addRole(new Zend_Acl_Role('employer'));
		$this->addRole(new Zend_Acl_Role('admin'));
		
		$this->addRole(new Zend_Acl_Role('user'),'guest');
		//$this->addRole(new Zend_Acl_Role('staff'),array('guest','employer','admin'));
		$this->addRole(new Zend_Acl_Role('staff'),'user');

		//$this->addResource(new Zend_Acl_Resource('view'));
		Zend_Loader::loadClass('Zend_Acl_Resource');
		
		$this->add(new Zend_Acl_Resource('index'));
		$this->add(new Zend_Acl_Resource('view'));
		$this->add(new Zend_Acl_Resource('pagin'));
		$this->add(new Zend_Acl_Resource('search'));
		$this->add(new Zend_Acl_Resource('Error'));
		$this->add(new Zend_Acl_Resource('log'));
		$this->add(new Zend_Acl_Resource('admin'));
		
		
		
		
//		$this->allow( 'user', null, 'index');
		$this->allow( 'user','index');
		$this->allow( 'user','search');
		$this->allow( 'user','pagin');
		$this->allow( 'user','Error');
		
		$this->allow( 'staff','admin');		
		$this->allow( 'staff','log');	
		//$this->allow( 'staff', null, 'admin');		
	
	}

	
	

}


?>