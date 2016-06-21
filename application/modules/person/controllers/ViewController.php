<?php

/**
 * ViewController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class Person_ViewController extends Editadddelete_controllers_ManagementController {

	protected $_tableName = 'person';
	protected $_foreignKey = 'id_person';
	
	
	public function init(){
		parent::init();
		
		$this->_setOverridingModule( new Zend_Navigation_Page_Mvc(array('module'=>'Sale','controller'=>'View', 'action'=>'viewone')));
		$this->_idOverriding = $this->_getParentId();
		$this->_redirectAfterEdit =  new Zend_Navigation_Page_Mvc(array('module'=>'Sale','controller'=>'View', 'action'=>'viewone','params' => array( 'id' => $this->_idOverriding)) );
		
		$this->setTitle('Dane kontaktowe');
	}
	
	
	 protected function createFormDb(){
	 	
	 	//require_once '../application/modules/person/common/personFormDb.php';
	 	require_once '../application/modules/person/library/forms/person.php';
	 	
	 	return new person();
	 }
	
}