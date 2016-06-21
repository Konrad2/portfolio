<?php

class Things_ManagementController extends Pictmanage_controllers_PicturemanagerController {
	
	
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())  {
		
		
			parent::__construct( $request,  $response, $invokeArgs);
		
			$this->_setTableName('things');
			
			$this->setWhatShowInAllAction(array ('name') );
		}

}

?>