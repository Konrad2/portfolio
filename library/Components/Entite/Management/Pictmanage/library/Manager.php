<?php

/**
 * @author Konrad
 *@Package Pictures
 *@package Management
 *@package Entite
 */
class Pictmanage_library_Manager extends Class_picture_file {	
	
	/**
	 * Jako miniatury
	 * @var int
	 */
	private $__quality = 90;
	
	/**
	 * Rozszerzenie
	 * @var unknown_type
	 */
	private $__extension = 'jpg';
	
	/**
	 * Ustawia jakosc obrazka.
	 * @param unknown_type $quality
	 */
	public function setQuality( $quality ) {		
		
		$this->__quality = $quality;
		
	}
	
	
	
	/**
	 * 
	 * Przenosi obraz. Jesli w docelowym katalogu nie ma pliku main, zmienia nazw� na main.jpg. Tworzy ikon�. 
	 * 
	 * @param string $patch
	 * @param string $destination
	 * @param string $fileName
	 * 
	 */
	
	//public function add( $path, $destination, $fileName , $width = 300, $height = 300, $miniatureWidth = 100, $miniatureHeight = 100 ) {
	
	//TODO- przekaza© path
	
	//public function add( $path, $destinationPath, $pathToIcons, $mainName , $width = 300, $height = 300, $miniatureWidth = 100, $miniatureHeight = 100 ) {
	
	/**
	 * Przenosi obrazek, tworzac jego miniatórę oraz sprawdzajc jego wielkoć. Jeli jest za durzy zmniejsza.
	 * @param $sourse
	 * @param $path
	 * @param $width
	 * @param $height
	 * @param $miniatureWidth
	 * @param $miniatureHeight
	 */
	public function add( $sourse, Pict_library_ConcretedPaths $path , $width ,$height, $miniatureWidth, $miniatureHeight ) {
		
			
		// default.jpg
		
		$newPictureName = 'default.'.$this->__extension;
		
		
		//TODO przez seta as main.
		
	//	echo $path->getPatchToMainPictFromIndex( );
		
	if ( file_exists( $path->getPatchToMainPictFromIndex( ) ) )
			
				$newPictureName = md5 ( time() ) .'.' .$this->__extension;
			
		else
		
				//$newPictureName = '/'.$path->getMainPictureName();
				$newPictureName = $path->getMainPictureName();
			
			 
			
				
			
		if ( ! $this->isCorrectSize( $sourse , $height ,$width ) ) {
			//throw new Exception();
			//	echo "zaduży";
		//	echo '<br/>in manager Width '.$width.'<br/>';
		
					//$this->resize($path, $width,$height);
					$this->resize( $sourse, $width, $height );
				
		}
		
	//	echo '<br/>'.$path->getPatchToIconDirectory().'<br/>' ;
		
		$this->move( $sourse, $path->getPathFromIndexToImages( ) , $newPictureName );
		
	//	echo '<br/>in manager ninWidth '.$miniatureWidth.'<br/>';
		//if ( ! $this->createIcon ( $path->getPatchToDirectory(). '/' . $newPictureName , $path->getPatchToIconDirectory()  , $newPictureName ,$miniatureWidth, $miniatureHeight ) ) {
		
		
		if ( ! $this->createIcon ( $path->getPathFromIndexToImages( ) . '/' . $newPictureName, $path->getPatchToIconDirectoryFromIndex( )  , $newPictureName ,$miniatureWidth, $miniatureHeight ) ) {
				
			
			
				echo $this->errors;
				
			
		}
		
		
		return true;
		/*
		if ( file_exists( $destinationPath . '/' . $mainName ) )
			
				$newPictureName = md5 ( time() ) . $this->__extension;
			
		else
		
				$newPictureName = '/'.$mainName;
			
			
			
		if ( ! $this->isCorrectSize( $path , $width ,$height ) ) {
			
				//echo "zadu�y";
			
				$this->resize($path, $width);
			
			
		} else {
			
				echo "rozmiar prawidowy";	
		}
		
		
		$this->move( $path, $destinationPath, $newPictureName );
		
		
		if ( ! $this->createIcon ( $destinationPath . '/' . $newPictureName , $pathToIcons , $newPictureName ,$miniatureWidth, $miniatureHeight ) ) {
				
			
				throw new Exception( $this->error );
			
		}
		*/
		
	}
	
	
	/** 
	 * Zwraca nazw obrazka gownego.
	 * 
	 * @param unknown_type $dir
	 *  
	 */
	
