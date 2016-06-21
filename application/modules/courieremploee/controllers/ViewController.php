<?php

/**
 * ViewController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class courieremploee_ViewController extends Editadddelete_controllers_ManagementController {

	protected $_tableName = 'person';
	protected $_foreignKey = 'id_person';
	
        public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array()){
            parent::__construct($request,$response,$invokeArgs);
            $this->_redirectAfterEdit =  new Zend_Navigation_Page_Mvc(array('module'=>'courier','controller'=>'View', 'action'=>'viewone','params' => array( 'id' => $this->_idOverriding)) );
         }
	
	public function init(){
		parent::init();
		
		$this->_setOverridingModule( new Zend_Navigation_Page_Mvc(array('module'=>'courier','controller'=>'View', 'action'=>'viewone')));
		$this->_idOverriding = $this->_getParentId();
		
		
		$this->setTitle('Dane kontaktowe');
	}
	
	
	 protected function createFormDb(){
	 	
	 	//require_once '../application/modules/person/common/personFormDb.php';
	 	require_once '../application/modules/person/library/forms/person.php';
	 	
	 	return new person();
	 }
	
}