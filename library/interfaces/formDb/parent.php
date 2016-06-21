<?php
/**
 * 
 * 
 * G��wna r�rznica(narazie jedyna) polega na morzliwo�ci tworzeniu struktury z elem�t�w innych modu��w.
 * @author Konrad
 * @package FormDb
 */
interface interfaces_formDb_parent {
	/**
	* Zapewnia komunikacje z systemem (factory)- build odwo�uje si� do systemu a system korzysta z factory i zwraca strukt�r� elem�t�w.
	* @param param
	* @return 
	*/
	public function build( Class_param  $param );	
}

?>