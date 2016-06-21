<?php

/** 
 * @author Konrad
 * @package Pay 
 */
class Pay_ViewController extends abstract_Controllers_viewController {
	
	public function init() {
		
		parent::init ();
		/**
		 * nag��wek wy�wietlany w sprzedarzy
		 * @var string;
		 */
		$this->title = 'Sposób płatności';
	}
	
	

}

