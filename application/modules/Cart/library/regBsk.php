<?php 
class regBsk
{
	/*
	public function conModThings()
	{
		$ns = new Zend_Session_Namespace('prvCart');
		
		if(isset($ns->things))
			if (!empty($ns->conThings))
				return $ns->conThings;
	
		return 'things';
	}
	*/
	public function delete($where, $key , $key2)
	{
		$ns = new Zend_Session_Namespace('prvCart');
		
		if(isset($ns->$where))
		{
			if (is_array($ns->$where))
			{		
				if ( isset($key))
				{			
					if ( isset($key2))
					{		
						$c = count($ns->$where);		
						
						$i = 0; 	
						
						$array = array();
						$z = true;
						foreach($ns->things as $r)		
						{	
							//echo 'r->id='.$r->$key.' a $id='. $key2.'<br/>';					
							
							if (($r->id == $key2)&&($z))
							{
								$z = false;
								
								/*echo "<br/>jestem<br/>";
								if($c==1)
								{
									$ns->$where= array();						
								}
								else
								{
									
									echo $where.'['.$i.']='.count($ns->things).'<br/>';
									unset($ns->things[$i]);
									echo $where.'['.$i.']='.count($ns->things).'<br/>';
									return true;
								}																
								*/
							}
							else
							{
								$array[] = $ns->things[$i];								
							}
							$i++;				
						}
						$ns->things = $array;
						return true;
					}		
					else
					{
						unset($ns->$where[$key]);
						return true;
					}
				}
				
			}
			else
			{
				unset ($ns->$where);
				return true;
			}
		}
		return false;
	}
	
	public function checkout()
	{
		$ns = new Zend_Session_Namespace('prvCart');
		
		if(isset($ns->checkout))
			if (!empty($ns->checkout))
				return $ns->checkout;
	
		return 'sale';
	}
	
	public function get_prod_id()
	{
		$ns = new Zend_session_Namespace('prvCart');
		
		if(!isset($ns->things))
			return array();
	
		$products = $ns->things;
		
		$a = array(); 
		foreach($products as $p)
		{
			$a[] = $p['id'];
		}
		return $a;
	}
}