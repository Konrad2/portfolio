<?php
/**
 * 
 * 
 * @author Konrad
 *
 */
class accountSearcher extends abstract_Search_OneCriterion {
	
	
	public function select() {
				
		
		$select = new Zend_Db_Select( Zend_Db_Table::getDefaultAdapter() );
				
		$p = $this->getParams();
		
		
		if ( count ( $p ) > 0 )	{			
		
			
			$param = array_shift( $p );
			

			switch ( $param ) {
				
				
				case 'clients':
					
					$select->where( 'account.id_privilege = 1' );
					
					break;
					

				case 'employers':
					
					$select->where( 'account.id_privilege > 1' );
					
					break;
					

				default:
					throw new Exception("Nie prawidowy parametr(accountSearcher, select())");
					
					
			}
			
			
			//$select->from('account',null);
			$select->from( null ,null);

			
		} else {
			
			
			//$select->from( 'account' , null );
			$select->from( null , null );
			
		}

		
		
		return $select;
		
	}
	
	
}

?>