<?php
/**
 * 
 * @author Konrad
 * @package Cart
 *
 */

class Cart_CartController extends abstract_Controllers_baseController 
{
	


	/**
	 * Dodaje produkt do koszyka.
	 */
	public function addproductAction()
	{	
		
		
		/* @todo 
			$entite = system::service('things')->getEntite( $id );
			
			
			if ( $entite->isEnable() )
			
					$cart->add($id);
					
			else
			
					$this->addMessage("Przepraszamy produkt nie dostępny");
				*/	
		
		$id = $this->_request->getIntParam('id');		
			
		
		if ( ! empty( $id ) ) {
			
			
			require_once('../application/modules/Cart/library/cart.php');
						
			$cart = new cart();			
		
			//$r = new connector();
			//$name = $r->get($this->_request->getModuleName(),'things');
			//Fabric
			$result = Class_system::getContract( $this->param() );

			/* zmiana 24-04-2012
			$name = $result['things'];
			
			require_once('../application/modules/'.$name.'/models/'.$name.'Cart.php');
			
			$name .= 'Cart';
			
						
		
						
			$tab = new $name();
			
			*/
			
			require_once('../application/modules/Cart/library/cart.php');
			
			$tab = new cart();
			
			
			
			//if ( $tab->isEnable($id) ) {
								
				$cart->add($id);
							 
		//	} else
				//echo "produkt niedostempny przepraszamy :)"; 
			//	throw new Exception("nie dodano produktu");
					
		//}		
		
		
		$this->_redirect('things/management/viewall');
			
	}
	
		throw new Exception("Nie dodano produktu. Niepoprawne id.");
	}

	
	/**
	 * Przekazuje zawarto�� koszyka do modu�u, odpowiadaj�cego za sprzeda�.
	 */
	public function tocashdeskAction() {

		
		//	$ns= new Zend_Session_Namespace('reg');
			//$sale = $ns->contract['cart']['sale'];

			$result = Class_system::getContract( $this->param() );		
			
			//$sale = $result['sale'];

			
/* 27-04-2012
			require_once('../application/modules/cart/library/cart.php');
			
			$c = new cart();

			if(!empty($sale))
			
				$this->_forward( 'order' , 'transaction' , $sale , $c->get_ids() );																  
			
			else;
			
				throw new  Exception("nie znaleziono modu�u kasy");
	*/		
			
				require_once('../application/modules/Cart/library/cart.php');
			
			$c = new cart();

			
		
                        $role = Zend_Auth::getInstance()->getStorage()->read()->getRole();
                        
                        if ( $role != 'guest'){
                            $this->_forward( 'step1logged' , 'Transaction' , 'Sale' , $c->get_ids() );
                        }else{
                        
				$this->_forward( 'order' , 'Transaction' , 'Sale' , $c->get_ids() );																  
                        }
				

			$this->_helper->viewRenderer->setNoRender();
	}
	
	

	/**
	 * Usuwa produkt z koszyka.
	 */
	public function deleteAction() {

		
		$id =$this->_request->getIntParam('id');
		
		if ( ! empty( $id ) )
		
		
			if ( $id > 0 ) {
				
				
				require_once ('../application/modules/cart/library/cart.php');
				
				$b = new cart();				
					
				if ($b->delete($id))
				 
					$this->_forward('viewcart','View');
					
				else {
					
					//OBS�URZY� B��D
					//$this->_redirect('cart/view/viewcart');
					
				}
			
				
			}
					
	}
	
	
	
	/**
	 * Usuwa produkty z koszyka.
	 */
	
	public function clearAction() {
		
		
		require_once ('../application/modules/Cart/library/cart.php');
		
		$cart = new cart();
		
		$cart->clear();
		
		$this->_helper->viewRenderer->setNoRender();
		
		
		$this->_redirect( 'things/management/viewall', array('code' => 303 ) );
		
	}
	
	
}

?>