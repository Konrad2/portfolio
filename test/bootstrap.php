<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author konradroot
 */
// TODO: check include path
ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.dirname(__FILE__).'/../../../../../usr/share/pear/PHPUnit');



set_include_path('.' . PATH_SEPARATOR .'../library/'
  . PATH_SEPARATOR . '..'
   . PATH_SEPARATOR . '../application/modules'
   . PATH_SEPARATOR . '../Zend'
        . PATH_SEPARATOR . '../Zend/Zend'
    . PATH_SEPARATOR .   '../library/Components/Entite/'
   . PATH_SEPARATOR . '../library/interfaces'
     . PATH_SEPARATOR .   '../library/Components/'
    . PATH_SEPARATOR .   '../library/Components/LogIn/'
       //. PATH_SEPARATOR .   '../library/Components/'
      . PATH_SEPARATOR .   '../library/Components/Entite/View/'
      . PATH_SEPARATOR .   '../library/Components/Entite/Management/'
   . PATH_SEPARATOR . get_include_path());

define('BASE_URL' , '/');	
//define(BASE_URL , '/');	

require_once '../Zend/Zend/Loader.php';

Zend_Loader::loadClass('Zend_Loader_Autoloader');
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->setFallbackAutoloader(true);


 defined('APPLICATION_ENV')|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV'): 'general'));
 
?>
