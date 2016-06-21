<?php
/**
 * Klasa zapewniajaca funkcjonalność do połączenia z innymi modułam. Jeli chcemy dodać do formularza z innego modułu dodatkowe pola np. tworzymy moduł kurierzy i chcemy aby w 
 * formularzu zamuwienia pojawiło się dodatkowe pole z kurierami do wyboru.
 * Tworzymy w katalogu głównym modułu katalog common w kturym umieszczamy plik z klasą dziedzicz�c� po abstract_formDbClient. Nazw� klasy umieszczamy w pliku connections.xml. 
 * xpatch: //zend_config/nazwa_modułu_gówwnego_formuladza/nazwa_kontrolera_głównego_formularza/akcja_g�_form/nazwa_skojarzonego_modułu(własnie tego w kturym tworzymy formDb_client-a). Jako warto�� podajemy nazw� naszej klasy.
 * 
 *  
 *  $modelName musi zawierać nazwy klasy.
 * @author Konrad
 * @package formDb
 *
 */
 class FormDb_Connect_Client_Client extends  FormDb_Connect_aConnect  //implements interfaces_formDb_client, interfaces_factory_client//, interfaces_formDb_model
{

	
	
 		
	 public function __construct($options = null) {
	 	
	 	
	 	parent::__construct( $options );
	 	
	 	
	 		$this->_modelStringName = 'FormDb_Connect_Client_models_Client';
	 	
	 }
	/*
	 * 
	 * @var string Nazwa pod jak� pojawi si� select box.
	 */
	//protected $label;
	
	/**
	 * Nazwa klucza obcego do naszej tabeli lub nazwa kolumny z kluczem obcym.
	 * @var string
	 */
	protected $foreignKey;
	
	
	/**
	 * Inicjujemy w niej form�larz elem�tami. Je�li chcesz doda� element select box z warto�ciami z tabeli wywo�aj metod� addSelectFromTable($label, $colName). 
	 * Ustawiamy:
	 * - nazwa tabeli w bazie danych 
	 * - $foreignKey Nazwa klucza obcego do naszej tabeli
	 * Koniecznie w tej kolejno�ci. 
	 */
	public function init(){

	}
	
	
	
	
	/**
	 * Ustawia nazwę klucza obcego w tabeli nadrzędnej bądz nazwa kolumny z kluczem obcym.
	 * 
	 * @param string $keyName
	 */
	
	public function setForeignKey( $keyName ) {
		
		
		$this->foreignKey = $keyName;
		
	}
	
	
	/**
	 * Tworzy instancje modelu z danych zawartyw w $patchToModel oraz $modelName. Wywo�uje metod� doInsert w modelu.
	 * @param $row
	 * @param $data
	 * @param $values
	 */
	
	 public function formToDb($row = null, $data = null, $values = null){

	
		$model = $this->getModel();

		$model->doInsert($row, $data, $values, $this->foreignKey);
		//$model->doInsert($row, $this->getValues(), $values, $this->foreignKey);

		if( $this->child != null )
			 $this->child->formToDb($row, $data, $values);
			 
		return $row;
	}

	
	
	public function updateDb($row = null, $data = null, $values = null){	
	
		
		$model = $this->getModel();

		$model->doUpdate($row, $data, $values, $this->foreignKey);

		if( $this->child != null )
		
			 $this->child->updateDb($row, $data, $values);
	}
	
	
	public function delete($id){
		
		$this->getModel()->deleteEntite($id);
		
		if( $this->child != null )
			 $this->child->deleteEntite($id);
	}
	
	


	
	
	

	
}


