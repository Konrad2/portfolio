<?php
/**
 * 
 * @author Nysart
 *
 */
class Class_param
{
	
	/**
	 * @param tablica skadajaca sie z 'module' 'controller' ' 'action'
	 */
	private $param;
	
//	public function __construct($_request = null)
	public function __construct($_request = null) {
		
//		if( $request!=null ){
		if( $_request != null ) {
			
			
				$this->param['module'] = $_request->getModuleName();
				
				$this->param['controller'] = $_request->getControllerName();
				$this->param['action'] = $_request->getActionName();
				/*
				$this->param['module'] = $param['module'];
				$this->param['controller'] = $param['controller'];
				$this->param['action'] = $param['action'];
				*/
		} else 
		
			$this->param = array('module'=>null, 'controller'=>null, 'action'=>null);
			
	}

	/**
	 * zwraca parametry w postaci tablicy
	 */
	public function toArray()
	{
		return $this->param;
	}

	/**
	 * Tworzy cieszke XPatch z parametr�w
	 */
	public function toXpatch()
	{
		 return Class_xpatch::arrayToXpatch( $this->toArray() );
	}
	
	/**
	 * @return string
	 */
	public function toString(){
		
		$pom = $this->toArray();
		$result = '';
		foreach ($pom as $p){
			
			$result .= '/'.$p;
		}
		
		return $result;
	}
	
/**
 * 
 * zwraca nazwe moduu
 */
	public function module()
	{
		return $this->param['module'];
	}
	
	/**
	 * zwraca nazwe kontrolera
	 */
	public function controller()
	{
		return $this->param['controller'];
	}
	/**
	 * zwraca nazw akcji
	 */
	public function action()
	{
		return $this->param['action'];
	}
	
	
public function getModule()
	{
		return $this->param['module'];
	}
	
	/**
	 * zwraca nazwe kontrolera
	 */
	public function getController()
	{
		return $this->param['controller'];
	}
	/**
	 * zwraca nazw akcji
	 */
	public function getAction()
	{
		return $this->param['action'];
	}
	
	
	/**
	 * ustawia nazwe modulu
	 */
		public function setModule($p)
		{
			$this->param['module'] = $p;
		}
	/**
	 * ustawia nazwe kontrolera
	 */
	public function setController($p)
	{
			$this->param['controller'] = $p;
	}
	/**
	 * ustawia nazw akcji
	 */
	public function setAction($p)
	{
			$this->param['action'] = $p;
	}
	
	
}
?>