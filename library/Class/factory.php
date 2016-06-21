<?php

/**
 * 
 * @author Konrad
 * @package Factory
 */
class Class_factory
{		
	/**
	 * zwraca obiekt dziedziczcy po abstract FormDb 
	 * @param string scierzka xpatch $param 
	 * @param string $patchToFile
	 */
	/*
	public static function build($param,$patchToFile)
	{
		$patch = Class_xpatch::arrayToXpatch($param);
		$con = Class_mySimpleXml::getFromXpatch($patch,$patchToFile);		
		
		$construction = null;		
		
			if ( is_array($con) )
			{
				foreach ($con as $ch)
				{	
					$construction->add( Class_factory::buildSubModel($ch, $section, $action) );
				}		
			}	
			
		return $construction;				
	}
	*/
	
	
	/**
	 * 
	 * @param array $products tablica.
	 * @return Konstrukcja. Elemêty z tablicy wstawia jako dzieci klasy.
	 */
	public static function build($products)
	{
		$construction = null;
		
		if ( is_array($products) )
		{
			if (count($products) > 0)
			{
				$newProduct =array_shift($products);
				
				//znowu od zera poniewarz zdielimy pierwszy element
				if ( count($products) > 0 )
				{
					foreach ($products as $product)
					{					
						$newProduct->add($product);
						$construction = $newProduct;
					}
				}
				else
				{
					$construction = $newProduct;
				}
			}
		}
		
		return $construction;
	}
	
	
	public static function buildModel( $module,$section, $action)
	{
		$con = Class_myConfig::get($module, $section, $action );
		
		$construction = null;		
		
			if ( is_array($con) )
			{
				foreach ($con as $ch)
				{
					//if(file_exists('../application/'.$ch.'/library/forms/'.$ch.'Factory.php'))
				//	{ 
						//require_once('../application/'.$ch.'/library/forms/'.$ch.'Factory.php');
						if ( is_array($ch) )
							foreach ($ch as $c)
							{
								if ($construction != null)
									$construction->add( Class_factory::buildSubModel($c, $section, $action) );
								else
									$construction = Class_factory::buildSubModel($c, $section, $action);
							}
						else
						{
							if ($construction != null)
							{
								$construction->add( Class_factory::buildSubModel($ch, $section, $action) );
							}
							else 
							{
								$construction = Class_factory::buildSubModel($ch, $section, $action);
							}
						}
				//	}
				//	else 
					//	throw new Exception("brak wymaganego pliku");				
				}
				
				return $construction;
			}
			else 
				throw new expection('niepoczonny ');	
		
	}
	
	public static function buildForm($f,$module,$section, $action)
	{	
		$con = Class_myConfig::get($module, $section, $action );
		
	//	if(file_exists('../application/'.$module.'/library/'.$module.'Factory.php'))
//		{
	//		require_once('../application/'.$module.'/library/'.$module.'Factory.php');
		
			$construction = $f;		
		
			if ( is_array($con) )
			{
				foreach ($con as $ch)
				{
					//if(file_exists('../application/'.$ch.'/library/forms/'.$ch.'Factory.php'))
				//	{ 
						//require_once('../application/'.$ch.'/library/forms/'.$ch.'Factory.php');
						if ( is_array($ch) )
							foreach ($ch as $c)
							{
								echo $c.'<br/>';
								$construction->add( Class_factory::buildSubForm($c, $section, $action) );
							}
						else
							$construction->add( Class_factory::buildSubForm($ch, $section, $action) );
				//	}
				//	else 
					//	throw new Exception("brak wymaganego pliku");				
				}
				
				return $construction;
			}
			else 
				throw new expection('niepoczonny ');	
		
	}

	
	/**
	 * @return zwraca instancje klasy z modu³u
	 * @param string $module
	 * @param string $section
	 * @param string $action
	 */
	public static function buildSubForm ($module, $section, $action)
	{
		$n = class_myConfig::get($module,$section, $action);
		
		$form = null;
		
		foreach ($n as $name)
		if (file_exists('../application/modules/'.$module.'/library/forms/'.$name.'.php'))
		{
			require_once(('../application/modules/'.$module.'/library/forms/'.$name.'.php'));
			$form = new $name();
		}
		else 
			throw new Exception('brak wymaganego pliku'.$module);	
			
		return $form;		
	}
	

	/**
	 * @return 
	 * @param unknown_type $names
	 *	
	public static function getProducts($names)
	{
		$products = null;
		foreach ($names as $modName)
		if (file_exists('../application/modules/'.$modName.'/library/factory'.$modName.'.php'))
		{
			require_once('../application/modules/'.$modName.'/library/factory'.$modName.'.php');	
			
			$name = $modName.'Form';
		
			$f = new $name();
			$product[] = $f->buildForm($section);			
		}
		
		return $products;
	}
	
	
	 * buduje konstrukcje z obiektów typu absstract_clientFactory
	 */
	
	
/*
 * Make class witchin static class
 *	
	public static function getChildren($p)
	{
	
		$con = array();
			
		try
		{
			//if(file_exists('../application/modules/'.$p.'config.xml'))
			//$config = new config('config.xml','conections');		
		
			foreach ($p as $key=>$value)
			{
				if($key == $p)
				{					
					$con[] = $value;
				}
			}
			
		}
		catch(Exception $ex)
		{}
		
		return $con;
	}
	*/
}
?>