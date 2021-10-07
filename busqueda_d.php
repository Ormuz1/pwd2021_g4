<?php
include_once("libreria/db_object.php");
session_start();
$str_b =  isset($_GET["b"]) ? $_GET["b"] : NULL;
$libros = buscar("libros_d", $str_b, array("autor", "titulo", "tipo", "area", "materia"), "titulo");

?>
<?php
if (isset($libros)) 
{
?>
    <div class="panel panel-default">
        <div class="panel-heading">Publicaciones Encontradas</div>
        <div style="overflow: scroll;height: 350px;">
            <table class="tabla_edicion table table-hover">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($libros as $libro) 
                    {
                        echo "
                            <tr>
                            <td><a href='libros_d/" . $libro['archivo'] . "' target='_blank' >$libro[titulo]</a></td>
                            <td>$libro[autor]</td>
                            <td>$libro[tipo]</td>
                        ";

                        $file_l = $libro['archivo'];
                        if (isset($_SESSION['username']) && $_SESSION['rol'] == 'administrador') {
                            echo '<td><button class="btn btn-primary btn-xs" onclick="editar(' . $libro['id_libro'] . ')" >Editar</button></td>';
                            echo '<td><button class="btn btn-primary btn-xs" onclick="borrar(' . $libro['id_libro'] . ')" >Borrar</button></td>';
                        } else {
                            echo '<td><button class="btn btn-primary btn-xs" onclick="ver_info(' . $libro['id_libro'] . ')" >Info</button></td>';
                        }
                        echo '<td><button class="btn btn-primary btn-xs" onclick="cargar_pdf(\'#capa_d\', \'libros_d/' . $file_l . '\')" >Min</button></td>';
                        echo " </tr> ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
}
?>