<?php
/**
 * Zawiera metode getCOnnections ktura zwraca tablice z nazwami modułów.
 * @package Connections
 * 
 * @author Konrad
 * @package Connections
 *@todo można go usunąć i zrobić w conectors.
 */
class Components_Entite_Connections_library_SystemConnector {
	
	/**
	 * Zwraca tablicę z nazwami modułów
	 * @param param $param
	 * @param string  $patchToConnectionFile Ścieżka do pliku xml.
	 */
	public function getConnections( $param, $patchToConnectionFile ) {
		
		
		$array = $param->toArray();
		
		array_unshift( $array, 'zend-config');
		
		$str = Class_xpatch::arrayToXpatch($param->toArray());

		$ch = Class_Config_myConfig::getConnections( $str, $patchToConnectionFile );
		//echo $patchToConnectionFile;
			//echo $str;
		
		return $ch;
		
	}

}
