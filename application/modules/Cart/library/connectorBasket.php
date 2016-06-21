<?php
class connectorBasket
{
	public function what() {
		
		
		$ns = new Zend_Session_Namespace('prvBasket');
		
		if(isset($ns->connectedTab))
		
			if ( ! empty( $ns->connectedTab ) )
			
			
				return $ns->connectedTab;
				
			else
			
				return 'things';
				
				
		else
		
			return 'things';
			
	}
	
	public function where() {
		
		
		$ns = new Zend_Session_Namespace('prvBasket');
		
		if (isset($ns->finalize))
		
		
			if (!empty($ns->finalize))
			
				return $ns->finalize;

				
		return 'sale';
				
	}
	
}
?>