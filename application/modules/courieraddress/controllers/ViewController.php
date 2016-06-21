<?php

/**
 * ViewController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class Courieraddress_ViewController extends Components_Address_controllers_ViewController {
	
protected $_tableName = 'address';
	protected $_foreignKey = 'id_address';
        
       
	
	
	public function init(){
		parent::init();
		
		$this->setTitle('Adres kuriera');
		$this->_setOverridingModule( new Zend_Navigation_Page_Mvc(array('module'=>'courier','controller'=>'View', 'action'=>'viewone')));
				
		$this->_idOverriding = $this->_getParentId();
                
		 $this->_redirectAfterEdit =  new Zend_Navigation_Page_Mvc(array('module'=>'courier','controller'=>'View', 'action'=>'viewone','params' => array( 'id' => $this->_idOverriding  )) );
		
	}
        
        public function editAction() {
            $this->_redirectAfterEdit =  new Zend_Navigation_Page_Mvc(array('module'=>'courier','controller'=>'View', 'action'=>'viewone','params' => array( 'id' => $this->_idOverriding ,'idCourier'=>$this->_request->getParam('CourierId') )) );
            parent::editAction();
        }
        
        protected function getFormDb(){
            $formDb = parent::getFormDb();
            
            $idCourierElement = new Zend_Form_Element_Hidden('CourierId');
            $idCourierElement->setValue($this->_request->getParam('idCourier'));
            $formDb->addElement($idCourierElement);
            
           return $formDb;
        }
        
        public function viewlabelAction() {
            
            parent::viewlabelAction();
            
            $this->view->idCourier = $this->_getParentId();
        }
}