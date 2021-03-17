<?php 


function array2string($array){
	$string= implode(", ", $array);
	
	$array = urlencode($string);

	return($array);
}
function limpiar_string($string){
    return nl2br(htmlentities(trim($string)));
}

function titulo($string){
	return ucwords(str_replace("_"," ",$string));

}

function nombreenruta($string){
	return str_ireplace(" ","_",$string);


}
