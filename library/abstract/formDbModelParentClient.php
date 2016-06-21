<?php

/** 
 * 
 * Jest to klasa ktura reprezentuje po�aczenie z modelem typu wiele do jednego.
 * Przes�onieta jest metoda do doInsert ktura jedynie wstawia do rekordu z g��wnej tabeli id.
 * Nalerzy zdefiniowa� w�a�ciwo�� foreignKey podaj�c klucz obcy pod jakim ma by� wstawione id. 
 * @author KOnrad
 * @package FormDb
 * 
 */
abstract class formDbModelParentClient extends abstract_formDbModelClient {
	
	public function doInsert(){

		if ( !isset($data[$foreignKey]) )
		{// tworzy rekord i zapisuje id
			$newRow = $this->createRow();
		
			$pom = array();
			//foreach ($newRow->toArray() as $key => $v){
			foreach ($newRow->toArray() as $key => $v){
				//throw new Exception('jest ');
				$pom[$key] = $data[$key];			
			}
			
			$newRow->setFromArray($pom);
			$data[$foreignKey] = $newRow->save();
			/*foreach ($newRow->toArray() as $key => $v){

			$newRow[$key] = $data[$key];
			$data[$foreignKey] = $newRow->save();
			}
			*/
		}
		else
		{//
			$query = $this->select()->from($this->_name, 'count(*)as count');
			
			$query->where( $this->getAdapter()->quoteInto('id = ?', $data[$foreignKey] )) ;// $foreignKey]) );
	
			$newRow = $this->fetchRow($query);
			
			if( $newRow['count'] != 1 )
				throw new Exception('nie mo�na powiaza� '.$foreignKey.' z tabel�');
			else
			{
				
			}
		}
	}

}

?>