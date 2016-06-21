<?php

/**
 * 
 * U�atwia zarz�dzanie plikami.
 * 
 * 
 * @author Konrad
 * 
 * @version 1.0
 * 
 * @created 04-sie-2010 16:16:41
 * 
 */


class Class_picture_manager extends Class_picture_file {
	
	
	
	/**
	 * 
	 * Przenosi obraz. Je�li w docelowym katalogu nie ma pliku main, zmienia nazw� na main.jpg. Tworzy ikon�. 
	 * 
	 * @param string $patch
	 * @param string $destination
	 * @param string $fileName
	 * 
	 */
	
	public function add( $path, $destination, $fileName ) {
		
		
		if (file_exists($destination.'/main.jpg'))		
				
		
			$fileName = md5( time() ).'.jpg';		
			
			
		else
		
		/**
		 * @todo setas main.
		 */
			$fileName = '/main.jpg';
		
			
			throw new exception();
		if ( ! $this->isCorrectSize( $path , 300 ,300 ) ) {
			
				echo "zaduży";
				
				$this->resize($path, 300);
				
			
		}else

				echo "rozmiar prawidowy";
					
		
		$this->move($path,$destination,$fileName);
		
		
		if ( ! $this->createIcon ( $destination . '/' . $fileName , $destination . '/icons', $fileName) ) {
				
			
			throw new Exception( $this->error );			
			
		}
		
		
	}
	
	
	/** 
	 * Zwraca nazw obrazka gownego.
	 * 
	 * @param unknown_type $dir
	 *  
	 */
	
	public function getMainPath($dir) {
		
		
		return $dir.'/main.jpg';
		
	}
	
	
	
	/**
	 * Ustawia grafik jako g�wny.
	 * 
	 * @param unknown_type $path
	 * 
	 */
	
	public function setAsMain($path)  {
		
		
		
		if ( file_exists ( $path ) ) {

			
			$tempImage = null;			
			
			$pathToIcon = $this->getIconPatch($path);
			//echo $path
			//$new = makePictureName($path);	
			$main = dirName($path);
			
			
			if ( file_exists( $main . '/main.jpg' ) ) {
				
				
				// Kasowanie g��wnego obrazka 
				$tempImage = imagecreatefromjpeg($main.'/main.jpg');
				
				unlink($main.'/main.jpg');
				
				
				// Zamiana obrazka docelowego na g��wny.
				if ( ! rename( $path, $main . '/main.jpg' ) )
				
				
					echo "nie zmieni�em nazwy";
					
				else
				
				
					echo "zamieni�em<br/>";

					
				//Zapis starego g��wnego obrazka.
				imagejpeg($tempImage, $path, 90);

				imagedestroy($tempImage);

				
				// Wprowadzanie ikony do pami�ci.
				$tempImage = imagecreatefromjpeg($main.'/icons/main.jpg');
				
				
				// Kasowanie ikony.
				unlink($main.'/icons/main.jpg');
				
				
				// Zamiana ikon.
				rename($pathToIcon, $main.'/icons/main.jpg');
				
				
				//Zapis ikony
				//imagejpeg($tempImage, $main.'/'.basename($path), 90);
				imagejpeg($tempImage, $pathToIcon , 90);
				
				imagedestroy($tempImage);
				
				
			} else	{
				
				
				rename($path, $main.'/main.jpg');
				rename($pathToIcon, $main.'/icons/main.jpg');
				
			}	
			
			
		} else 	{
			
			
			echo 'Nie mo�na odnale�� pliku '.$path;
			
			return false;
			
		}
		
		
		return true;
		
	}	

	
	
	/**
	 * 
	 * @param string $patch 
	 */
	
	private function getIconPatch( $patch ) {
		
		
		return dirName( $patch ) . '/icons/' . basename( $patch );
		//return dirName($patch).'/icons';
	}

	
	
	/**
	 * 
	 * @return Zwraca nazwy plik�w z katalogu.
	 * 
	 */		
	
	public function getIcons($dir){
		
		
		$iconsNames = array();
		
		if ( file_exists($dir) ) {
			
			
			$iconsNames = Class_dir_dir::getFilesNames($dir);					
		}
	
		
		return $iconsNames;
		
	}

	
	
	/**
	 * 
	 * Tworzy Ikone.
	 * 
	 * @param unknown_type $patch
	 * @param unknown_type $destination
	 */
	
	private function createIcon( $patch, $destination, $iconName )	{

		
		try {
		
			
			if ( file_exists( $patch ) ) {

				
				if ( ! is_dir( $destination ) )
				
				
					if ( ! mkdir( $destination ) )
					
					
						throw new Exception("nie mo�na utworzy� katalogu dla ikony");			
				

						
				$icon = $this->resize($patch, 150);
				
				imagejpeg($icon,  $destination.'/'.$iconName);
				
				
			}

			
		} catch (Exception $ex ) {
			
			
				$this->errors = $ex->getMessage();
			
			
				return false;		
			
		}
		
		
		return true;
		
		
	}
	

	
}

?>