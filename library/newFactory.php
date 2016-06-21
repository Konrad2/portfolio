<?php
class newFactory
{
											//formorder
	public function buildForm($thisMod,$action)
	{																	// formOrder
		if (file_exists('../application/modules/'.$thisMod.'/library/form/'.$action.'Form.php'))
		{
			require_once('../application/modules/'.$thisMod.'/library/form/'.$action.'Form.php');	
			
			$name = $action.'Form';
			
			$product = new $name();
			
			$conector = new conector();
			///// to re
			$range = $conector->get('sale',$action);
			
				foreach($range as $con)
				{
					$name = $thisMod.'_'.$con.'_'.$action.'_Form';

					if (file_exists('../application/modules/'.$thisMod.'/library/form/'.$thisMod.'_'.$con.'_'.$action.'_'.$type.'.php'))
					{
						require_once('../application/modules/'.$thisMod.'/library/form/'.$thisMod.'_'.$con.'_'.$action.'_'.$type.'.php');
						
						//				
						$productConcrete = new $name();
						$productConcrete->add($form);	
				
						$product = $productConcrete;					
					}
				}
			
			return $product;
		}
		else
		{
			echo 'nie można odnaleść formy'.$action.'Form';
			return null;
		}
	}
	
	
	/*
	public function buildAddForm()
	{
		$r = new Zend_Session_Namespace('connected');		
	
		require_once('../application/modules/things/library/forms/formThing.php');
		
		$form = new formThing();
		
		if ( isset($r->add) )
		{
			foreach($r->add as $con)
			{	
				if (file_exists('../application/modules/'.$con.'/library/forms/addThing'.$con.'.php'))
				{
					require_once('../application/modules/'.$con.'/library/forms/addThing'.$con.'.php');
					$con = 'addThing'.$con;
					$formConcrete = new $con();
					$formConcrete->add($form);			
			
					$form = $formConcrete;
				}
			}
		}		
		return $form;
	}	
	*/
/*
	public function add($x)
	{
		if(!empty($this->child))
			$this->child->add($x);
		else
			$this->child = $x;
	}

	public function get()
	{
		//if($this->child!= null)
		//	$this->child->get();
		//this->get +that->get
	}	
*/
}
?>