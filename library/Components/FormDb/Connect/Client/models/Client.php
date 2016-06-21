<?php

/**
 * Tabela powinna zawiera� kolumn� exist (bool). W przeciwnym wypadku nalerzy nadpisa� procedur� delete.
 * @author Konrad
 * @package FormDb
 */

class  FormDb_Connect_Client_models_Client extends FormDb_Connect_models_aConnect {	
	
	
	public function doUpdate( $row = null, $data = null, $values = null, $foreignKey = null ) {		

		
		$valueForeignKey = Class_array::getValue( $data, $foreignKey );
		
		
		
			//ToDo je�li nie znajdzie to si� wysypie
			$newRow = $this->find( $valueForeignKey )->current();
			
			if ( $newRow !== null )	{
				
				
				foreach ( $newRow->toArray() as $key => $v ) {
				
						$data['exist'] = 1;
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
	
	
public function doInsert($row = null, $data = null, $values = null, $foreignKey = null) {		

		
		//if ( !isset($data[$foreignKey]) ){
		$valueForeignKey= Class_array::getValue( $data, $foreignKey );
		
		//var_dump($valueForeignKey);
		
		if ( $valueForeignKey === null ) {
		
			
			$newRow = $this->createRow();
		
			foreach ( $newRow->toArray() as $key => $v ) {
			
			//$newRow[$key] = $data[$key];
				$newRow[ $key ] = Class_array::getValue( $data, $key );
			
			//var_dump($newRow[$key]);
			//$data[$foreignKey] = $newRow->save();
			//$row[$foreignKey] = $newRow->save();
				$valueForeignKey = $newRow->save();
				
			}
			
			
		} else {
			
			
			$query = $this->select()->from( $this->_name, 'count(*)as count' );
			
			//$query->where( $this->getAdapter()->quoteInto('id = ?', $data[$foreignKey] )) ;// $foreignKey]) );
			$query->where( $this->getAdapter()->quoteInto( 'id = ?', $valueForeignKey ) ) ;// $foreignKey]) );
	
			$newRow = $this->fetchRow( $query );
			
			if ( $newRow['count'] != 1 )
			
				throw new Exception( 'nie mo�na powiaza� '.$foreignKey.' z tabel�' );				
		}

		$row[ $foreignKey ] = $valueForeignKey;	

		$row->save();

		
		return $row;
		
	}	

}