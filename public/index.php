<?php

function errorHandler($errno, $errstr, $errfile, $errline){
		//TODO - Zapis do pliku.		
		//echo 'Index hellow '.$errno.', '. $errstr.', '.', '.$errfile.' w lini nr.'.$errline.'<br/>';
	}

set_include_path('.' . PATH_SEPARATOR .'../library/'
  . PATH_SEPARATOR . '..'
   . PATH_SEPARATOR . '../application/modules'
   . PATH_SEPARATOR . '../Zend'
    . PATH_SEPARATOR .   '../library/Components/Entite/'
   . PATH_SEPARATOR . '../library/interfaces'
     . PATH_SEPARATOR .   '../library/Components/'
    . PATH_SEPARATOR .   '../library/Components/LogIn/'
       //. PATH_SEPARATOR .   '../library/Components/'
      . PATH_SEPARATOR .   '../library/Components/Entite/View/'
      . PATH_SEPARATOR .   '../library/Components/Entite/Management/'
       . PATH_SEPARATOR .   '../library/Components/createaccount/'
   . PATH_SEPARATOR . get_include_path());

define('BASE_URL' , '/');	


require_once 'Zend/Loader.php';

Zend_Loader::loadClass('Zend_Loader_Autoloader');
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->setFallbackAutoloader(true);

//Zend_Session::start();


Zend_Loader::loadClass('Zend_Session');

		$frontController = Zend_Controller_Front::getInstance();
//		$frontController->throwExceptions(true);
	
		$frontController->registerPlugin(new initAppli());
	
		
		$frontController->setBaseUrl(BASE_URL);
		
		
		$frontController->addModuleDirectory('../application/modules');	
		
		/*	$frontController->setControllerDirectory(array(
		'default'=>'../application/modules/Default/controllers',
		'Cms'=>'../application/modules/Cms/controllers',
		'Log'=>'../application/modules/Log/controllers',
		));
*/

//set_error_handler( 'errorHandler');


defined('APPLICATION_PATH')
    || define('APPLICATION_PATH',
              realpath(dirname(__FILE__) . '/../application'));
 
// Define application environment
//defined('APPLICATION_ENV')|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV'): 'production'));
defined('APPLICATION_ENV')|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV'): 'general'));
 
// Typically, you will also want to add your library/ directory
// to the include_path, particularly if it contains your ZF installed
set_include_path(implode(PATH_SEPARATOR, array(
    dirname(dirname(__FILE__)) . '/library',
    get_include_path(),
)));
 
/** Zend_Application */
require_once 'Zend/Application.php';
 
// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    array(
        'resources' => array(
					       
					    		'Class_Resource_layout' =>array(),
				
    							'modules'=>array(),
    							
					    		//'Class_Resource_frontControllerx'=>array()
   							 ),
   		'bootstrap'=>'../library/Class/Bootstrap.php'
   // APPLICATION_PATH . '/config/config.xml'
	)
	);

$application->bootstrap()
            ->run();

