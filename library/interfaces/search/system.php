<?php

/**
 * system
 * system dzi�ki interfejsowi mo�e obs�ugiwa� kryteria wy�wietlania (przeszukiwania).
 */
interface interfaces_search_searchSystem {
	
	public static  function addCriterion($param);
	public static function getCriterion($param);
	public static function clearCriterion();

}

?>