<?php
/**
 * Klasa do pracy z x patch;
 * @author Konrad
 * @package Xml
 */
class Class_xpatch
{
	/**
	 * Tworzy ciag string z elemetow tablicy oddzielonych slash-em.
	 * Zwraca null jeli tablica byla pusta.
	 * 
	 * @param array $a
	 * @return string
	 */
	public static function arrayToXpatch($a)
	{
		$xpatch = '/';
		
		if (count($a) > 0){
												
			foreach($a as $v)
			{				
				if ( $v != null )
					$xpatch .= '/'.$v;
			}			
		}
		else
		{
			$xpatch = '//';
		}
		
		if( strlen($xpatch) == 1 )
			$xpatch = null;
			
		return $xpatch;
	}
}


?>