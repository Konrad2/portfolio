<?php
abstract class abstract_formDbClient extends Zend_Form implements interfaces_factoryClient
{
	private $child;
	private $model;

	public function add($child){
		
		if ($this->child != null){
			$this->child->add($child);
		}
		else 
			$this->child = $child;
	}

	/**
	 * zwraca obiekt Zend_Form
	 * wywouje rekurencyjnie get u dziecka nastpnie pobiera elementy i tworzy jeden wspólny formularz
	 */
	public function get(){
		
		if(isset($this->child))
		{
			$form = $this->child->get();	
			
			$fo = $this->getElements();
			
			foreach ($fo as $elem)
				$form->addElement($elem);
			
				
			return $form;
		}
		else
			return $this;

	}

	
	/**
	 * funkcji urzywamy przy globalnym wywoaniu
	 * @param array $params somthing additional need to insert data
	 */
	/*				
	public function insert($params=null){
			echo "u lalala";
	}
	*/
	/**
	 * tam metoda odpowiada za kontakt z modelem czyli odpowie wprowadzenie danych 
	 * Warzne! nadpisujc t metod pamitaj o wywooniu metody rodzica parent::doInsert($param,$data);
	*/
	public function insert($row = null, $data){
	
		if($this->child != null){
			 $this->doInsert($row, $data);
		}
		else 
			return true;
	}
	
}