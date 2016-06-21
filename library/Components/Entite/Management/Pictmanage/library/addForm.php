<?php

/** 
 * @author Konrad
 * @package Pictures
 * @package Management
 * @package Entite
 */
class Pictmanage_library_addForm extends Zend_Form {
	
	protected $error = null;
	
	protected $_elemFileName = 'uploadFile';
	
	protected $_filePicture = null;	
	
	
	/**
	 * 
	 */
	public function init(){		
		
		/**
		 * 
		 * @var nazwa elementu typu Zend_Form_Element_Upload. Domylnie 'uploadFile'.
		 * @todo zmienic na dynamicznie.
		 * 
		 */
		
		
		
		
		$this->addElement('file', $this->_elemFileName, array(

           						'destination' => '../uploads',
		
            					'validators' => array(

               							array('count', false, 1),

               							array('size', false, 402400),
               							
               							array ('Extension', false , array( 'jpeg', 'jpg' , 'JPG', 'JPEG')  ),
               							
               							//array ('File_IsImage'),
               							
               							
               							//array ('MimeType', false , array( 'image/jpeg', 'image/jpe') )
           		 ),

           		 'label' => 'Wybierz obraz',
           		 
        ));        
        
        $this->addElement('hidden','id');
        
        $this->addElement('submit', 'submit', array(

           				 'label' => 'Wyslij'
        		));
       
        
        $this->setEnctype('multipart/form-data');	
        
	}
	
	
	/**
	 * Odbiera plik oraz zapisuje we wskazanym miejscu.
	 * @param string $dir  Miejsce zapisu pliku. 
	 */
	
	public function uploadFile( $dir , $limitSize , $minatureSize ) {	
		
		
		if ( $this->receive() ) {			
			
			
				//$picManager = new Class_picture_manager();				
		
				
				//$error = $picManager->add ( $this->uploadFile->getFileName() , $dir, 'main.jpg' );
			
			
				
				
				//if ( $error != null ) {
						
					//	echo 'Obrazek nie zostal zapisany z powodu "' . $error . '"</br>';
					
			//	}
				 
				return  $this->uploadFile->getFileName();
				
		} else {
			
				throw new exception ("nie został przesłany na serwer");
		}
		
	
		
	}
	
	
	/*
	
	public function uploadFiles(){
		
	}
	
	*/
	
	
	/**
	 * Odbi�r pliku.
	 */
	
	protected function receive(){
		
		
		if ( ! $this->uploadFile->isUploaded() ){ 			
			
			
			// Czy cokolwiek zosta�o wys�ane?		
		     $this->error = 'Nie wybrano pliku do wys�ania.';		     
		     
		     return false;
		     
		     
		}elseif ( ! $this->uploadFile->receive() ){				
			
			
			// Odbi�r pliku		
		      $this->error = 'Bład podczas odbierania pliku.';
		      return false;
		      
		       	
		 }else{		 			 
		 	
		 	
		 	// Sukces
		      return true;
		      
		     	
		 }
	}
	
	/**
	 * 
	 */
	public function getError(){
				
		
		return $$this->error;
		
	}
}

?>