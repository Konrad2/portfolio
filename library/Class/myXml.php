<?php

/**
 * Do pracy z plikami xml
 * @author Konrad
 * @package Xml
 */
class Class_myXml //extends
{
	/** 
	 * @return tablice nazw elemt�w oraz ich wartoci. zwracane s dzieci ze cierzki xpatch z pliku znajdujcego si w miejscu wskazanym w drugi prametrze 
	 * @param string $patch - xpatch np //modes/sale/order 
	 * @param string $patchToFile - cierzka do pliku xml
	 */
	public static function getSubChildrenFromXpatch($patch,$patchToFile)
	{
		$result = array();
		
		if ($patch != null)
		{
			$doc = new DOMDocument;
		
			// We don't want to bother with white spaces
			$doc->preserveWhiteSpace = false;
			
			
			$doc->Load($patchToFile);		
			
			$xpath = new DOMXPath($doc);	
			
			$entries = $xpath->query($patch);		
			
			foreach ($entries as $entry){				 			 	
				 	//	var_dump($entry);	   
				$pom = $entry->childNodes;
					
	 			  foreach ($pom as $r){ 			 			 
	 			  	$result [$r->nodeName]= $r->nodeValue;
	 			 }
			}
		}
					
		return $result;		
	}
		
	public static function getValuesSubChildrenFromXpatch($patch,$patchToFile)
	{
				
		$doc = new DOMDocument;
	
		// We don't want to bother with white spaces
		$doc->preserveWhiteSpace = false;
		
		
		$doc->Load($patchToFile);
		
		
		
		$xpath = new DOMXPath($doc);	
		
		$entries = $xpath->query($patch);
		
		$result = array();
		
		
		
		foreach ($entries as $entry){
			 			  	
 			  foreach ($entry as $r){
 			  
 			  	$result []= $r->NodeValue;
 			 }
		}
 					
		return $result;		
	}
	
	/**
	 * procedura niezaimplementowana
	 * @param $parent
	 */
	private function getChildrenFromElement($parent)
	{
		
	}
	
}
?>