<?php

class Components_Acl_Model_Roles  extends Zend_Db_Table {

	protected $_name = 'acl_roles';
	
	public function getRoles(){
		
		$select = $this->select();
		
		$select->from($this->_name, array ('acl_roles.role' , 'ancestor' => 's.role') );
		$select->joinleft(array( 's'=>$this->_name),'s.id_role = '.$this->_name.'.ancestor',array());
		$select->order('acl_roles.id_role');	
		return $this->fetchAll($select);
	}

}
