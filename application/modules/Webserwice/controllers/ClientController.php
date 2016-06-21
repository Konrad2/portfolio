<?php

/**
 * ClientController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class Webserwice_ClientController extends Zend_Controller_Action {
	

 	public function init()
    {
        
    }
    
    
	public function indexAction() {	
		
		$domDoc = file_get_contents('http://www.voyager.pl/portal/a_bus.html');
		
		$dom = new DOMDocument();
		
		 $dom->validateOnParse = true;
		//$doc->load('http://www.voyager.pl/portal/a_bus.html');
		$dom->loadHTMLFile('http://www.voyager.pl/portal/a_bus.html');
		

		//var_dump($doc);
		 $dom->saveHTML();
		
		
		// $dom->validate();
		 
		 $params = $dom->getElementById('KrajD') ;
		 
		 var_dump($params);
	
    
		
		echo  $dom->saveHTML();
		//echo 
			/*	
		$client = new Zend_Soap_Client("http://www.voyager.pl/portal.wsdl",
		
		array('compression' => SOAP_COMPRESSION_ACCEPT));
		
		$client->__soapCall('NazwaFunkcji', array(JakiesParametry));
		*/ 
	}

}

