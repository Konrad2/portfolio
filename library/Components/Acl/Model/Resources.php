<?php

class Components_Acl_Model_Resources extends Zend_Db_Table {

	protected $_name = 'acl_resources';
	
	
	public function getAllowRoles( $resourceName ){
		
		$select = $this->select();
		$select->joinleft('acl_roles','acl_resources.id_resource = acl_roles.id_resource');
		//$select->where('');
		
		$this->fertchAll($select);
	}
	
}

?>