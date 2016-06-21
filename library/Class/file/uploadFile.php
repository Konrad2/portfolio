<?php

/** 
 * @author Konrad
 * @package File
 * @subpackage Form
 * 
 */
class uploadFile {
	//TODO - Insert your code here

	public function uploadFile(){
		
		$fileElements = $this->getElementsByClassName('Class_picture_upload');
		
		foreach ( $fileElements as $file)
		{
			 if (! $file->isUploaded()) { // Czy cokolwiek zosta³o wys³ane?
		
		        	$information = 'Nie wybrano pliku do wys³ania.';	
		    	}
		    	elseif (! $file->receive()) { // Odbiór pliku
		
		        	$information = 'B³±d podczas odbierania pliku.';	
		    	}
		    	else
		     	{ // Sukces		     				     		
		     		
		        	$information = 'Plik ' . $file->getFileName()
		        	. ' zosta³ poprawnie wys³any.';
		        	
					//$newRow = parent::formToDb($row, $data, $values);
							 
					$newDir = 'images/things/'.$newRow->id;				 
			
					$picManager = new Class_picture_manager();				
				
					$error = $picManager->add( $this->uploadFile->getFileName() , $newDir, 'main.jpg');
					
					if ( $error != null ){
						
						echo 'Obrazek nie zosta³ zapisany z powodu "'.$error.'"</br>';
					}
			
		    	}
			}	    	
	    	//echo $information;
	}
	
	/**
	 * @return Zwraca elementy o danej nazwie klasy.
	 * @param string $className
	 */
	protected function getElementsByClassName($className){
		
	}

}

?>