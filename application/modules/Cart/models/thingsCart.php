<?php 
class thingsCart extends Zend_Db_Table
{
	protected $_name = 'things';
	protected $cartView= array('NazwaProduktu'=>'name','nr.Produktu'=>'id','Cena'=>'price');
	protected $cartLabel = 'name';

	
	public function init()	{
		
		/* 24-04-2012
		require_once('myLibrary.php');
				
		$this->name = getModName(get_class($this));

		if (file_exists('../application/modules/'.$this->name.'/config.xml'))
		{
			$conf = new Zend_Config_Xml('../application/modules/'.$this->name.'/config.xml','cart');

			$this->cartView = array_scrum($conf->cartView->toArray());
			$this->cartLabel = array_scrum($conf->cartLabel->toArray());
		}
		else 
			throw new Exception('nie odnaleziono pliku config w katalogu modu "../application/modules/'.$this->name.'/config.xml"');
			*/
	}

	public function getCartView($ids)
	{
		$rowset = array();
		$s = $this->select();
		
		foreach($ids as $id)
		{
			$s->from($this->_name,$this->cartView);
			array_push($rowset, $this->fetchRow( $s->where('id = ?', $id )));
			$s->reset();	
		}
	
		return $rowset;
	
	/*
		$array = array();
		$s = $this->select();
		$s->from($this->_name,$this->cartView);

		if ( ( isset($ids) ) && ( !empty($ids) )&& ( is_array($ids))  )
		{
			$c = count($ids);

			if ($c >= 0)
			{
				//$this->select()->where($this->getAdapter()->quoteInto('id = ?',$aid[0]));
				$s->where($this->getAdapter()->quoteInto('id = ?',$ids[0]));

				for($i = 1; $i < $c; $i++)
				{
					$s->orWhere($this->getAdapter()->quoteInto('id = ?',$ids[$i]));
				}
			}
			 echo " speania warunek<br />";
			return $this->fetchAll($s);
		}
	*/
	}

	public function getLabel($ids)
	{
		$rowset = array();
		$s = $this->select();
		
		foreach($ids as $id)
		{
			$s->from($this->_name,$this->cartLabel);
			array_push($rowset, $this->fetchRow( $s->where('id = ?', $id )));
			$s->reset();	
		}
	
		return $rowset;
	}
	
	public function isEnable($id)
	{
		$s = $this->select();
		$s->where($this->_db->quoteInto('id =?',$id));
		$s->where('enable = 1');
		
		$row = $this->fetchRow($s);
		
			
		return ($row)? true : false;
	}
	
	public function getSumPrice($ids)
	{
	
	}
}

?>