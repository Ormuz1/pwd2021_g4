<?php
    	
    include_once("motor.php");
	include_once("libro_d.php");
    session_start();
    
    //get search term
    $s_text = $_GET['term'];
	 //$s_tipo = $_REQUEST['tipo'];
   $s_tipo ='origen';
	
	$data=Libro_d::buscar_tit($s_text,$s_tipo);
    
    echo json_encode($data);
?>

