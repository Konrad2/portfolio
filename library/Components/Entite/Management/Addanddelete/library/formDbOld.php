<?php
/**
 * 
 * @author Konrad
 * @package Management
 * @subpackage formDbOld
 */
class Addanddelete_library_formDb extends abstract_formDbParent {
/*
	public function __construct()
	{
		echo "constructor formDbOld now<br/>";
		parent::__construct();			
	}
*/
	protected $_tableName ;
	
	
	/**
	 * Ustawia nazwe tabeli 
	 * @param unknown_type $name
	 */
	
	public function setTableName( $name ) {		
				
		$this->_tableName = $name;		
	}
	
	/**
	 * inicjuje obiekt 
	 */
	public function init() {
		//$db->query('SET NAMES utf8'); 
		
	
		
		//$this->patchToModel = '../application/modules/things/models/thingsFormModParent.php';
		$this->patchToModel = '../application/library/Components/Entite/Management/Addanddelete/models/formDbParent.php';
		
		$this->modelName = 'formDbParent';
	
		
		$name = new Zend_Form_Element_Text('name');
		
		$name->setLabel('Nazwa produktu')
				->setRequired(true)
				->addValidator(new Zend_Validate_NotEmpty(), true)
				->addValidator(new Zend_Validate_StringLength(0, 20), true)
				->addFilter(new Zend_Filter_Alnum());
				
		$this->addElement($name);  

		
		$model =  new Zend_Form_Element_Text('model');
			$model->setLabel('Model')
			//	->setRequired(true)
			//	->addValidator(new Zend_Validate_NotEmpty(), true)
				->addValidator(new Zend_Validate_StringLength(0, 36, 'UTF-8'), true)
				->addFilter(new Zend_Filter_Alnum());
				
		$this->addElement($model); 
				
		
		$description = new Zend_Form_Element_Textarea('description');
		
		$description->addValidator(new Zend_Validate_StringLength( 0, 60000, 'UTF-8' ), true )		
				//->addValidator ( 'Alnum', true, array( 'options' => array ( 'allowWhiteSpace' => true ) )  )
				//->addValidator ( new  Zend_Validate_Alnum(true) )
				->addValidator ( new  Class_Validators_tekstPl() )
				->setLabel('Opis')				
				->addFilter('StringTrim');
				
		 $this->addElement($description);
				
	
	    
		//$this->setEnctype('multipart/form-data');
		//$this->setEnctype('text/plain');
				
		 $submit = new Zend_Form_Element_Submit('Dodaj');
		 
		 $submit->setIgnore(true);		
		
         $this->addElement($submit);         
         
	}
	
	
	public function getModel(){
		
	
		$model = new Addanddelete_models_formDbParent( array ( 'name' => $this->_tableName ) );
		
		return $model;
		
	}
	
	/**
	 * Wstawia tworzy nowy rekord w bazie danych, wypeniajc go danymi.
	 * @param $row
	 * @param $data
	 * @param $values
	 */
	 public function formToDb($row = null, $data = null, $values = null) {	 

	 	
	 	$information = '';
	 
		
		$s = $this->getModel();

		
		$t = $this->get();
		
		$params = $t->getValues();
		//$params = $this;//->getValues();

		$newRow = $s->doInsert($row, $params, $values, $this->foreignKey);
		
		$newRow->save();
		
		
		
		//TODO - wrzucic do funkcji hasChild - return bool
		if ($this->child != null)
			$this->child->formToDb($newRow, $params, $values);

			
		$newRow->save();
		
		return $newRow;	
	    	
	 }	 
}
?>