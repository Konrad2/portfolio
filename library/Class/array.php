<?php
/**
 * Funkcje  na tablicach.
 * @author Konrad
 * @package class
 */
class Class_array {

	
	public static function keyToValue($array){
		
		$keys = array_keys($array);
		
		$result = array();
		
		foreach ($keys as $key){
			
			$result[ $array[$key] ] = $key;
		}
		
		return $result;
	}
	
	/**
	 * warto�ci z tablic dwuwymiarowych tworzy tablice jednowymiarow�. Kluczami staj� si� warto�ci z tablicy o indeksie 0 a varto�ciami 1.
	 * @param array $array tablica zawieraj�ca tablice dwuwymiarow�.
	 * @return array
	 */
	public static function dimensionToArray($array){
		
		$r = array();
		foreach ($array as $a){
		
			$r[array_shift($a)] = array_shift($a);
		}
		
		return $r;
	}
	
	/**
	 * @return zwraca wartoć z tablicy z poodanego klucza.
	 * @param $array tablica wielowymiarowa.
	 * @param $key Klucz
	 */
	static public function getValue($array, $key){
		
		$result = null;
	
		if ( is_array($array) )	
		{
			foreach ($array as $k=>$v)
			{
				if ($k !== 'id')
				{
				
					if ( is_array($v))
					{
						if ( isset($v[$key]) )
						{
							$result = $v[$key];
							
						}
						else
							$result = self::getValue($v,$key);
					}
					else
					{
						if ($k == $key )
						{
									$result = $v;
									break;
						}
					}
				}
			}
		}
	//	else
		//{
			//if ($k == $key )
				//		$result = $v;			
			
		//}
		
		
		return $result;
	}
}
?>