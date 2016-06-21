<?php

/**
 * 
 * @author mijagi
 *
 */

class upload {
	public $rozmiar_max; 
	public $rozszerzenia = array();
	public $typy_mime = array();
	public $nazwa_input;
 
	private $nazwa_tmp;
	private $typ_mime;
	private $nazwa;
	private $rozmiar;
	private $bledy;
 
	public function __construct($rozmiar_max, $rozszerzenia, $typy_mime, $nazwa_input){
		if(isset($_FILES[$nazwa_input]) && is_array($_FILES[$nazwa_input])){
			if(!is_array($_FILES[$nazwa_input]['tmp_name']) && !is_array($_FILES[$nazwa_input]['name']) && !is_array($_FILES[$nazwa_input]['size']) && !is_array($_FILES[$nazwa_input]['error']) && !is_array($_FILES[$nazwa_input]['type'])){
				$this->nazwa_tmp = $_FILES[$nazwa_input]['tmp_name'];
				$this->typ_mime = $_FILES[$nazwa_input]['type'];
				$this->nazwa = $_FILES[$nazwa_input]['name'];
				$this->rozmiar = $_FILES[$nazwa_input]['size'];
				$this->bledy = $_FILES[$nazwa_input]['error'];
			}
 
		}
 
		if($this->sprawdzanie($rozmiar_max) == 1){
			if(is_array($rozszerzenia) && is_array($typy_mime)){
				$znaki = strlen($nazwa_input);
				if($znaki > 1 && $znaki < 5){
					$this->rozmiar_max = $rozmiar_max;
					$this->rozszerzenia = $rozszerzenia;
					$this->typy_mime = $typy_mime;
					$this->nazwa_input = $nazwa_input;
					$this->druk_input($this->ile_plikow);
				}else $this->komunikaty(4);
			}else $this->komunikaty(2);
		}else $this->komunikaty(3);
	} #<- konstruktor, sprawdzenie czy obiekt zostanie poprawnie utworzony
	
	private function sprawdzanie($x){
		if(isset($x)){
			if(is_numeric($x) && is_int($x)){
				return 1;
			}
		}
	} #<- funkcja pomagajaca konstruktorowi sprawdzic poprawnosc danych
	
	private function komunikaty($ktory){
		if(isset($ktory)){
			switch($ktory)
			{
				case 1:
				echo "Brak pliku";
				break;
 
				case 2:
				echo "Bledna wartosc dla rozszerzenia lub mime";
				break;
 
				case 3:
				echo "Bledna wartosc dla rozmiaru";
				break;
 
				case 4:
				echo "Bledna wartosc dla nazwy inputa";
				break;
 
				case 5:
				echo "Pliki o tym rozszerzeniu nie sa dopuszczalne";
				break;
 
				case 6:
				echo "Bledna wartosc zmiennej";
				break;
 
				case 7:
				echo "Zly wybor";
				break;
 
				case 8:
				echo "Plik nie jest obrazkiem";
				break;
 
				default:
				echo "Nieznany blad";
				break;
			}
		}
	} #funkcja drukujaca info o bledzie
	
	private function druk_input($ile){
		echo "<form action=\"\" method=\"POST\" enctype=\"multipart/form-data\">
		<input name=\"$this->nazwa_input\" type=\"file\" /><br />
		<input type=\"radio\" name=\"wybor\" value=\"zdjecie\"/>Fotka 
		<input type=\"radio\" name=\"wybor\" value=\"archiwum\" />Zip/rar<br/>
		<input type=\"submit\" name=\"submit\" value=\"up up!\"/></form>";
	} #funkcja drukujaca formularz
	
	private function rozszerzenie($roz){
		if(!is_array($roz)){
			$ext = substr($roz,strrpos($roz,'.')+1);
			return $ext;
		}
	} #funkcja sprawdzajaca rozszerzenia
	
	private function mimy($mime){
		if(in_array($mime, $this->typy_mime)){
			return 1;
		}
	}#funkcja sprawdzajaca mime
	
