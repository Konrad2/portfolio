<?php
/**
 * Klasa reprezentuje system.
 * @author Konrad
 * @package System
 */
class Class_system extends abstract_system implements interfaces_search_searchSystem {
	
	
	private $patchToConnectionFile;
	
	private $patchToConfigFile;
	
	protected $patchToContract;
	
	private $patchToModule;
	
	private $moduleSection;
	
	/**
	 * klasy systemClient nazywaj sie tak samo jak nazwa modulu. jeli do nazwy dodawany jest przyrostek wtedy podstawiamy go pod ta zmienna
	 * obecnie klasy systemClient nie zawieraja przyrostkow
	 * @var string
	 */
	
	private $NameClassSystemClient;
	
	
	public function __construct() {

		
		$this->patchToConnectionFile = '../application/config/connections.xml';
		
		$this->patchToConfigFile = '../application/config/config.xml';
		
		$this->NameClassSystemClient = '';
		
		$this->patchToModule = '../application/modules';
		
		$this->moduleSection = 'modules';
		 
		$this->patchToContract = '../application/config/contract.xml';
		
	}
	
	
	
	public static function addCriterion($param){
		
		
		$search = new Class_searcher('system');
		
		$search->addParam($param);
		
	}
	
	
	
	public static function getCriterion() {
		
		
		$search = new Class_searcher('system');
		
		return $search->getParams();
		
	}
	
	
	
	public static function clearCriterion() {
		
		
		$search = new  Class_Search_searcher('system');
		
		$search->clear();
		
	}	
	
	
	
	/**
	 * Zwraca �cie�k� do modu��w 
	 * 
	 * @static
	 */
	
	public static function patchToModule() {
		
		
		return '../application/modules';
		
	}
	
	
	public static function patchToConfig() {
		
		
			return '../application/config/config.xml';
			
	}
	
	
	
	/**
	 * Inicjuje sesje, system.
	 */
	
	public static function start() {
		
		
			$registry = new Class_myRegistry();
			
			$registry->start();
			
			
			$db = new db();
			
			$db->start();
			
			$auth = new auth();
			
			$auth->start();
			
	}
	
	
	
	/**
	 * 
	 * Zwraca tablice typu configModulesElement.	 
	 * Karzdy element reprezentuje jeden zainstalowany modu�.
	 * 
	 */
	public function getModulesInfo() {

		
		return system_configModulesApi::getModules( $this->patchToConfigFile, $this->moduleSection );
				
	}
	
	

	/**
	 * Tworzy konstrukcje z obiekt�w powi�zanych z dan� akcj� przekazan� jako param.
	 * 
	 * @param param type $param
	 * 
	 * @return 
	 * 
	 */
	
	public function build( $param ){
		
		
		//dane kt�ry modu�y s� po��czone s� zapisywane w //moduleName/controllerName/ActionName 
		
		$str = Class_xpatch::arrayToXpatch($param->toArray());
		
//	/	$str='//sale/transaction/step1';
		
		$children =  Class_Config_myConfig::getConnections( $str, $this->patchToConnectionFile );
		
		//$children = Class_myXml::getSubChildrenFromXpatch($str,$this->patchToConnectionFile);
		//var_dump($str);
		
		$elem = $this->createElements( $children );			

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
	
	
	
	/**
	 * Tworzy obiekt systemClient 
	 * 
	 * @param array $child
	 */
	
	private function createClient( $moduleName, $className ) {
		
		
		require_once $patchToModule.$moduleName.'/common'.$className.'.php';
		
		return new $className();
		
	}
	
	
	
	/**
	 * Zwraca akcje pprzypisane do danego parametru. Deleguje zadanie metodzie getConnection z klasy  Components_Entite_Connections_library_SystemConnector.
	 * 
	 * @return array nazwy skojarzonych modu��w.
	 */	
	
	public function getConnections( $param ) {		
			
		$sysConector = new Components_Entite_Connections_library_SystemConnector();
	
	
		return $sysConector->getConnections( $param , $this->patchToConnectionFile );	
			
	}
	
	
	
	/**
	 * @return Zwraca tablice z nazwami mod�w kture wype�niaj� kontrak danego modu�u.
	 * 
	 * @param param $param
	 */
	
	public static function getContract( $param ) {
		
		
		$array = array ( 'zend-config', $param->module() );		
		
		$xpatch = Class_xpatch::arrayToXpatch( $array );
	
		$ch = Class_Config_myConfig::getConnections( $xpatch, '../application/config/contract.xml' );
	
		
	
		
		return $ch;
		
	}
	
	
}
?>