<?php

/**
 * @author Konrad
 * @version 1.0
 * @updated 05-sie-2010 12:04:24
 */
class Class_file_file extends abstract_object// extends abstrac_file
{
	
	/**
	 * Ustawia nazwy kluczy tabeli na nazwy pliku podane w cieżce.
	 * @param array $array Tablica ze scieżkami do plików.
	 * @return array
	 */
	static public function putFileNameToKey($array){
		
		$output = array();
		
		foreach ( $array as $row){
			
			$filename = baseName( $row );
			
			
			if ( ! empty ( $filename ) ){
				
						$output[ $filename ] = $row;
						 
			} else {
				
						$output [] = $row;
						
 			}
 			
 			
		}
		
		return $output;
	}

	/**
	 * Przenosi plik.
	 * @param unknown_type $sourse
	 * @param unknown_type $destination
	 * @param unknown_type $fileName
	 */
	public function move($sourse,$destination, $fileName){
			
		$error = null;
		
		if ( file_exists($sourse))
		{
			if (!file_exists($destination))
				if (! mkdir($destination))
					$error = 'Nie mo�na utworzu� katalogu '.$destination;
				
			if ( $error === null ){
						
				if ( copy($sourse, $destination.'/'.$fileName))
				{
					 if (!unlink($sourse))
					 {
					 	$error = 'Nie usuni�to pliku �rud�owego';
					 }
				}
				else
					$error = 'Kopiowanie nie powiod�o si�';
			}
		}
		else 
			$error = 'Plik '.$sourse.' nie istnieje';
		
		return $error;
	}

	//Po to aby by�o w jednym miejscu.
	/**
	 * Kopjuje plik.
	 * @param unknown_type $sourse
	 * @param unknown_type $destination
	 */
	public function copy($sourse,$destination)
	{
		return copy($sourse,$destination);
	}

	/**
	 * Kasuje plik
	 * @param unknown_type $patch
	 */
	public function delete($patch)
	{
		$result = false;
		
		if ( file_exists($patch) )
		{
			if (!unlink($patch) )
			{
				$this->error = 'Nie udało usuną się pliku '.$patch;
				$result = false;
			}
			else {
				
				$result = true;
			}
		}
		else
		{
			$this->error = "Nie można odnaleść pliku do usunięcia.";
			$result = false;
		}
		
		return $result;
	}

	/**
	 * Zmienia nazw� pliku.
	 * @param $oldName
	 * @param $newName
	 */
	public function rename($oldName, $newName)
	{
		return rename($oldName, $newName);
	}
	
	
/**
 * usuwa katalog z zawartością(podkatalogami).
  EmptyDir, v0.1
  uzycie:
    EmptyDir("nazwakatalogu");
    EmptyDir("nazwakatalogu", false); // (lub 0)
     - skasowanie zawartosci katalogu
    EmptyDir("nazwakatalogu", true); // (lub 1)
     - usuniecie katalogu razem z zawartoscia,
       niekoniecznie w tej kolejnosci
  wartosci zwracane:
    true  - powodzenie
    false - niepowodzenie
*/
static function deleteDir($dirName, $rmDir = false) {
	
	
  if( $dirHandle = opendir( $dirName ) )  {
  	
    while ( false !== ( $dirFile = readdir( $dirHandle ) ) )
    
    
      if (($dirFile != ".") && ($dirFile != "..")) 
 
      // tu moje, bo problem z katalogiem wewnątrz
      if(is_dir($dirName . "/" . $dirFile)){EmptyDir($dirName . "/" . $dirFile, true);}
      else
      //koniec mojego z katalogiem wewnątrz
 
        if(!unlink($dirName . "/" . $dirFile))
          return false;
    closedir($dirHandle); 
    if($rmDir)
      if(!rmdir($dirName))
        return false;
    return true;
  }
  else
    return false;
}
}

?>