	/*
	public function getMainPath($dir) {
			
		return $dir.'/main.jpg';
		
	}
	*/
	
	
	/**
	 * Ustawia grafik jako główny.
	 * 
	 * @param unknown_type $path
	 * 
	 */
	
	
	public function setAsMain($path, $classPath)  {
		
		
		
		if ( file_exists ( $path ) ) {

			
			$tempImage = null;			
			
		
			
			
			//$main = dirName($path);
			$main = dirName( $path );
			
			
			//if ( file_exists( $main . '/main.jpg' ) ) {
			if ( file_exists( $mainPath = $classPath->getPathFromIndexToMainPicture() ) ) {
				
				//throw new Exception( 'dziala '.$mainPath);
				
			
				
				// Kasowanie g��wnego obrazka 
				$tempImage = imagecreatefromjpeg($mainPath);
				
				unlink( $mainPath );
				
				
				// Zamiana obrazka docelowego na glowny.
				
				
				//sprawdzanie czy klient nie chce ustawi gównego obrazka (assercja dodatkowa).
				
				if ( $path !== $mainPath) {
				

					if ( ! rename( $path, $mainPath) );// {
										
									//echo 'nie zmieniłem nazwy z: ' . $path . ' na ' . $mainPath;
							
						//} else				
						
								//echo '<br/>zamieniłem '. $path . ' na '. $mainPath . '<br/>';
								
				}

				
				//Zapis starego g��wnego obrazka.
				imagejpeg($tempImage, $path, 90);

				imagedestroy($tempImage);

				
				$pathToIcon = $this->getIconPatch($path);
					
				$iconPath = $classPath->getPathFromIndexToMainIcon();
				
				echo'<br/>iconsPaths:<br/> '.$pathToIcon;
				echo '<br/> '.$iconPath;
				
				
				
				// Wprowadzanie ikony do pami�ci.
				$tempImage = imagecreatefromjpeg( $iconPath );
				
				
				// Kasowanie ikony.
				unlink( $iconPath );
				
				
				// Zamiana ikon.
				rename( $pathToIcon, $iconPath );
				
				
				//Zapis ikony
				//imagejpeg($tempImage, $main.'/'.basename($path), 90);
				
				imagejpeg($tempImage, $pathToIcon , $this->__quality);
				
				imagedestroy($tempImage);
				
				
				
			} else	{
				
				throw new Exception ($mainPath);
					rename($path, $mainPath);
				
					rename($pathToIcon,  $classPath->getPathTomainIcon() );
				
			}	
			
			
		} else 	{
			
			
			echo 'Nie można odnaleźć pliku '.$path;
			
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
	/*
	public function getIcons($dir){
		
		
		$iconsNames = array();
		
		if ( file_exists($dir) ) {
			
			
			$iconsNames = Class_dir_dir::getFilesNames($dir);					
		}
	
		
		return $iconsNames;
		
	}

	*/
	
	/**
	 * 
	 * Tworzy Ikone.
	 * 
	 * @param unknown_type $patch
	 * @param unknown_type $destination
	 */
	
	private function createIcon( $patch, $destination, $iconName, $miniatureWidth, $miniatureHeight   )	{

	//echo '<br/>in manager create Icon ninWidth '.$miniatureWidth.'<br/>';
		
		try {
		
			
			if ( file_exists( $patch ) ) {

				
				if ( ! is_dir( $destination ) )
				
			
					if ( ! mkdir( $destination ) )
					
					
							throw new Exception('Nie można utworzyć katalogu '. $destination .' dla ikony');			
				

						
				$icon = $this->resize($patch, $miniatureWidth,$miniatureHeight);
				
				echo $destination.'/'.$iconName;
				
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