<?php
include("motor.php");
$query1 = "UPDATE libros_d SET prestado = 0 WHERE libros_d.id_libro = {$_POST['id_lib']}";
$query2 = "UPDATE prestamos_libros SET fue_devuelto = 1 WHERE libro_prestado = {$_POST['id_lib']} AND fue_devuelto = 0";
echo mysqli_query($objConexion->enlace, $query2);
echo mysqli_query($objConexion->enlace, $query1);
?>