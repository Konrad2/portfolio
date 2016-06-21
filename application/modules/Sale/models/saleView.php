<?php 

/** 
 * @author Konrad
 * @package Sale
 */
class saleView extends abstract_viewModel //View Zend_Db_Table  //implements iViewM 
{
	protected $_name = 'order';
	protected $_dependentTables = array('orderThings');	
	
	protected $_referenceMap    = array(
        'status' => array(
            'columns'           => 'id_status',
            'refTableClass'     => 'status',
            'refColumns'        => 'id'
        ));
        
	/*
	public function __construct()
	{
		$ns = new Zend_Session_Namespace('db');
		//,"shortDescription"=>"Opis","description","details","enable");
		
		parent::__construct($ns->db);
	}
	*/
	
	//public function getSelect()
	public function getSelect($select = null)
	{
		$s = $this->select();
		$s->from('order',array('nr. Zamuwienia'=>'order.id','data zamówienia'=>'order.data'));//,'Nazwa'=>'name', 'Cena'=>'price', 'Kod'=>'code', 'Opis'=> 'shortDescription'));
		$s->joinLeft( 'status', 'status.id = order.id_status',array('status') );
		$s->order('data desc');
		//$s->joinLeft( 'things', 'things.id = order.id_thing', array('price') );
//		$s->joinLeft( 'things', 'status.id = order.id_status', array('price') );
		$s->setIntegrityCheck(false);
		return $s;
	}
	
	public function sumOrder($id)
	{	
		$select = $this->select();
		$select->from('things',array(new Zend_Db_Expr('SUM(things.price) as cena')));
		//$select->where('order.id = 6921');
		$select->where($this->getAdapter()->quoteInto('order.id = ?', $id));
		$select->setIntegrityCheck(false);
		
		$select->joinInner('order_things', 'things.id = order_things.things_id');
		$select->joinInner('order', 'order.id = order_things.order_id');
		
		$rowSet = $select->query()->fetchAll();
		
		$rowSet = $this->fetchRow($select);
		
	//	var_dump
		/*
	
		$where = $this->getAdapter()->quoteInto('`order`.`id` = ?', $id);
		
		$ex = new Zend_Db_Expr('(SELECT `things`.`price` 
								FROM `things`
								INNER JOIN `order_things` ON `things`.`id` = `order_things`.`things_id`
								INNER JOIN `order` ON `order`.`id` = `order_things`.`order_id`
								WHERE `order`.`id`=6915'.') '
							);
	
		$ex = new Zend_Db_Expr('(SELECT SUM(`things`.`price`)as price 
								FROM `things`
								INNER JOIN `order_things` ON `things`.`id` = `order_things`.`things_id`
								INNER JOIN `order` ON `order`.`id` = `order_things`.`order_id`
								WHERE'.// `order`.`id`='.$id
								$where
								.')'
							);
				
		$s = $this->select();
	//	$s->from($ex, array('cena'=>'ord.price', 'nr. Zamuwienia'=>'order.id','data zam�wienia'=>'order.data'));
	
		$s->from($ex, array('cena'=>'t.price'));
		//$s->from($ex, array( new Zend_Db_Expr('SUM(t.price) as cena') ));
		$s->setIntegrityCheck(false);	
		
	 	$rowSet = $this->fetchRow($s);
	 	*/
	 	//var_dump($rowSet[0]['cena']);
	 	
	
	 	return $rowSet->cena;
	}
	
	public function getOne($id){

		$select = $this->select();
		$select->from( 'things', array(new Zend_Db_Expr('SUM(things.price) ') ) );
		//$select->from( 'things', array(new Zend_Db_Expr('SUM(things.price)') ) );
		$select->where( $this->getAdapter()->quoteInto('order.id = ?', $id));
		$select->joinInner('order_things', 'things.id = order_things.things_id',null);
		$select->joinInner('order', 'order.id = order_things.order_id', array( '*' ) );
		$select->setIntegrityCheck(false);
		$rowset = $this->fetchAll($select);
		$r = $rowset->current();
		
		$r->setReadOnly(false);
		//$r->save();
///echo $select;

		/*
		$myConfig = new Class_myConfig();
		
		//$col = $myConfig->getRowNamesForOutput($this->_moduleName);
		$col =  $this->getColsRow();
		
		$id = $this->getAdapter()->quoteInto( 'id = ?', $id );
		
		$r = new Zend_Db_Table_Row();
		
		if ( count($col) > 0 ){
			
			$select = $this->select();
			
			//$select->from( $this->_moduleName, $col );
			
			if ($col)
				$select->from( $this->_name, $col );
			else 
				$select->from( $this->_name );
		
			$select->where( $id );
					
			$r = $this->fetchRow($select);

			require_once '../application/modules/sale/models/status.php';
			
			//$status  = $r->findParentRow('status');	
		}
		else
			$r = $this->fetchRow($id);
		*/	
		return $r;
		
	}
	
	/**
	 * @return Zend_Db_Table_Row zwraca wiersz wiele do wielu. 
	 * @param unknown_type $id
	 */
	public function getOne2($id)
	{
		//require('../application/modules/things/models/things.php');
		require('../application/modules/sale/models/orderThings.php');
		
		//$r = parent::fetchRow('id = '.$id);

		//$r = $this->find($id);
		
		//$row= $r->current();	
		
		//$result = $row->findManyToManyRowset('things','orderThings');
		
		$select = $this->select();
		
		$select->from('things');
		
		$select->where($this->getAdapter()->quoteInto('order.id = ?', $id));
			
		$select->joinInner('order_things', 'things.id = order_things.things_id', null);
		
		$select->joinInner('order', 'order.id = order_things.order_id', null);
		
		$select->setIntegrityCheck(false);
		
		$result = $this->fetchAll($select);
		
		
		
		
		return $result;
	}	
	
	public function makeOrder($data,$id_products)
	{
		require('../application/modules/sale/models/order.php');
		require('../application/modules/sale/models/order_things.php');
		require('../application/modules/sale/models/data_to_send.php');

		$ns = new Zend_Session_Namespace('db');

		$t_o = new order_things($ns->db);
		$dts = new data_to_send($ns->db);
		$ord = new order($ns->db);

		$r = $ord->createRow();
		$r->save();
		//echo 'order id='.$r['id'];

		$t_o->addRow($id_products,$r['id']);

		$dts->addRow($data,$r['id']);
	}
	

/*
	public function fetchLimitedRows()
	{
		$s = $this->select();
		$s->from('order',array('id','nr_order'));  //,'Nazwa'=>'name', 'Cena'=>'price', 'Kod'=>'code', 'Opis'=> 'shortDescription'));
				
		$g = new Zend_Session_Namespace('viewAllsale');
			
		if (is_array($g->where))
		{				
			if (  (count($g->where) > 0 ) )
				foreach( $g->where as $t )
					$s->where = $db->quoteInto( $t['co'], $t['data']);									
			else
				$s->where = null;
		}
		else
			$s->where = null;
		
	//$where = $db->quoteInto('noble_title = ?', 'Sir');
	//$order = 'first_name';
	$count = 10;
	$offset = 20;

		//return $this->fetchAll($s,$count,$offset);
		
	//	return parent::fetchRow( $where, null, $count, $offset);

	}
	*/
}
?>