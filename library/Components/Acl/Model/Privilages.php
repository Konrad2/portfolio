<?php

class Components_Acl_Model_Privilages extends Zend_Db_Table {
	
	protected $_name = 'acl_privilages';

	public function getAllowRoules(){
		
		$select = $this->select(Zend_Db_Table_Abstract::SELECT_WITH_FROM_PART);
		$select->setIntegrityCheck(false);
		
		$select->joinLeft('acl_resources','acl_resources.id_resource = acl_privilages.id_resource')
			->joinLeft('acl_roles','acl_roles.id_role = acl_privilages.id_role');		
		
		return	$this->fetchAll($select);
	}
	
}

