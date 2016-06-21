<?php

function array_scrum($t)
{
	$c = count($t);
	
	$array = array();
	
	for ($i = 0; $i < $c ; $i++ )
	{
		$k = key($t);		
		
		$array[current($t)] = $k;
		
		next($t);		
	}
	
	return $array;
}

function findUppercaseChar($string)
{	
	for ( $i = 0, $cnt = 0; $i < strlen( $string ); $i++ )
	{
	    if ( ( $string[ $i ] >= 'A' ) && ( $string[ $i ] <= 'Z' ) )
	    {
	        if ( $i > 0 )
	        {
	           return $i;          
	        }
	    }
	}
	return count($string);
}

function getModName($string)
{
	$pos = findUppercaseChar($string);
	
	return substr($string,0, $pos);
}


?>