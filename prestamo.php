<?php
include("libreria/motor.php");
include_once("libreria/libro_d.php");
$id = $_POST['id_lib'];
$A = Libro_d::traer_datos($objConexion->enlace, $id);

function conseguir_socios()
{
    $query = "SELECT * FROM estudiante WHERE rol = 'socio'";
    return mysqli_fetch_all(mysqli_query($GLOBALS['objConexion']->enlace, $query), MYSQLI_ASSOC);
}
$accion = "abm_ld.php?operacion=prestar&id_lib={$id}";
?>

<div class="container">
    <form action="<?php echo $accion ?>" method="POST">
        <div class="row">
            <div class="col-sm-6">
                <div class="col-xs-5">
                    <label>Autor</label>
                    <input type="text" size="20" name="txtAutor" disabled class="form-control" placeholder="Nombre del Autor" value="<?php echo $A['autor']; ?>">
                </div>

                <div class="col-xs-7">
                    <label>Titulo</label>
                    <input type="text" size="20" name="txtTitulo" disabled class="form-control" placeholder="Nombre de la publicacion" value="<?php echo $A['titulo']; ?>">
                </div>
                <div class="col-xs-6">
                    <label for="receptor">Socio a prestar</label>
                    <select name="receptor" class="form-control">
                        <?php
                        $socios = conseguir_socios();
                        foreach ($socios as $socio) {
                            echo "<option value='{$socio['id']}'>{$socio['nombre']} {$socio['apellido']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <label>Duracion del Prestamo</label>
                <div class="col-xs-3">
                    <input type="number" name="cantidad_tiempo" id="" min="1" value="1" class="form-control">
                </div>
                <div class="col-xs-3">
                    <select name="magnitud_tiempo" id="" class="form-control">
                        <option value="dia">Dia/s</option>
                        <option value="semana">Semana/s</option>
                        <option value="mes">Mes/es</option>
                    </select>
                </div>
            </div>
        </div>
        <input type="submit" value="Enviar" class="btn btn-default">
    </form>
</div>
</div>