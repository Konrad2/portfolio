<?php

/** 
 * @author Konrad
 * @package Forms
 * 
 */
class Class_forms_file extends Zend_Form_Element_File {
	
	public function save($dir){
		
		try{
			
			$old = $this->getDestination();
			
			$old .= $this->getFileName();
			
			$file = new Class_file_myFile();
			$file->moveFile($old, $dir);
			
		}
		catch (Exception $e){
			throw new Exception('class_forms_file_save cos jest nie tak');
		}
		
	}
}
?>