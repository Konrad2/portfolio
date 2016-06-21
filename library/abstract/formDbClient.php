<?php
/**
 * Klasa zapewniajaca funkcjonalno� do po��czenia z innymi modu�am. Jeli chcemy doda� do formularza z innego modu�u dodatkowe pola np. tworzymy modu� kurierzy i chcemy aby w 
 * formularzu zamuwienia pojawi�o si� dodatkowe pole z kurierami do wyboru.
 * Tworzymy w katalogu g��wnym modu�u katalog common w kturym umieszczamy plik z klas� dziedzicz�c� po abstract_formDbClient. Nazw� klasy umieszczamy w pliku connections.xml. 
 * xpatch: //zend_config/nazwa_modu�u_g��wnego_formuladza/nazwa_kontrolera_g��wnego_formularza/akcja_g�_form/nazwa_skojarzonego_modu�u(w�asnie tego w kturym tworzymy formDb_client-a). Jako warto�� podajemy nazw� naszej klasy.
 * 
 *  
 *  $modelName musi zawiera� nazw� klasy.
 * @author Konrad
 * @package FormDb
 *
 */
abstract class abstract_formDbClient extends Zend_Form implements interfaces_formDb_client, interfaces_factory_client//, interfaces_formDb_model
{	
	
	/**
	 * Sciezka do pliku z klas formDb
	 * @var unknown_type
	 */
	protected $patchToModel;
	
	/**
	 * Nazwa klasy.
	 * @var unknown_type
	 */
	protected $modelName;
	
	
	/*
	 * 
	 * @var string Nazwa pod jak� pojawi si� select box.
	 */
	//protected $label;
	
	/**
	 * Nazwa klucza obcego do naszej tabeli.
	 * @var string
	 */
	protected $foreignKey;
	
	/**
	 * inicjujemy w niej form�larz elem�tami. Je�li chcesz doda� element select box z warto�ciami z tabeli wywo�aj metod� addSelectFromTable($label, $colName). 
	 * Ustawiamy:
	 * - Nazw� modelu implem�tuj�cego interfejs interface_formDb_model do atrybutu $modelName.
	 * - Do  patchToModel �ci�k� do pliku w kturym znajduje si� klasa modu�u.	 * 
	 * - $foreignKey Nazwa klucza obcego do naszej tabeli
	 * Koniecznie w tej kolejno�ci. 
	 */
	public function init(){

	}
	
	
	
	
	
	public function delete($id){
		
		$this->getModel()->delete($id);
		
		if( $this->child != null )
			 $this->child->delete($id);
	}
	
	
	/**
	 * @return FormDbModel Zwraca model skojarzony z klas�. 
	 */
	
	public function getModel(){
				
		
		require_once $this->patchToModel;
				
		return new $this->modelName();		
	}
	
	
	/**
	 * @return Zend_Form_Element_Select
	 * 
	 * @param string $colName nazwa kolumny z kturej maj� by� pobrane opcje selectBox.
	 * @assert-in model->_col{$colName} (tabela bazy danych zawiera kolumn� o nazwie podanej w $colName).
	 * @param string $name nazwa selectBox.
	 */
	
	public function getElemSelect($colName, $name){

		$t = $this->getModel();

		$table = $t->getNames($colName)->toArray();

		if ( count($table) > 0 )
		{
			$sel = Class_forms_myHandling::createSelect($table, $name);
		}

		return $sel;
	}

	/**
	 * Dodaje element select. Tworzy go z id oraz etykiet zawartych w kolumnie podanej w $colName.
	 * @param string Nazwa kolumny z kturej zawarto�ci zostan� wstawionw do select-a.
	 * @param string Pod jakim tytu�em wy �wietli si� select.
	 */

	public function addSelectFromTable($label, $colName,$name, $firstEmpty = true){

		$t = $this->getModel();
		
		//$sel = $this->getElemSelect( $t->getNames($colName)->toArray(), $name);
		$sel = Class_forms_myHandling::createSelect( $t->getNames($colName)->toArray(), $name, $firstEmpty);

//                $f= new Zend_Form();
		$sel->setLabel($label);		
//                $f->addElement($sel);
//                echo $f;
                
                
		$this->addElement($sel);
	}

	/*
	public function addSelectFromTable($label, $colName){

		$t = $this->getModel();

		$table = $t->getNames($colName);

		
		if ( count($table) > 0 )
		{
			$sel= new Zend_Form_Element_Select( $this->foreignKey );
			$sel->setLabel($label);
				//->setRequired(false);

			foreach($table->toArray() as $r)
			{
				$sel->addMultiOption(array_shift($r), array_shift($r));
			}
			$this->addElement($sel);
		}
	}
*/
	/**
	 * Tworzy instancje modelu z danych zawartyw w $patchToModel oraz $modelName. Wywo�uje metod� doInsert w modelu.
	 * @param $row
	 * @param $data
	 * @param $values
	 */
	
	 public function formToDb($row = null, $data = null, $values = null){

	 	
		require_once $this->patchToModel;

		$model = new $this->modelName();
               // var_dump($this->foreignKey);
               // die();
		$model->doInsert($row, $data, $values, $this->foreignKey);
		//$model->doInsert($row, $this->getValues(), $values, $this->foreignKey);

		if( $this->child != null )
			 $this->child->formToDb($row, $data, $values);
			 
		return $row;
	}

	
	public function updateDb($row = null, $data = null, $values = null){	
	 
		require_once $this->patchToModel;

		$model = new $this->modelName();

		$model->doUpdate($row, $data, $values, $this->foreignKey);

		if( $this->child != null )
			 $this->child->updateDb($row, $data, $values);
	}
	
	
	
	/**
	 * Dodaje obiekt do struktury
	 * @param interface_factoryClient
	 */
	public function add($child){
		
		if ( $child != null)
		{
			if ($this->child != null){
				$this->child->add($child);
			}
			else 
				$this->child = $child;
		}
	}
	
	

	/**
	 * @return Zend_Form
	 * Wywouje rekurencyjnie get u dziecka nastpnie pobiera elementy i tworzy jeden wsp�lny formularz
	 */
	public function get(){
		
		if(isset($this->child))
		{
			$form = $this->child->get();
			
			$fo = $this->getElements();
			
			foreach ($fo as $elem)
				$form->addElement($elem);			
				
//			return $this->child->get();
			return $form;
		}
		else
			return $this;
	}
	
	
	
	/**
	 * Podiera wiersz z bazy o danym id, nastempnie
	 * Wype�nia formularz danymi z rekordu.
	 * @param Zend_Db_Table_Row $parentRow
	 */
	
	public function fill($parentRow){
		
		$m = $this->getModel();
		
		$rowset = $m->find($parentRow[$this->foreignKey]);
		
		$row = $rowset->current();
		
		$elements = $this->getElements();
		//for ($i = 0; $i<count($element); $i++ ){
		foreach($elements as $elem){	
			
			$elem->setValue($row[$elem->getName()]);
			$this->addElement($elem); 
		}	
		
		if ($this->child != null)
			$this->child->fill($parentRow);
	}
	
	
	public function update(){
		
	}
	
	
	/**
	 * Surzy do zaimplementowania dodatkowych czynnosci sprawdzajcych np.: czy podany login jest wolny.
	 * @return wraca komunikat bledu. Jeli wszystko jest wporzadku, zwraca null.
	 * 
	 */
	
	public function isCorect(){
		
		return null;
	} 
}


