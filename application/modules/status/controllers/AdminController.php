<?php

/**
 * AdminController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class Status_adminController extends abstract_Controllers_baseController  {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated AdminController::indexAction() default action
	}
	
	public function changeAction(){
		
		require_once '../application/modules/status/library/changeStatusForm.php';
		$form = new changeStatusForm();

		if ($form->isValid($_POST)){
			//ToDo --- doda� po��czenie mi�dzy modu�ami mniej statyczne
			require_once '../application/modules/sale/models/order.php';		
			$order = new order();
		
			$row = $order->find($form->getValue('id'));
			
			$row = $row->current();
			
			$row->id_status = $form->getValue('status');
			
			$row->save();
			
			//sale/view/viewone/id/6946
			$this->_forward('viewone', 'View', 'Sale', array('id'=>$row->id));
		}
	}

}

