<?php
 		  
class Cms_Bootstrap extends Zend_Application_Module_Bootstrap {
	

	protected function _initRouters(){
		
		
				$fc = Zend_Controller_Front::getInstance();
					
				$router = $fc->getRouter();
				
			
				/*
				$router->addRoute('def', new Zend_Controller_Router_Route('/',
				
		                                     array(
		                                     'module' => 'Cms',
		                                     'controller' => 'Management',
		                                     'action' => 'viewone' ,
		                                     'id' => ':id' 
		                                     )
		                                     
		                                     )
		                              );	
		                              
				
				$router->addRoute('def', new Zend_Controller_Router_Route('/:module/:controller/:action/:id',
				
		                                     array(
		                                     'module' => 'Cms',
		                                     'controller' => 'Management',
		                                     'action' => 'viewone' ,
		                                     'id' => 1 
		                                     )
		                                     
		                                     )
		                              );	
		                              */
		                              	
	}
	
	
	protected function _initMenu() {
		
	$table = new Zend_Db_Table( array( 'name'=>'cms' ) );	
	
		$select = $table->select();
		
	
		$select->order("id");
		
		$select->where('exist = 1');
		
		
		
		$pages = $table->fetchAll( $select );		
		
		
		$menu = Zend_Registry::isRegistered('menu') ? Zend_Registry::get('menu') : new Zend_Navigation();
		
		
		$newMenu = new Zend_Navigation();
		
		
		foreach ( $pages as $item ) {

			
		
				$newMenu->addPage( new Zend_Navigation_Page_Mvc( array( 
																	'module'=>'Cms',
																	'controller'=>'Management',
																	'action'=>'viewone',
																	'label' => $item['name'],
																	 'route' => 'azPortfolio',
//																//	'privilege'=>'viewone',
																	//'resource'=>'Cms:management',
																	'params' => array( 'id' => $item['id'] ) 
															)  
													)
								);
		}	
		
			$newMenu->addPage( new Zend_Navigation_Page_Mvc( array( 
																	'module'=>'Cms',
																	'controller'=>'Management',
																	'action'=>'sendmessage',
																	'label' => 'Kontakt',																
																	) 
															));
		
			
		$newMenu->addPages( $menu->getPages() );


		Zend_Registry::set('menu', $newMenu);
		
		$menuAdmin = Zend_Registry::get('menuAdmin');
		
		$menuAdmin->addPage( new Zend_Navigation_Page_Mvc( array( 
																	'module'=>'Cms',
																	'controller'=>'Management',
																	'action'=>'add',
																	'label' =>'Dodaj Stronę',
																	'privilege'=>'add',
																	'resource'=>'Cms:Management',
																	
															)  
													)
								);
					/*			
		$menuAdmin->addPage( new Zend_Navigation_Page_Mvc( array( 
																	'module'=>'Cms',
																	'controller'=>'Management',
																	'action'=>'viewall',
																	'label' =>'Zarządzanie treścią',
																	'privilege'=>'add',
																	'resource'=>'Cms:Management',
																	
															)  
													)
								);
						*/		
			
				
	
		Zend_Registry::set ('menuAdmin', $menuAdmin);
		
	}
	
	
	
	protected function _initAcl() {		
		
		
		$myAcl = Class_myAcl::getInstance();
		
			
 /*
		if ( ! in_array ( 'Cms:Management' , $myAcl->getResources() ) ) {			
						
					$myAcl->add( new Zend_Acl_Resource( 'Cms:Management' ) );		
				
					$myAcl->allow( 'guest', 'Cms:Management', array('viewone','sendmessage') );					
									
					$myAcl->allow( 'admin', 'Cms:Management', array( 'add', 'edit', 'delete', 'viewall' ) );					
					
					Class_myAcl::setInstance( $myAcl );
		}
		*/		
	}
	
	
	
	
}