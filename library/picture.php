<?php

	function addPicture()
   	{
   		$f = new Zend_Session_Namespace();	
		$count = count($_FILES);
						
		if ( $count > 0 )
		{		
							
			$folder = '';
			do
			{$folder = '';
				for ( $j = 0; $j < 5; $j++)
				{
					$folder .= chr(rand(65,90));
				}					
			}
			while( is_dir('images/foto/temp/'.$folder));
													
			$f->temp = $folder;
			
			//powinno byc create dir
			if (mkdir('images/foto/temp/'.$folder))
				
				
			for ( $i = 1; $i <= $count; $i++ )
			{
			try
			{
				$FileName = 'file_'.$i;					
			    $plik_nazwa = $_FILES[$FileName]['name'];
			   
				$rozszerzenia_tab = array("jpg","JPG","jpeg","JPEG", "JPE", "jpg"); // deklarujemy dozwolone rozszerzenia
					//$ext = strlower(substr($plik_nazwa,strrpos($plik_nazwa,'.')+1)); //Zamieniamy duże litery na male, i wycinamy ciag znaków po ostatniej kropce
				  $ext = strtolower(substr($plik_nazwa,strrpos($plik_nazwa,'.')+1));
								
				if(in_array($ext,$rozszerzenia_tab))
				{ 		
					$typy_mime = array("image/jpg","image/jpeg","image/jpe","image/JPG","image/JPEG","image/JPE","image/pjpeg"); //deklaracja poprawnych typow MIME
					$plik_mime = $_FILES[$FileName]['type']; //pobranie typu MIME z pliku
					if(in_array($plik_mime,$typy_mime))
					{		
						//$old_error_handler = set_error_handler("myErrorHandler");		
						$image = @getimagesize($_FILES[$FileName]['tmp_name']); // użycie funkcji
						if ($image)
						{
							if(is_array($image) && $image[0] > 4)
							{ // sprawdzanie, czy to co zwróciła funkcja jest tablicą, i czy 1 element ma jakąś wartośc, np 4
									
								$plik_tmp = $_FILES[$FileName]['tmp_name'];
								$plik_nazwa = $_FILES[$FileName]['name'];
								$plik_rozmiar = $_FILES[$FileName]['size'];
													
								if ( $plik_rozmiar < 2008576)
								{
									if(is_uploaded_file($plik_tmp))
									{										
										//	$p = '';
										//	do
										//	{
										//		$p = rand(0,1000);
										//	}
											//while( is_file('public/images/foto/temp/'.$folder.'/'.$p.'.jpg'));
										    // move_uploaded_file($plik_tmp, $this->basedURL+"/public/images/temp");
											
									   if( move_uploaded_file($plik_tmp,'images/foto/temp/'.$folder.'/'.$i.'.jpg' ))
									   {
											//przeskaluj 
											
											$img = imagecreatefromjpeg('images/foto/temp/'.$folder.'/'.$i.'.jpg');
											
										    $x = imagesx($img);
										    $y = imagesy($img);
											
											$size = 600;
											
											if ( ($x > $size) || ($y > $size) )			
											{											
												$new_img = resize('images/foto/temp/'.$folder.'/'.$i.'.jpg',$size);		
												unlink('images/foto/temp/'.$folder.'/'.$i.'.jpg');
												imagejpeg($new_img, 'images/foto/temp/'.$folder.'/'.$i.'.jpg', 70);											
											}										
										    //tworzy miniaturkę
									  
											$minSize = 180;
			   								$new_img = resize('images/foto/temp/'.$folder.'/'.$i.'.jpg', $minSize);		
											
						   		    	 	imagejpeg($new_img, 'images/foto/temp/'.$folder.'/m_'.$i.'.jpg', 20);
											    	// return true;
								   		}
								   		else					   		
								   		{//można obsługe błędów
											    return 'Plik nie został zapisany';
										}
									}
									else
									{
										
										 return "Plik: <strong>$plik_nazwa</strong> o rozmiarze 
										    <strong>$plik_rozmiar bajtów</strong> nie został przesłany na serwer!";
									}
								}
								else 
								{
									return "Plik nie może byc więkrzy niż 2mb";
									//throw new Exception("Niepoprawana wielkość pliku");
								}
	 
								
								}
								else
								{
									return "Nieprawidłowy plik";
									// throw new Exception("Plik nie jest obrazkiem");
								}	
						}
						else
						{
							return "Nieprawidłowy plik";
							//throw new Exception("błąt: getsize");
						}
						

							
						
						}											
						else
						{// die("Zły typ MIME");
							return "Nieprawidłowy plik";
						   //throw new Exception('Zły typ MIME');
						}
				
					
					}
					else
					{
						return ('niepoprawny format pliku');
						//throw new Exception('niepoprawny format pliku');						 
					}
			}			
			catch (Exception $e)
			{
			//dziennik błędów zapisać błąd do pliku
				
				echo 'zdjęcie '.$i.'nie zostało dodane';
				echo $e->getMessage();		
			}			
			
		}
		}							
}
	
	
	function savePicrures($dir)
	{//$folder = '';
	$f = new Zend_Session_Namespace(); 
				if (isset($f->temp))
				{
					if (!empty($f->temp))
					{
						if ( is_dir('images/foto/temp/'.$f->temp) )
						{						
							$tempDir = 'images/foto/temp/'.$f->temp;
							$curDir = 'images/foto/'.$dir;
							$od = opendir('images/foto/temp/'.$f->temp);
								
							
											
						   if ( !is_dir($curDir) )
						   { 	
						   		mkdir($curDir);
								
						   }					
							
						
						    
						    while($file_name = readdir($od))
							{
								
							    if( ( $file_name != "." ) && ( $file_name != ".." ) )
							    {	
							    	if ( ( ($file_name == "1.jpg") && (!file_exists('images/foto/'.$dir.'/1.jpg')) )|| ( ($file_name == "m_1.jpg")&&(!file_exists('images/foto/'.$dir.'/m_1.jpg'))));
							    	else
							    	{	// bez testow
								    	$pom = makePictureName('images/foto/temp/'.$f->temp);
								    	//obejscie pr.
										if (file_exists('images/foto/temp/'.$f->temp.'/'.$file_name))
										{
											rename('images/foto/temp/'.$f->temp.'/'.$file_name, 'images/foto/temp/'.$f->temp.'/'.$pom);
											rename('images/foto/temp/'.$f->temp.'/m_'.$file_name,'images/foto/'.$dir.'/m_'.$pom);
											$file_name = $pom;							  
										}
							    	}
									
										
						
									if (file_exists('images/foto/temp/'.$f->temp.'/'.$file_name))
									{
										
						
								    	$img = imagecreatefromjpeg('images/foto/temp/'.$f->temp.'/'.$file_name);
								    								    									        				        	
								      	imagejpeg($img, 'images/foto/'.$dir.'/'.$file_name, 90);							      	
								      	//------------------------------------
								      //	header("Content-type: image/jpeg");
	  								//	imagejpeg($img,'',85);
										
								      	//-------------------------------------
								      	imagedestroy($img);
								      	unlink('images/foto/temp/'.$f->temp.'/'.$file_name);
									}
								}
							} 	  	
							rmdir('images/foto/temp/'.$f->temp);
													
						   	$f->temp = '';				
						}
					}
				}
	}
	
