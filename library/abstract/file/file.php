<?php


/**
 * @author Konrad
 * @version 1.0
 * @created 04-sie-2010 11:09:19
 */
class file
{
	protected $error;
	
	public function file()
	{
		$this->errors = array();
	}

	/**
	 * 
	 * @param destination
	 * @param sourse
	 */
	public function move($destination, $sourse)
	{
		
		if (file_exists($sourse))
		{
			copy($sourse, $destination);
			$this->delete($sourse);
		}
		else
			$this->errors[] = 0;
		
	}

	/**
	 * 
	 * @param destination
	 * @param sourse
	 */
	public function copy($destination, $sourse)
	{
		if (file_exists($sourse))
		{
			copy($sourse, $destination);
		}
		else
			$this->errors[] = 'przenoszenie nie powiod³o siê';
			
	}

	public function delete()
	{
	}

	/**
	 * 
	 * @param patch
	 * @param newName
	 */
	public function rename($patch, $newName)
	{
	}
	
	public function getErrorMessage(){
		
		$r =  (count($this->error) == 0) ? false : $this->errors ;
		return  $r;			
	}

	public function error_text($err_num){
		
			$error[0] = "przenoszenie nie powiod³o siê";
			$error[1] = "The uploaded file exceeds the max. upload filesize directive in the server configuration.";
			$error[2] = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form.";
			$error[3] = "The uploaded file was only partially uploaded";
			$error[4] = "No file was uploaded";
			// end  http errors
			$error[10] = "Please select a file for upload.";
			$error[11] = "Only files with the following extensions are allowed: <b>".$this->ext_string."</b>";
			$error[12] = "Sorry, the filename contains invalid characters. Use only alphanumerical chars and separate parts of the name (if needed) with an underscore. <br>A valid filename ends with one dot followed by the extension.";
			$error[13] = "The filename exceeds the maximum length of ".$this->max_length_filename." characters.";
			$error[14] = "Sorry, the upload directory doesn't exist!";
			
			return $error[$err_num];
	}

}
?>