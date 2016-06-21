<?php
/**
 *
 * @author Konrad
 * @version 
 */
require_once 'Zend/View/Interface.php';

/**
 * Helper helper
 *
 * @uses viewHelper Zend_View_Helper
 */
class Class_Menu_Helper{
	
	/**
	 * @var Zend_View_Interface 
	 */
	public $view;
	
	/**
	 * 
	 */
	public function  __construct() {
		// TODO Auto-generated Zend_View_Helper_MyHelper::myHelper() helper 
		return null;
	}
	

	/**
	 * Generuje menu.
	 * 
	 * @param $path - Scierzka do pliku xml.
	 * @param $section Nazwa sekcji z elementami menu. Domylnie menu.
	 */
	
	public function render( $path, $section = 'menu'){				
	
		
		$con =  new Zend_Config_Xml( $path , $section );
			
		$container = new Zend_Navigation($con->toArray());
			
			
		//$navigation = new Zend_View_Helper_Navigation($container);
			
		//$navigation->setAcl(new Class_myAcl());
			
		//$navigation->setRole(Class_Auth::getRole());
			
			
			echo '<ul title="Menu" style="list-style: none; padding: 0pt; margin: 3pt;">';
			
		//		echo  $navigation()->menu()->renderMenu();	
				
			echo '</ul>';	
		
	}

	
}


