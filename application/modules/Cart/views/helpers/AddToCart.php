<?php
/**
 *
 * @author Konrad
 * @version 
 */
require_once 'Zend/View/Interface.php';

/**
 * addToCart helper
 *
 * @uses viewHelper Zend_View_Helper
 */
class Zend_View_Helper_AddToCart {
	
	/**
	 * @var Zend_View_Interface 
	 */
	public $view;
	
	/**
	 * 
	 */
	public function addToCart( $id ) {
		
		return '<a href="/Cart/Cart/addproduct/id/'.$id.'">Dodaj</a>';
	}
	
	/**
	 * Sets the view field 
	 * @param $view Zend_View_Interface
	 */
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}
}
