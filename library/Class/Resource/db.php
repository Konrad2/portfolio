<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_Resource_db extends Zend_Application_Resource_ResourceAbstract {
	
	public function init(){	
		
		$config = new Zend_Config_Xml('../application/config/config.xml', 'general');
					
		$a = $config->db->adapter;
		$t = $config->db->config->toArray();
		unset($t['params']);
		
		 $pdoParams = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8;');
		$t['driver_options'] = $pdoParams;
		 
		$db = Zend_Db::factory($config->db->adapter,$t);
		Zend_Db_Table_Abstract::setDefaultAdapter($db); 		
		Zend_Db_Table::setDefaultAdapter($db);

		
		Zend_Registry::set('adapter', $db);
		
	}

}

?>