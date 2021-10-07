<?php
//define ('DB_HOST','localhost');
define ('DB_HOST','localhost');
define ('DB_USER','root');
define ('DB_PASS','');
define ('DB_NAME','biblio_t1');

$con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

function formatDate($date){
	return date('g:i a', strtotime($date));
}


