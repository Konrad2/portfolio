<?php
/**
 * Servis formDb
 * 
 * @author Konrad
 *
 */
class FormDb_Connect_FormDbUsages   {

	protected $patchToModule;
	
	private $__patchToConnectionFile = '../application/config/connections.xml';
	
	/**
	 * Tworzy konstrukcje z obiekt�w powi�zanych z dan� akcj� przekazan� jako param.
	 * 
	 * @param param type $param
	 * 
	 * @return FormDbClient
	 */
	
	public  function build( $param ) {
		
		
		//dane kt�ry modu�y s� po��czone s� zapisywane w //moduleName/controllerName/ActionName 

		$str = Class_xpatch::arrayToXpatch($param->toArray());
		
		$children = array();

		$children =  Class_Config_myConfig::getConnections( $str, $this->__patchToConnectionFile );
		
		
		//$children = Class_myXml::getSubChildrenFromXpatch($str,$this->patchToConnectionFile);
		
		$elem = self::createElements( $children );			

				
				
		return Class_factory::build( $elem );		
		
	}
	
	
	
	
	/**
	 * @return zwraca tablic instancji klas ze skojarzonych modu�w
	 * 
	 */
	
	private function createElements( $array ) {
		
		
		$result = array();

		foreach ( $array as $moduleName => $className )
		
				$result [] = $this->createElement($moduleName, $className);

				
		return $result;
		
	}

	
	
	/**
	 * 
	 * Tworzy instancje klasy z modulu o nazwie podanej w pierwszym parametrze. Tworzy klas o nazwie podanej w drugim parametrze w katalogu common
	 * np.: $moduleName.'/common/'.$className.'.php'
	 * 
	 *@param  string $moduleName 
	 *
	 *@param string $className 
	 *
	 */
	
	private function createElement( $moduleName, $className ) {
		
		
		require_once $this->patchToModule.'/'.$moduleName.'/common/'.$className.'.php';		
		
		return new $className();
		
	}
	
	
}

?>