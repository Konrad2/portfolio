<?php
/**
 * Api do pracy z plikami konfiguracyjnymi.
 * Do pracy z plikami konfiguracyjnymi konfiguracyjnymi.
 * @category xml
 * @author Konrad
 * @package Config
 *
 */
class Class_Config_myConfig
{	
	/**
	 * @var string nazwa sekcji w kturej definiujemy kolumny które  maj¹ byæ wyœwietlane.
	 *  Definiujemy równierz pod jak¹ nazw¹ maj¹ byœ wyœwietlane.
	 */
	protected $sectionRowOutput;
	
	/**
	 * @var string nazwa sekcji w kturej definiujemy kolumny które  maj¹ byæ wyœwietlane.
	 *  Definiujemy równierz pod jak¹ nazw¹ maj¹ byœ wyœwietlane.
	 */
	protected $rowSetOutput;
	
	/**
	 * @var string Œcierzka do pliku konfiguracyjnego modu³u.
	 */
	protected $patchToConfig;
	
	/**
	 * @var string sekcja pod któr± zapisane s± modu³y w pliku konfiguracyjnym.
	 */
	protected $section ;
	/**
	 * Koncepj± klasy jest ¶wiadczenie us³ug zapewniaj±cych dane o modu³ach.
	 * 
	 * Karzdy element reprezentuje jeden zainstalowany modu³.
	 * @param string Œcie¿ka do pliku konfiguracyjnego.
	 * @param string sekcja w kturen zapisane s± informacje o modu³ach.
	 * @return array Zwraca tablice elemêtów typu configModulesElement.
	 */
	
	public function __construct(){
		
		$this->section = 'modules';
		$this->sectionRowOutput = 'rowOutput';
		$this->rowSetOutput = 'rowSetOutput';
		$this->patchToModule = '../application/modules/';
		$this->patchToConfig = '../application/config/config.xml';
	}
	
	public function getModules()
	{
		$patchToConfigFile = Class_system::patchToConfig();		
		
		$config = new Class_Config_SaveConfig( $patchToConfigFile, $this->section );
		
		$modules = array();
		
		/**
		 * Tworzy elemêty typu system_configModulesElement (g³ówna czê¶æ klasy).
		 */
		foreach ($config  as $key => $c ) {
			
			$modules[] = new system_moduleConfigElement($c,$key);
		}

		return $modules;
	}
	
	
	
	
	
	/**
	 * Wyœwietla elemêty z pliku xml jako link (<a href>).
	 * Gdzie nazwa znacznika to nazwa linku a vartoœæ to link. 
	 * @param string $module Nazwa modu³u w kturym znajduje siê plik konfiguracyjny.
	 * @param string $section Nazwa sekcji w kturej znajduj¹ siê dane do linku.
	 * @param string $baseUrl Adres url do aplikacji na serwerze.
	 * 
	 */
	public function outputLink( $module, $section, $baseUrl )
	{
		$patch = '';
		
		if ( $module === null)
		{
			$patch = $this->patchToConfig;
		}
		else 
			$patch = '../application/modules/'. $module .'/config.xml';
		
	//	$config = new Zend_Config_Xml( $patch , $section );
		$config = new Class_Config_SaveConfig( $patch );
		$config = $config->toArray();
		
		$result = array();
		
		if ( isset($config[$section]) )
		{
			//$config = new Class_config( $patch, $section );
			//foreach ( $config as $v )
			foreach ( $config[$section] as $v )
			{
				
				$result[] = '<a href="'.$baseUrl.'/'.$v['link'].'">'. $v['name'] .'</a> ';
				//echo '<a href="'.$baseUrl.'/'.$v->link.'">'. $v->name .'</a> ';
			}
		}
		
		return $result;	
	}
	