//powinien być przekazany parametr
	function tempDel()
	{
			 $f = new Zend_Session_Namespace();
				if (isset($f->temp) )
				{
					if(!empty($f->temp))
					{
						if (is_dir('images/foto/temp/'.$f->temp))
						{
							$dir=opendir('images/foto/temp/'.$f->temp);
							while($file_name=readdir($dir))
						    {
						    if(($file_name!=".")&&($file_name!=".."))
						        {					        
						        	unlink('images/foto/temp/'.$f->temp.'/'.$file_name);
						        }
						    } 
						
							rmdir('images/foto/temp/'.$f->temp);
							$f->dir = '';
						}
					}
				}			
	}
	
	function picDel($dir, $file)
	{				
			unlink('images/foto/'.$dir.'/'.$file);			
			$file = 'm_'.$file;
			unlink('images/foto/'.$dir.'/'.$file);					
	}
	
	function setAsMain($id,$pictureName)
	{
		$path = 'images/foto/'.$id.'/';
		
		if (file_exists($path.$pictureName))
		{		
			$new = makePictureName($path);	
			
			if ( file_exists($path.'1.jpg'))
			{
				$img = imagecreatefromjpeg($path.'1.jpg');
				unlink($path.'1.jpg');
				imagejpeg($img, $path.$new, 90);
				imagedestroy($img);
			}
			if ( file_exists($path.'m_1.jpg'))
			{
				$img = imagecreatefromjpeg($path.'m_1.jpg');
				unlink($path.'m_1.jpg');
				imagejpeg($img, $path.'m_'.$new, 40);
				imagedestroy($img);
			}			
			
				rename($path.$pictureName, $path.'1.jpg');
			
				rename($path.'m_'.$pictureName, $path.'m_1.jpg');
							
		}
		else
		{
			echo "zdjecie nie istnieje";
			//nieprawidlowy katalig
		}		
	}
	
	function makePictureName($path)
	{
		$pom = '';
		do
	  	{
	  		$pom  = rand(2,100);
	   		$pom .= '.jpg';
	   	}while(file_exists($path.'/'.$pom));
		
		return $pom;
	}
	function myErrorHandler($errno, $errstr, $errfile, $errline)
	{
		echo $errno;
	}
	
	function resize ($path, $size)
	{
		$img = imagecreatefromjpeg($path);
		
		$x = imagesx($img);
		$y = imagesy($img);
															   
		if($x > $y)
		{
		    $nx = $size;
		    $ny = $size * ($y / $x);
		}
		elseif($x < $y)
		{
		    $nx = $size * ($x / $y);
		    $ny = $size;
		}
		else
		{
		    $nx = $size;
		    $ny = $size;
		}
		
		$new_img = imagecreatetruecolor($nx, $ny);
		imagecopyresampled($new_img, $img, 0, 0, 0, 0, $nx, $ny, $x, $y);
		return $new_img;
	}

?>