	private function wybor($wybor){
		if(!empty($wybor)){
			if(!is_array($wybor)){
				switch($wybor)
				{
					case 'zdjecie':
					return 1;
					break;
 
					case 'archiwum':
					return 2;
					break;
 
					default:
					return 3;
					break;
				}
			}else $this->komunikaty(6);
		}else $this->komunikaty(6);
	} #funkcja odpowiada za poprawnosc przypisania sprawdzania danych do zmiennej wybor
	
	private function rozmiar_pliku($rozmiar){
		if($rozmiar <= $this->rozmiar_max){
			return 1;
		}
	} #funkcja sprawdzajaca rozmiar pliku
	
	private function GD_img($tmp){
		$image = @getimagesize($tmp);
		if(is_array($image) && $image[0] > 2){
			return 1;
		}
	} #sprawdzanie czy obraz jest poprawny w GD
	
	private function zmiana_nazwy($nazwa){
		$nazwa = 'upload/'.md5(time()).'-'.$_SERVER['REMOTE_ADDR'].'-.'.$this->rozszerzenie($this->nazwa);
		return $nazwa;
	} #zmiana nazwy wg. wzoru
	
	private function info($x){
		if($x){
			echo 'Na serwer przeslano plik "'.$this->nazwa.'". O rozmiarze: '.$this->rozmiar.' bajtow.';
		}
	} # drukowanie info, jesli wszystko sie powiodlo
	
	public function up_up(){
		if(isset($_POST['submit']) && !is_array($_POST['submit'])){
			if($this->wybor($_POST['wybor']) < 3){
				if(is_uploaded_file($this->nazwa_tmp)){
					if($this->rozmiar_pliku($this->rozmiar) == 1){
						 if($this->wybor($_POST['wybor']) == 1){
						 	if(in_array($this->rozszerzenie($this->nazwa),$this->rozszerzenia[0])){
						 		if(in_array($this->typ_mime,$this->typy_mime[0])){
						 			if($this->GD_img($this->nazwa_tmp) == 1){
						 				$uped = move_uploaded_file($this->nazwa_tmp, $this->zmiana_nazwy($this->nazwa));
						 				$this->info($uped);
						 			}else echo $this->komunikaty(8);
						 		}else echo $this->komunikaty(2);
						 	}else echo $this->komunikaty(2);
						 }elseif($this->wybor($_POST['wybor']) == 2) {
						 	if(in_array($this->rozszerzenie($this->nazwa),$this->rozszerzenia[1])){
						 		if(in_array($this->typ_mime,$this->typy_mime[1])){
						 			$uped = move_uploaded_file($this->nazwa_tmp, $this->zmiana_nazwy($this->nazwa));
						 			$this->info($uped);
						 		}else echo $this->komunikaty(2);
						 	}else echo $this->komunikaty(2);
						 }
					}else echo $this->komunikaty(2);
				}else $this->komunikaty(1);
			}else $this->komunikaty(6); 
		}
	} #funkcja odpowiadajaca za sprawdzenie danych pliku i upload jesli wszystko gra
		
 
}
 
/* 
$rozmiar = 6291456; #max rozmiar pliku
$nazwa = 'plik'; #nazwa inputa

$roz_fot = array("jpg","png","gif"); #rozszerzenia dla obrazka
$roz_arch = array("zip","rar"); #rozszerzenia dla zip/rar

 
$mime_fot = array("image/gif","image/jpeg","image/png","image/jpg"); #typy mime dla obrazka
$mime_arch = array("application/zip","application/rar","application/x-compressed","application/x-zip-compressed","multipart/x-zip"); #typy mime dla rar/zip

#dalej palcow nie pchaj
$typy_mime = array($mime_fot,$mime_arch);
$rozszerzenia = array($roz_fot,$roz_arch);
$up = new uploadzik($rozmiar,$rozszerzenia,$typy_mime,$nazwa);
$up->up_up();
*/
?>

