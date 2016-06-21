<?php

/** 
 * Wykorzystywana jest jedynie funkcja viewlabel wy�wietlaj�cej adres w innym module.
 * @author Konrad
 * @package Address
 */
class Address_viewController extends abstract_Controllers_viewController {
	
	public function init(){
		
		parent::init();
		/**
		 * nag��wek wy�wietlany w sprzedarzy
		 * @var string;
		 */
		$this->title = 'Adres';		
	}
        
        public function viewlabelAction(){
            
            
        }

}

?>