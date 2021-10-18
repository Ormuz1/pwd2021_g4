<?php session_start(); ?>
<title>BASES PWD</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="recursos/css/bootstrap.min.css" >
<script src="recursos/js/jquery-3.1.0.min.js"></script>
<script src="recursos/js/bootstrap.min.js"></script>
<script src="recursos/ui/jquery-ui.js"></script>
<link rel="stylesheet" href="recursos/css/style_chat.css" media="all"/>	
<link rel="stylesheet" href="recursos/ui/jquery-ui.css">
<link rel="stylesheet" href="recursos/css/cust.css">
<?php
    if (isset($_SESSION['username']) && $_SESSION['rol'] == 'administrador') 
    {
        echo "<script src='recursos/js/contador_usuarios.js'> </script>";
    }
?>