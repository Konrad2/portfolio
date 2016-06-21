<?php
/**
 * Słurzy do przekierowania.  
 * @author Konrad
 * @package Entite
 */
class Class_Redirector {

	private $_controller;
	
	private $__defaultAction = 'viewone';
	
	/**
	 * Gdzie przekierowywać.
	 * @var unknown_type
	 */
	private $_navigation;
	
	
	public function __construct( Zend_Controller_Action $controller ){
		
	
		$this->_controller = $controller;		
		
		$this->_navigation = new Zend_Navigation_Page_Mvc();
				
	}
	
	
	/**
	 * Zwraca adres pod który ma zostać przekierowany urzytkownik po akcji. Uwzględnia równierz parametry.
	 * @return string
	 */
	protected function _getUrlAfter() {
		
		
		$url = $this->_redirectAfterAddAction->getModule()
	          					.'/'
	          					. $this->_navigation->getController() 
	          					. '/'
	          					.  $this->_navigation->getAction(); 
		
		foreach (  $this->_navigation->getParams() as $name => $value ) {
					
				$url .= '/' . $name . '/' . $value;
		}
		
		
		return $url;
			
	}
	
	
	/**
	 * Przekierowuje aplikację. Odpowiednik $Zend_Controller_Action->_Redirect();
	 */
	
	public function redirect() {
		
		
			$this->_controller->_redirect (
						 $this->_navigation->getModule() 
						 .'/'.  
						 $this->_navigation->getController()
						 . '/' .
						 $this->_navigation->getAction() ,

					 array('code' => 303));		
	}
	
	
	/**
	 * 
	 * @param array $param
	 */
	public function setParam( array $param ) {
		
		
			$this->_navigation->setParam( $param );	
	}
	
	
/**
 * Do jakiej akcji przekierować.
 * @param $name
 */
		
	public function setAction( $name ){
		
		$this->_navigation->setAction( $name );
		
	}
	
	
	/**
	 * Do jakiego kontrolera ma przekierować.
	 * @param $name
	 */
	
	public function setController($name){
		
		$this->_navigation->setController ( $name );
	}
	
	
	/**
	 * Do jakiego modułu przekierować.
	 * @param $name
	 */
	
	public function setModule($name){
		
		$this->_navigation->setModule ( $name );
	}
}

?>