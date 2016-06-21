<?php

class ConnectionsController extends Editadddelete_controllers_ManagementController  {
	
	
	
	
	 protected function createFormDb() {
		 	
	 	
	 	$oldForm = parent::createFormDb;
	 	
	 	
	 	$instance = new FormDb_Connect_Parent();
	 	
	 	$instance->addEllements( $oldForm->getElements() );
	 	
	 	
	 	return $instance;
	 }

}

?>