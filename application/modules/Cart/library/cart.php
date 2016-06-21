<?php
/**
 * 
 * @author Konrad
 * @package Cart
 */
class cart //implements ibasket
{
	private $products;
	
	private $labels;
	
	/*
	*add
	*delete
	*delete one
	*getValueToDisplay
	*/
	
	 public function __construct() {

	 	
		$ns = new Zend_session_Namespace('prvCart');
		
		
		if(!isset($ns->things))
				
			$ns->things = array();
	
			
		$this->products = $ns->things;
		
	}

	
	
	public function _empty() {
		
		
		if ( isset ( $this->products ) ) {
			
			
			if ( is_array ( $this->products ) )	{
				
				
				if ( count ( $this->products) > 0 )	{
					
					return false;
					
					
				} else 
				
					return true;
					
					
			} else
			
				return true;
				
				
		} else 
		
			return true;
			
	}

	
	
	public function add( $id ) {
		
		
		$ns = new Zend_Session_Namespace('prvCart');
			
		$ns->things[] = $id;
				
	}

	
	
	public function delete( $id ) {
		
		
		$ns = new Zend_Session_Namespace('prvCart');
		
		$c = count($ns->things);
		
		
		require_once('FirePHPCore/FirePHP.class.php');
		
		$firephp = FirePHP::getInstance(true);
		
		$firephp->table('namespace',$ns->things );
		
		$firephp->log($c,'c');
		
	
			for( $i = 0; $i < $c; $i++ ) {
				
				
				if($ns->things[$i] == $id) {
					
					
					unset($ns->things[$i]);
					
					$ns->things = array_values($ns->things);
					
					return true;
					
				}
				
				
			}
	/*
		require_once('../application/modules/basket/library/regBsk.php');
		$reg = new regBsk();
		return ($reg->delete('things','id',$id));
		*/
	}

	
	
	public function get_ids() {
		
		
		return $this->products;
	/*
		$a = array(); 
		foreach($this->products as $p)
		{
			$a[] = $p['id'];
		}
		return $a;
		*/
	}
	
	
	
	public function deleteoneAction() {
		//$id = $this->request->getIntParam('id');
		//basket->delete($id);
	}

	
	
	public function isValid() {
		
		
		return false;
		
	}

	
	
	public function getValues() {
		
		
		$ns = new Zend_Session_Namespace('prvCart');
		
		if (is_array($ns->things))
		
		
			return $ns->things;
			
		else
		 
			return array();
			
	}

	
	
	public function clear() {

		
		$this->products = array();
		
		$ns = new Zend_Session_Namespace('prvCart');
		
		$ns->things = array();
		
	}
	
	
	
	public function count() {
		
		
		return count($this->products);
		
	}
/*
	public function connectedTab()
	{
		$ns = new Zend_Session_Namespace('prvBasket');
		
		if(isset($ns->connectedTab))
			if (!empty($ns->connectedTab))
				return $ns->connectedTab;
			else
				return 'things';
		else
			return 'things';
	}
	*/
}
?>