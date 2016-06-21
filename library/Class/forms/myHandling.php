<?php

/** 
 * @author Konrad
 * @package Form 
 */
class Class_forms_myHandling {

	/**
	 * Tworzy element select.
	 * @param $array Tablica tablic duwymiarowych. Elementy do selecta. Tablica nie mo�e by� pusta.
	 * @param string $label Pod jakim tytu�em wy �wietli si� select.
	 *  
	 * @return Zend_Form_Element_Select z danymi wo wyboru wprowadzonymi z tabeli bazy danych. W przypadku braku wierszy zwraca null.
	 * @assert-in count($array) > 0.
	 * @assert-out !empty
	 */
	public static function createSelect($array, $name, $fFirstEmpty = true){
		
			$sel= new Zend_Form_Element_Select( $name );
			
			// Zapewnia kontrakt
                        
                        if( $fFirstEmpty ){
                            $sel->addMultiOption('',null);
                        }
                        
			foreach($array as $r)
			{
				$sel->addMultiOption(array_shift($r), array_shift($r));
			}
		
		return $sel;
	}
	
	
	/**
	 * tworzy tablic� checkBox-ow.
	 * @param array $array klucze zostaj� labelami a warto�ci name.
	 */
	public static function createCheckBox($array){
	
			$r = array();
			
			foreach($array as $k=>$v)		
			{				
				$n = new Zend_Form_Element_Checkbox( (string) $k );	
				$n->setLabel( $v );
				$r[] = $n;
			}

		return $r;
	}
	
	/**
	 * Tworzy element multiCheckBox.
	 * @param array $array klucze zostaj� labelami a warto�ci name.
	 * @return Zend_Form_Element_MultiCheckbox 
	 */
	public static function createMultiCheckBox($array,$name){		
			
			/*$r = array();
			foreach($array as $k=>$v)
			{				
				$n = ( (string) $k );	
				$n->setLabel( $v );
				$r[] = $n;
			}
			*/
			$c = new Zend_Form_Element_MultiCheckbox($name, array ( 
				 'multiOptions'=>$array
			));

		return $c;
	}
	
	public static function createRadio($array){
	
			$n = new Zend_Form_Element_Radio( 'dsafsad','dsaf');
			
			foreach($array as $k=>$v)		
			{	
				$n->addMultiOption($k,$v);		
			//	$n->setValue( (string)$k );				
				//$n->setLabel( $v );
				
				
			}

		return $n;
	}
}
?>