<?php
 /** 
 * @author Konrad
 * @package Cart
 */
	class Cart_ViewController extends abstract_Controllers_baseController  //implements iview 
	{
		//protected $name;
		protected $things;
		
		protected $sale;
		
		protected $cart;
		
		
	public function init() {

		parent::init();
		
		require_once('../application/modules/Cart/library/cart.php');
					
		$this->cart = new cart();	
		
		
		
		require_once '../application/modules/Cart/models/thingsCart.php';
				 
	
				
		$this->things = new thingsCart();
		
		/*
		$ns = new Zend_Session_Namespace('reg');
		$name = $ns->contract['cart']['things'];
		*/
		
		
		
		
		/*	24-04-2012
		 
		$result = Class_system::getContract( $this->param() );
			
		
			
		$name = $result['things'];	
		
	
		if ( ! empty( $name ) ) {
			
			
			//$this->name = $name;
			if (file_exists('../application/modules/'. $name .'/models/'. $name .'Cart.php')) {
				
				
				require_once '../application/modules/'. $name .'/models/'. $name .'Cart.php';
				 
				$m = $name .'Cart';
				
				$this->things = new $m();
				
				
			} else {
			 
				throw new ErrorException('brak pliku modułu');
			
			}
			
			
		} else {
			
			throw new ErrorException('brak poczenia koszyka z modułem sale');
			
		}
*/
		
	}
	

	public function userinterfaceAction() {
		
		
		if (!$this->cart->_empty())	{
			
			
			$ids = $this->cart->get_ids();
		
			$this->view->things =	$this->things->getLabel($ids);
			
			
			$this->view->sum = 0;
								
			$this->view->finalize = $this->view->url( array('module'=>$this->_request->getModuleName(),'controller'=>'transaction','action'=>'order') );
			
			
		} else {			
			
			$this->view->empty = true;
			
		}
		

		$this->view->finalize = true;		
		
	}

	
	
	
	public function viewcartAction() {

		
		$this->view->things = $this->things->getCartView($this->cart->get_ids());
			
		$result = Class_system::getContract( $this->param() );
						
		$this->view->con = isset($result['things']) ? $result['things'] : null;
		
		
		}

		
	}
?>