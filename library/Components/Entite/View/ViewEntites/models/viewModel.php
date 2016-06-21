<?php
/**
 * Klasa abstrakcyjna niezbedna do kontrolera dziedziczcedo po abstract_viewController
 *
 * klase nalerzy umiescic w kataogu models o nazwie nazwa moduo+View.php.
 * Je�li chcemy wywietlac  z bazy danych wed�ug
 * jakiego� kryterum, nalerzy odpowiednio zmodyfikowa
 * select, nast�pnie je zwr�ci�.
 * @author Konrad
 * @package View
 * @package Entite
 * 
 * @todo rozdzielić modele entite oraz entites. W konstruktorze entites podmienić atrybut viewModel.
 */
										
 class ViewEntites_models_viewModel extends ViewEntite_models_viewModel {

 	
 	
	/**
	 * Chc�c wy�wietli� informacje w innym module modu� musi zna� klucz obcy wed�ug kturego b�dziemy si� odwo�ywa�:
	 * setForeignKey() klucz obcy z innego modu�u.
	
	
	public function init(){}
	
	 */
	/**
	 * 
	 * Zwraca obiekt typu Zend_Db_Select do paginatora.
	 * 
	 * @return Zend_Db_Select
	 *  
	 * @param array $select Zend_Db_Table_Select
	 * 
	 */
	
	public function getSelect(  $select = null ) {
		
	
		if ($select === null) {
			
			$select = $this->select();
			
		}		
		
		$select->where( $this->_name . '.exist = 1' );
		
		
		return $select;		
		
	}

		
	/**
	 * @todo ciekawe czy pojeszcze potrzebne.
	 * @param unknown_type $key
	 */
	/*
	public function setForeignKey( $key ) {

		$this->foreignKey = $key;
	}
	*/
	
	
	
	
	
	
	/**
	 * Urzywana przez getSelect().
	 * Funkca domy�lnie zwraca false. Chc�c zdefiniowa� nazwy pod jakimi maj� sie wy�wietla� dane z tabeli, nalerzy zwr�ci� tablic� z kluczami jako nazwy tabeli oraz warto�ciami jako nazwy wy�wietlane.
	 * Tablica Mo�e wy� podstawiana do funkcji $select->from
	 * @return Nazwy kolumn tabeli zwracanej do metody viewController->viewallAction(). 
	 
	
	protected function getCol() {
		
		return false;
	}
	*/
	
	
	/**
	 * Definicja kolumn jakie maj� si� pojawi� poprzez funkcje viewlabel
	 * @return array tablica nazw kolumn oraz nazwy pod jakimi maj� si� wy�wietla�. domy�lnie false czyli pobrane zostanie wszystko. 
	
	
	protected function customCol() {
		
		return null;
	}
	 */
	
	
	/**
	 * @return Zwraca nazwe tabeli.
	
	
	public function getName() {

		return $this->_name;
		
	}
	
	 */
	
}
?>