	/**
	 * Zwraca tablice z z nazwami kolumn jako klucze i nazwami w jakiej fornie maj± siê wyœwietliæ.
	 * zwraca NUll jeœli tablica sekcja nie zostanie znaleziona;
	 * Dane pobierane s± z sekcji "rowOutput", z pliku konfiguracyjnego modu³u.
	 * 
	 * @example
	 *  $select->from( 'courier', Class_myConfig::getRowNameForOutput('courier') );
	 *  
	 * @param $module
	 */
	public  function getRowNamesForOutput($moduleName)
	{
		$patch =  Class_system::patchToModule().$moduleName;	
		
		return $this->getSection( $patch, $this->sectionRowOutput );
	}
	
	/**
	 * Zwraca tablice z nazwami kolumn jako klucze i nazwami w jakiej fornie maj± siê wyœwietliæ jako wartoœci.
	 * Dane pobierane s± z sekcji "LabelRowSetNames", z pliku konfiguracyjnego modu³u.
	 * 
	 * @example
	 *  $select->from( 'things', Class_myConfig::getRowNameForLabel('courier') );
	 * @param $module
	 * @return Zwraca tablice z nazwami kolumn jako klucze i nazwami w jakiej fornie maj± siê wyœwietliæ jako wartoœci.
	 */
	public  function getRowSetNamesForOutput($moduleName)
	{
		$patch =  Class_system::patchToModule().'/'.$moduleName;	
		
		return $this->getSection( $patch, $this->rowSetOutput );
	}
	
	/**
	 * Dziea³a tak samo jak getRowSetNamesForOutput ale zwraca dane maj¹ce z sekcji label.
	 * @return Zwraca tablice z nazwami kolumn jako klucze i nazwami w jakiej fornie maj¹ siê wyœwietliæ jako wartoœci.
	 */	
	public  function getRowNamesForLabel($moduleName)
	{
		$patch =  Class_system::patchToModule().'/'.$moduleName;	
		
		return $this->getSection( $patch, $this->rowSetOutput );
	}
	
	/**
	 * 
	 * @return Zwraca sekcje w postaci tablicy. zamieniaj¹c klucze z wartoœciami.
	 * 
	 * co¶ niedzia³a :(
	 * 
	 */	
	public static function getSection($patch, $section)
	{
		$patch .= '/config.xml';
		
		$result = array();
		
		try{			
			$config = new Class_Config_SaveConfig($patch, $section);	
		}
		catch(Exception $ex)
		{
			$config = null;			
		}
		
		
		if ( $config!= null )
		{
			$result = Class_array::keyToValue( $config->toArray() );			
		}
		
		return $result;
	} 

	/**
	 * @return funkcja zwraca elemêty odpowiadaj±ce z sekcji przekazanej w parametrze section.
	 */
	static public function getFromParam($param, $section)
	{
		$result = null;
		try 
		{
			if (file_exists('../application/modules/'.$module.'/config.xml'))
			{
				$config = new Zend_Config_Xml('../application/modules/'.$module.'/config.xml',$section);	
				
				$t = $config->toArray();			
					
				if(count($t)==0)
					echo "nie jest tablica";
				else
					if ($array != null)
					{
						foreach ($t as $k=>$v)
						{
							foreach ($array as $val)
							{
								if ( $k == $val)
									$result[] = $v;
							}
						}
					}
					else 
					{
	
						$result = $t;
					}				
				}				
									
			}
			catch(Exception $ex)
			{
				echo $ex->getMessage();
				return $result;
			}	

	
			return $result;
	}
	
	/**	
	 * @return tablice nazw elemtów oraz ich wartoci. zwracane s dzieci ze cierzki xpatch z pliku znajdujcego si w miejscu wskazanym w drugi prametrze 
	 * @param string $patch - xpatch np //modes/sale/order 
	 * @param string $patchToFile - cierzka do pliku xml
	 */
	public static function getConnections($xpatch,$patchToFile)
	{
		return  Class_myXml::getSubChildrenFromXpatch( $xpatch, $patchToFile );	
	}	
	
	
}
?>