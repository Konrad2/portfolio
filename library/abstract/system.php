<?php
/**
 * klasa reprezentuje system. Umo¿liwoia komunikacj midzy modulami
 * @author Nysart
 *
 *
 *system przetrrzymuje w pliku application/config/config.xml informacje na temat poczen midzy moduami
 *mo¿na skojarzyc modu z formularzem w innym moduem np. do skadania zamuwienia
 *aby dodac element formularza do formularza nalerzy przy instalacji modulu dodac nazwe klasy dziedziczacej po abstract_formClient 
 *funkcja build form zwroci skojarzone elemety. jeli skojarzony element umieszcza zamierza umiescic id w tabeli z innego modulu w takiej sytuacji pole formularza powinno sie nazywac tak jak pole tabeli
 *jesli klient robi wpis a nastepnie wstawia id wowczas wymusimy wywolac metode insert(doInsert) w formClient przekazujac mu nowo dodany rekord
 *przy wpisie do bazy 
 *
 */
abstract class abstract_system
{	
	/**
	 * inicjuje alpikacje(sesje) 
	 */
	public static function start()
	{
		
	}
	
	/**
	 * zwraca instancje obiektu dziedziczacej z wrappForm a powinien abstract_formDbClient
	 *przekazywany jest obiekt typu param
	 */	
	public function buildFormDb($param)
	{
		
	}
	
	/**
	 * tworzy obiekt typu abstract_clientModel 
	 * przekazywany jest obiekt typu param
	 */	
	public function build($param)
	{
		
	}
	
	/**
	 * zwraca tablic url do akcji 
	 */	
	public function connectionAction()
	{
		
	}
	
	/**
	 * zwraca obiektów abstract_otherModule 
	 */	
	public function getClass()
	{
		
	}
	
}

?>