<?php 
function Limpiar_Cadena($cadena){
	$search = explode(",","ç,æ,œ,Á,É,Í,Ó,Ú,À,È,Ì,Ò,Ù,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,ñ");
	$replace = explode(",","c,ae,oe,A,E,I,O,U,A,E,I,O,U,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,Ñ");
	
	$cadena = str_replace($search,$replace,$cadena); 	
	$cadena = strtoupper($cadena);
	//$cadena = stripslashes($cadena);
	$cadena = trim($cadena);
	$cadena = utf8_decode($cadena);
	return 	$cadena;
}
?>