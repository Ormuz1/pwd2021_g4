<?php
include("libreria/motor.php");
include_once("libreria/libro_d.php");
$id = $_POST['id_lib'];
$A = Libro_d::traer_datos($objConexion->enlace, $id);
$datos_prestamo = mysqli_fetch_assoc(mysqli_query($objConexion->enlace, "SELECT * FROM prestamos_libros ORDER BY prestamos_libros.id_prestamo DESC
"));
$nombre_receptor = mysqli_fetch_assoc(mysqli_query($objConexion->enlace, "SELECT * FROM estudiante WHERE id = {$datos_prestamo['receptor_prestamo']}"));
$nombre_receptor = "{$nombre_receptor['nombre']} {$nombre_receptor['apellido']}";
?>

<script> 
function devolver_libro(id)
{
    $.ajax({
        type: "POST",
        url: "devolver_libro.php",
        data: {id_lib: id}
    }).done(function (html){
        window.location.reload();
    })
}
</script>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h4>
                <?php echo "¿El estudiante $nombre_receptor ha devuelto el libro \"{$A['titulo']}\"?"?>
            </h3>
            <button class="btn btn-default" style="font-size:34px;" onclick="devolver_libro(<?php echo $id?>);">SI</button>
        </div>
    </div>
</div>