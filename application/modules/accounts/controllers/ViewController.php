<?php
//require_once ('..\appilication\modules\library\password.php');
//require_once ('ViewController.php');

/**
 * @author Konrad
 * @version 1.0
 * @created 09-lip-2010 14:16:19
 */
class Accounts_viewController extends abstract_Controllers_viewsearchController {
	
	protected $_whatShow_One = array ( 'login' => 'Login', 'email' => 'e-mail');
	
	public function init() {
		
		
		parent::init();
		
		require_once '../application/modules/accounts/library/accountSearcher.php';
		 
		$this->_searcher = new accountSearcher( $this->_request->getModuleName() );
		
	}	
	
	
	
	public function viewinterfaceAction() {		
		
		//$this->_helper->viewRenderer->setNoRender(true);
				
		$role = Zend_Auth::getInstance()->getStorage()->read();		
		
		
		 if ( $role === 'guest') {
		 	
		 	
		 			echo '<a href="'.$this->_request->getBaseUrl() . '/accounts/log/log">Zaloguj</a> ';
		 			echo '<a href="'.$this->_request->getBaseUrl() . '/accounts/addandedit/add">Zarejestruj</a>';			 	
		 	
		 } else {
		 	
		 	
					echo 'jeste¶ zalogowany jako ' . $role . '</br>';       		
        		
	        		echo '<a href="' . $this->_request->getBaseUrl() . '/accounts/log/out">Wyloguj</a>';
	        	        	
        }
        
        			
	}
	
	
	
	protected function isCorect ( $param ) {
		
		
		return ( ( $param === 'employers' ) || ( $param === 'clients') );
		
		
		if ( ( $param === 'employers' ) || ( $param === 'clients') )
		
				return true;
			
		else 
		
				return false;
				
	}
	
	
/*	
	protected function addCriterion( $request ) {	
		
	
		$p = $request->getAlNumParam( 'param' );
		
		
		if ( ! empty ( $p ) ) {			
			
				$this->_searcher->addParam( $p );
				
			
		} else {
			
				throw new Exception( "nieprawidowy parametr view search controller (addcriterion)" );	
				
		}

		
	}
*/
	
}

?>