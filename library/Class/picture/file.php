<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_picture_file extends Class_file_file implements interfaces_picture_file {


	
	protected $patch;
	
	protected $patchToImages;
		
	protected $error;
		
	//protected $maxWidth;
	
	//protected $maxHeight;	
	
	
	public function __construct( $maxWidth = 300 , $maxHeight = 300 ){
		
		//$this->maxWidth = $maxWidth; 
		
		//$this->maxHeight = $maxHeight;
		
	}
	
	
	/**
	 * Usuwa plik. Rozbudowane o obs�ug� b��d�w.
	 * @param unknown_type $patch
	 * @param unknown_type $fileName
	 */
	/*
	public function delete($patch,$fileName)
	{
		
		if (file_exists($patch.'/'.$fileName))
		{			
			if (file_exists($patch.'/icons/'.$fileName))
				unlink($patch.'/icons/'.$fileName);
				
			return unlink($patch);
		}
		else
			$this->error = 'Nie znaleziono pliku do usuni�cia';
			
		return false;
		
	}
*/
	
	
	
	
	/**
	 * 
	 * Zmienia nazw� pliku.
	 * 
	 * @param unknown_type $patch
	 * @param unknown_type $newName
	 * 
	 */
	
	public function rename( $patch, $newName ) {
		
		
		if ( file_exists( $patch ) ) {
			
			
			rename($patch, $newName);
						
		}
		
	}

	/**
	 * usuwa plik wraz z miniatur�.
	 * 
	 * @param $patch
	 * 
	 */
	
	public function delete( $patch ) {
		
		
		$fileName = basename( $patch );
		
		$dirName = dirName( $patch );
		
		$iconsPatch =  $dirName . '/icons/' . $fileName;
		
		
		
		if ( file_exists( $patch ) ) {
			
			
			if ( parent::delete( $patch ) ) {
				
				
				if ( parent::delete( $iconsPatch ) ) {
					
					/**
					 * @todo Je�li by� to g��wny obraz, podstaw nowy.
					 */
					
					//if ($filename === 'main.jpg')
					//{
						//----------------
						//$this->setAsMain($dirName);
					//}
					
					
					return true;
										
					
				} else 	{
					
					
					$this->error = 'Nie skasowano ikony. Nie można odnaleść pliku ';
					
				}	
				
			} else {
				
				
				$this->error = 'Nie można odnaleść obrazu '.$patch;
				
			}
			
			
		}  else
		
		
			$this->error = 'Nie mo�na odnaleść obrazu '.$patch;
			
			
			

		return false;
		
		
	}
	
	
	
	public function getLastError() {
		 
		
		return $this->errors;
		
	}
	
		
	
	/**
	 * 
	 * Sprawdz wielko�� obrazka.
	 * 
	 * @param string $patch �cie�ka do pliku jpg.
	 * 
	 */
	
	//public function isCorrectSize( $path, $maxWidth = null, $maxHeight = null ) {
	public function isCorrectSize( $path, $maxWidth , $maxHeight ) {

		//echo '<br/>in file '.$maxWidthX.'<br/>';
		//TODO - file exists mop�na by usun�� po testach.
		if ( file_exists ( $path ) ) {
			
			
		// Je�li urzykownik nie poda� maksymalnej wielko�ci nadawane jest domy�lna.
			/*if ( ( $maxHeight <> null ) && ( $maxWidth <> null ) )	{

				
				$maxHeight = 300;
				
				$maxWidth = 300;
				
			}
*/			
			
			
			$size = getimagesize($path);


			if ( ( $size[1] > $maxHeight ) || ( $size[0] > $maxWidth ) ) {

				
					return false;
				
			} else	{
					
					
					return true;
					
			}
			//if 
			

		} else {
			
			
			$this->error = "Nie mośna odnaleść pliku aby sprawdzić jego wielkość.";
			
			throw  new Exception('Nie można odnaleść pliku "'. $path .'" aby sprawdzić jego wielkość.');
			
			//return false;
		}
		
		
	}
		

	
	/**
	 * Zwraca zmniejszony obraz. Jeli jest wikrzy niż w $size.
	 *  
	 * @param unknown_type $path cierzka do pliku.
	 * @param int $size wielko obrazka. Jednoczenie podajemy wysoko oraz szerokosc.
	 * 
	 * @return img
	 */
		
	public function resize ($path, $size)	{
		
		
		$img = imagecreatefromjpeg($path);
		
		$x = imagesx($img);
		
		$y = imagesy($img);

		
		//
		if ( $x > $y )	{
			
			
		    $nx =  $size;
		    
		    //
		    $ny =  $size * ( $y / $x );
		    
		    
		   // 
		} elseif ( $x < $y ) {
			
			
			//
		    $nx =  $size * ( $x / $y );
		    
		    $ny =  $size;
		    
		    
		    //
		} else {
			
			
		    $nx =  $size;
		    
		    $ny =  $size;
		    
		    
		}
		
		
		$new_img = imagecreatetruecolor($nx, $ny);
		
		imagecopyresampled($new_img, $img, 0, 0, 0, 0, $nx, $ny, $x, $y);
		
		//imagejpeg($new_img, $path);
		
		return $new_img;		
		
	}
	
	
}

?>