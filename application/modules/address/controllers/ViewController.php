<?php

/**
 * ViewController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class Address_ViewController extends Components_Address_controllers_ViewController {
	
protected $_tableName = 'address';
	protected $_foreignKey = 'id_address';	
	
	
	public function init(){
		parent::init();
		
		$this->setTitle('Adres wysyłki');
		$this->_setOverridingModule( new Zend_Navigation_Page_Mvc(array('module'=>'Sale','controller'=>'View', 'action'=>'viewone')));
		
		
		$this->_idOverriding = $this->_getParentId();
		
		
		$this->_redirectAfterEdit =  new Zend_Navigation_Page_Mvc(array('module'=>'Sale','controller'=>'View', 'action'=>'viewone','params' => array( 'id' => $this->_idOverriding)) );
		
	}
        
//        public function viewlabelAction(){
//            
//         echo $this->_request->getIntParam('id');   
//        }
}