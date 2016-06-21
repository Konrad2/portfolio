<?php

/**
 * Tabela powinna zawiera� kolumn� exist (bool). W przeciwnym wypadku nalerzy nadpisa� procedur� delete.
 * @author Konrad
 * @package FormDb
 */
abstract class abstract_formDbModelClient extends Zend_Db_Table implements interfaces_formDb_model {	
	
	
	/**
	 * Ustawia na false rekordy(Usuwa).
	 * Tabela powinna zawierać kolumn� exist (bool). W przeciwnym wypadku nalerzy nadpisa� procedur� delete.
	 */
	public function delete( $id ) {

		
		$where = $this->getAdapter()->quoteInto('id =?',$id );
		
		
		$rowset = $this->find($id);
		
		$depRow = $rowset->current();
					
		$depRow->exist = 0;
		
		$depRow->save();
		
	}
		
	
	/**
	 * @return Zend_Db_Table_Row  zwraca wartości z podanej kolumny.
	 * @param string $foreignKey nazwa klucza obcego w tabeli od kturego prowarzi referencja.	
	 */
	public function  getNames($colName) {
		
		
		$select = $this->select();

		$select->from( $this->_name );
		
		$select->columns( $colName );
		
		$result =  $this->fetchAll( $select );
		
		
		return $result;
		
	}
	
	
	
	public function doInsert($row = null, $data = null, $values = null, $foreignKey = null) {		

		$valueForeignKey= Class_array::getValue( $data, $foreignKey );

                // if is primary key
		if ( $valueForeignKey === null ) {
		
			
			$newRow = $this->createRow();
		
			foreach ( $newRow->toArray() as $key => $v ) {
			
			
				$newRow[ $key ] = Class_array::getValue( $data, $key );
			
			
				$valueForeignKey = $newRow->save();
				
			}
			
			
		} else {
			
			
			$query = $this->select()->from( $this->_name, 'count(*)as count' );
			
			//$query->where( $this->getAdapter()->quoteInto('id = ?', $data[$foreignKey] )) ;// $foreignKey]) );
			$query->where( $this->getAdapter()->quoteInto( 'id = ?', $valueForeignKey ) ) ;// $foreignKey]) );
	
			$newRow = $this->fetchRow( $query );
			
			if ( $newRow['count'] != 1 ){
                    
				throw new Exception( 'Nie można powiazać '.$foreignKey.' z tabelą ' . $this->_name  );
                                
                        }
				
				
		}

		$row[ $foreignKey ] = $valueForeignKey;	

		$row->save();

		
		return $row;
		
	}
	
	
	
	public function doUpdate( $row = null, $data = null, $values = null, $foreignKey = null ) {		

		
		$valueForeignKey = Class_array::getValue( $data, $foreignKey );
		
		
		
			//ToDo je�li nie znajdzie to si� wysypie
			$newRow = $this->find( $valueForeignKey )->current();
			
			if ( $newRow !== null )	{
				
				
				foreach ( $newRow->toArray() as $key => $v ) {
			
					
						$newRow[ $key ] = Class_array::getValue($data,$key);
						
				}
				
				
				$newRow->save();
				
				
			} else 
			
				$this->doInsert( $row, $data, $values, $foreignKey );
			 
					//throw new Exception('nie mo�na odnale�� rekordu podrz�dnego podczas aktualizacji');
		//}
	//	else
	//	{
		/*$query = $this->select()->from($this->_name, 'count(*)as count');

			$query->where( $this->getAdapter()->quoteInto('id = ?', $valueForeignKey )) ;// $foreignKey]) );

			//$newRow = $this->fetchRow($query);
			//$newRow = $this->find($query);

			if( $newRow['count'] != 1 )
				throw new Exception('nie mo�na powiaza� '.$foreignKey.' z tabel�');
	//	}
*/
		//$row[$foreignKey] = $valueForeignKey;

	//	$row->update();

		return $row;
		
	}
	
}

?>