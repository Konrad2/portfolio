<?php

/** 
 * Baza wyj�ciowa moich wyj�tk�w.
 * @author Konrad
 * 
 */
abstract class Class_Exceptions_exception extends Exception {

	public function handle(){
		
		//TODO Zapis do pliku. Ewentualnie w konstruktorze.		
		return;
	}
	
	
}

?>