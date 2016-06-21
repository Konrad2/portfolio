<?php

/** 
 * @author cckoles
 * 
 * 
 */
class Class_uploadWortal {

public $name_file;

public $name;

public $type;

public $size; 

public $tmp; 

public $message;

 

	public function Save($file_user, $upload_dir, $typ = array(), $rename = null, $prefix = null )

	{

		if (isset($_FILES[$file_user]['name'])){
		
		$uploadErrors = array(
		
		UPLOAD_ERR_OK => 'Plik zosta³ poprawnie za³adowany.',
		
		UPLOAD_ERR_INI_SIZE  => 'Rozmiar pliku jest za du¿y. Ograniczenie na serwerze.',
		
		UPLOAD_ERR_FORM_SIZE  => 'Rozmiar pliku jest za du¿y.',
		
		UPLOAD_ERR_PARTIAL => 'Plik tylko czê¶ciowo za³adowany.',
		
		UPLOAD_ERR_NO_FILE => 'Brak pliku do za³adowania.',
		
		UPLOAD_ERR_NO_TMP_DIR => 'Brak tymczasowego folderu tmp !',
		
		UPLOAD_ERR_CANT_WRITE => 'Nie mo¿na zapisaæ pliku na dysk.'
		
		/* wymaga php 5.2.0
		
		UPLOAD_ERR_EXTENSION => 'File upload stopped by extension.' */
		
		);
		
		 
		
		$this->name  = $_FILES[$file_user]['name'];
		
		$this->type = $_FILES[$file_user]['type'];
		
		$this->size  = $_FILES[$file_user]['size'];
		
		$this->tmp = $_FILES[$file_user]['tmp_name'];
		
		$this->message = $uploadErrors[$_FILES[$file_user]['error']];
		
		 
		
		$uploadfile = $upload_dir . basename($_FILES[$file_user]['name']);
		
		 
		
		if ($_FILES[$file_user]['error'] == 0){
		
		$this->type = explode('/',$this->type);
		
		// zamiana rozszerzen w przypadku uploadu w IE
		
		$replace_prefix = array('pjpeg','x-png');
		
		$new_prefix  = array('jpeg','png');
		
		$new_type = str_replace($replace_prefix, $new_prefix , $this->type[1]);
		
		if (in_array($new_type, $typ)){
		
		// jesli parametr zmiany nazwy jest nie ustawiony rename = null
		
		if($rename == null){
		
		if (file_exists($uploadfile)){
		
		$this->message = 'Plik o nazwie '.$_FILES[$file_user]['name'].' ju¿ istnieje. Zmieñ nazwê pliku i za³aduj ponownie.';
		
		return false;
		
		}else{
		
		if (move_uploaded_file($_FILES[$file_user]['tmp_name'], $uploadfile)){
		
		$this->message = 'Plik zosta³ za³adowany pomy¶lnie';
		
		$this->name_file = $this->name;
		
		return true;
		
		}else{
		
		$this->message = 'B³±d ³adowania pliku';
		
		return false;
		
		}
		
		}
		
		}
		
		if($rename != null){
		
		if (move_uploaded_file($_FILES[$file_user]['tmp_name'], $uploadfile)){
		
		$this->message = 'Plik zosta³ za³adowany pomy¶lnie';
		
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$new_name = md5($ip . date('YmdHis'));
		
		if(rename($uploadfile, $upload_dir . $prefix. $new_name .'.'. $new_type)){
		
		$this->name_file = $prefix . $new_name . '.' . $new_type;
		
		return true;
		
		}else{
		
		$this->message = 'Nie mo¿na zmieniæ nazwy pliku.';
		
		return false;
		
		}
		
		return true;
		
		}else{
		
		$this->message = 'B³±d ³adowania pliku';
		
		return false;
		
		}
		
		}
		
		}else{
		
		$this->message = 'B³±d, nie obs³ugiwany format pliku.';
		
		return false;
		
		}
		
		}else{
		
		$this->message;
		
		return false;
		
		}
		
		}else{
		
		$this->message = 'B³êdny parametr "name".';
		
		return false;
		
		}
	
	}
}

?>