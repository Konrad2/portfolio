<?php
/**
 *
 * @author Konrad
 * @version 
 */
require_once 'Zend/View/Interface.php';

/**
 * CourierMenu helper
 *
 * @uses viewHelper Zend_View_Helper
 */
class Zend_View_Helper_CourierMenu extends Zend_View_Helper_Navigation {
	
	/**
	 * @var Zend_View_Interface 
	 */
	public $view;
	
	/**
	 * 
	 */
	public function courierMenu() {
		// TODO Auto-generated Zend_View_Helper_CourierMenu::courierMenu() helper 
		return $this;
	}
	
	/**
	 * Sets the view field 
	 * @param $view Zend_View_Interface
	 */
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}
}

