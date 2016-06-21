<?php

/**
 * searchSystem
 * system dziêki interfejsowi mo¿e obs³ugiwaæ kryteria wyœwietlania (przeszukiwania).
 */
interface interfaces_search_searchSystem {
	
	public static  function addCriterion($param);
	public static function getCriterion();
	public static function clearCriterion();

}

?>