<?php
/**
 * provides function for using class by factory class especially doInsert metod
 * @author Konrad
 * @package Factory
 */
abstract class abstract_factoryModelClient extends Zend_Db_Table implements interfaces_factory_client
{
	private $key;
	public $parent;
 	public $reference_map;
 	private $child;
	
 	/*
	public function makeOrder($where)
	{
		
		if (!isset($this->_col[$this->key]))
		{
			$this->makeCol();
		}
		
		$this->update($data,$where);

		if ($this->child != null)
			$this->chile->makeorder($where);
	
	}
	*/
 	
 	
 	/**
 	 * add class to structure
 	 */
 	public function add ($child)
 	{
 		if ($this->child == null )
 		{
 			$this->child = $child;
 		}
 		else 
 		{
 			$this->child->add($child);
 		}
 		
 	}
 	
 	/**
 	 * disable metod, this metchod do notching becouse is't need get element. is only use doInsert metod 
 	 */
 	public function get()
 	{
 		
 	}
 	
 	/**
 	 * this fynction shout be rewrite in child by its own insert to table in database. To use this metod is needed to pase row from main 
 	 * model, and date for example from Zend_Form and insert in row apriopriate column
 	 * shout olsow call parent metod by call parent::doInsert($parent,$data);
 	 */
 	public function doInsert($parent, $data)
 	{
 		if ($this->child != null)
 		{
 			$this->child->doInsert($parent, $data);
 		}
 	}
	
 	/**
 	 * create column not need 
 	 */
	private function makeCol()
	{
		$s = $this->select();
		$s = 'alter'.$this->_name.'column'.$this->key.' int (20)' ;
		$this->fetchAll($s);
	}
}

?>