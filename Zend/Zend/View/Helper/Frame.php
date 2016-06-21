<?php
/**
 *
 * @author Konrad
 * @version 
 */
require_once 'Zend/View/Interface.php';

/**
 * Frame helper
 *
 * @uses viewHelper Zend_View_Helper
 */
class Zend_View_Helper_Frame {
	
	/**
	 * @var Zend_View_Interface 
	 */
	public $view;
	
	/**
	 * 
	 */
	public function frame() {
		// TODO Auto-generated Zend_View_Helper_Frame::frame() helper 
		return $this;
	}
	
	/**
	 * Sets the view field 
	 * @param $view Zend_View_Interface
	 */
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}
	
	
	public function doFrame( $content, $className = 'tresc' ){
		
		
		/*
		$frame = '<div class="'
		
			.$className.'">'
						
			.$content
					
			.' </div>';

			*/
			
			$frame= '
			
			<div id="'
			
			.$className
			
			.'">
			
			<div class="flt">
	</div>
	<div class="ft">
	</div>
	<div class="frt">
	</div>
     
         <div class="inFrame">'		
         				
		.$content
							
		.' </div>'

		.' <div class="flb">
	</div>
	<div class="fb">
	</div>
	<div class="frb">
	</div>
	
	</div>
	';
			
		return $frame;		
		
	}
}

