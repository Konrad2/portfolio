<?php
/**
 * 
 * @author Konrad
 * @package Courier
 *
 */

class Courier_ViewController extends abstract_Controllers_viewController
{
	
	public function init(){
		
		parent::init();
		/**
		 * nag��wek wy�wietlany w sprzedarzy
		 * @var string;
		 */
		
		$this->foreignKey = 'id_courier';
		$this->title = 'Kurier';
		
	}
	
	
}

