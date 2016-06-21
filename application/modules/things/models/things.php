<?php
/**
 * Klasa
 * @author Konrad
 * @package Things
 */
class things extends abstract_formDbModelParent
{
	private $choosenKeys;
	
	protected $_dependentTables = array('orderThings');
	/*
	protected $_referenceMap    = array(
        
        'orderThings' => array(
            'columns'           => array('id'),
            'refTableClass'     => 'orderThings',
            'refColumns'        => array('things_id')
        )
    );
	*/		 	
	public function __construct()
	{
		$ns = new Zend_Session_Namespace('db');
		//,"shortDescription"=>"Opis","description","details","enable");
		
		parent::__construct($ns->db);
	}
	
	public function init()
	{
		$this->choosenKeys = array("Nazwa Produktu"=>"name","price"=>"Cena","code"=>"Kod produktu");
	}
	
	public function getEnableThing($id, $array)
	{		
		$where = $this->getAdapter()->quoteInto('id = ?',$id);
   
		$array = $this->fetchRow($where);
		
		//echo $array->name;
		if (empty($array))
			return "produkt niedostempny";
		else 
			return null;		
			
			
	//$rowset = $bugs->fetchAll($bugs->select()->where('bug_status = ?', 1));
	//$row = $rowset->current();

	}
	/*				
	public function getChoosenKeys()
	{
		foreach ($this->choosenKeys as $k)
		// echo $k;
		 
		return $this->choosenKeys;
	}
	*/
	public function getShortOutput($aid) 
	{
		$array = array();
		$s = $this->select();
		$s->from('things',array('id','Nazwa'=>'name', 'Cena'=>'price', 'Kod'=>'code', 'Opis'=> 'shortDescription'));
		
		if (isset($aid)&&!empty($aid)&&is_array($aid))
		{
			$c = count($aid);		
			
			if ($c >= 0)
			{
				//$this->select()->where($this->getAdapter()->quoteInto('id = ?',$aid[0]));
				$s->where($this->getAdapter()->quoteInto('id = ?',$aid[0]));
				
				for($i = 1; $i < $c; $i++)
				{			
					//$this->select()->orWhere( $this->getAdapter()->quoteInto('id = ?',$aid[$i]));
					$s->orWhere($this->getAdapter()->quoteInto('id = ?',$aid[$i]));
					//$s->orWhere('id = ?',$aid[$i]);
				}
		      //. 'AND enable = 1';				
			}			
		//	echo $s;
			$array = $this->fetchAll($s);		
		}		
//	echo '<br/>rekordów '.count($array).'<br/>';
		if (count($array))
			return $array->toArray();
		else
			return array();
	}
	
	public function getOutput($aid) 
	{			
		$array = array();
			
		if (isset($aid)&&!empty($aid)&&is_array($aid))
		{
			$c = count($aid);
		
			
			$this->where = $this->getAdapter()->quoteInto('id = ?',$aid[0]);
			
			if ($c >= 1)
			{				
				for($i = 1; $i < $c; $i++)
				{
					//$this->where .= $this->getAdapter()->quoteInto('or id = ?',$id);
					$this->where .= $this->getAdapter()->quoteInto('or id = ?',$aid[$i]);
				}
		      //. 'AND enable = 1';
				
				$array = $this->fetchRow($where);
			}	
		}
	
		if (empty($array))
			return "produkt niedostempny";
		else
			return null;
	}
	
	public function getKeys()
	{
		return $this->_col;
	}
	
	public function doUpdate($row = null, $data = null, $values = null , $foreignKey = null){
		
	
		$temp = $this->_dependentTables;
		$this->_dependentTables = null;
		parent:: doUpdate($row , $data, $values, $foreignKey);
		
		$this->_dependentTables = $temp;
	}
	

	
}
?>