<?php
include_once("libreria/db_object.php");
$libro_actual;
if (!empty($_POST)) 
{
	$operacion = $_POST['operacion'] ?? "alta";
	if ($operacion == 'edicion' || $operacion == 'ver') 
	{
		$id = $_POST['id_obj'];
		$libro_actual = traer_datos("libros_d", $id);
		$accion = "libreria.php" . '?operacion=actualizar&id_obj=' . $id;
		$btn_txt = 'Actualizar';
		$leyenda = 'Modificar datos ';
		if ($operacion == 'ver')
			$leyenda = 'DATOS ';
	}

	if ($operacion == 'baja') 
	{
		$id = $_POST['id_obj'];
		$libro_actual = traer_datos("libros_d", $id);
		$accion = "libreria.php" . '?operacion=borrar&id_obj=' . $id;
		$btn_txt = 'Borrar';
		$leyenda = 'Eliminar';
	}

	if($operacion == 'alta')
	{
		$accion = "libreria.php" . '?operacion=alta';
		$btn_txt = 'Subir';
		$leyenda = 'Registro Publicaciones Digitales';
	}
}
?>

<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<div id="capa_d">
				<form role="form" method="POST" action="<?php echo $accion; ?>">
					<legend><?php echo $leyenda; ?></legend>
					<?php
					if (isset($operacion)) 
					{
						if ($operacion == 'edicion' || $operacion == 'baja') 
						{
					?>
							<label for="id_usuario">ID:</label>
							<input id="id_libro" name="id" type="text" class="form-control" readonly value="<?php echo $id; ?>" />
					<?php
						}
					}
					?>

					<div class="row">
						<div class="form-group">
							<div class="col-xs-12">
								<label>Autor</label>
								<input type="text" size="20" name="autor" class="form-control" placeholder="nombre del Autor" value="<?php echo $libro_actual["autor"] ?? ""; ?>">
							</div>

							<div class="col-xs-12">
								<label>Titulo</label>
								<input type="text" size="20" name="titulo" class="form-control" placeholder="Nombre de la publicacion" value="<?php echo $libro_actual["titulo"] ?? ""; ?>">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-6">
								<label>Idioma</label>
								<input type="text" size="10" name="origen" class="form-control" placeholder="Origen de la edición" value="<?php echo $libro_actual["origen"] ?? ""; ?>">
							</div>

							<div class="col-xs-6">
								<label>Año de Publicación</label>
								<input type="text" size="10" name="anio" class="form-control" placeholder="Año de la edición" value="<?php echo $libro_actual["anio"] ?? ""; ?>">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-8">
								<label>Edicion</label>
								<input type="text" size="10" name="edicion" class="form-control" placeholder="Detalles de la edición" value="<?php echo $libro_actual["edicion"] ?? ""; ?>">
							</div>

							<div class="col-xs-4">
								<label>Tipo</label>
                                <select class="form-control" name="txtTipo" id="txtTipo">
                                    <?php 
                                    // PARA HACER: Arreglar esta pedazo de mierda.
                                    $tiposValidos = ["Libro Digital", "Libro Fisico", "Video", "Audio", "Texto"];
                                    foreach ($tiposValidos as $tipoActual)
                                    {   
                                        echo "<option " . ($tipoActual == $tipo ? "selected" : "") . ">$tipoActual</option>";
                                    }
                                    ?>
                                </select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-6">
								<label>Area</label>
								<input type="text" size="20" name="area" class="form-control" placeholder="" value="<?php echo $libro_actual["area"] ?? ""; ?>">
							</div>

							<div class="col-xs-6">
								<label>Materia</label>
								<input type="text" size="20" name="materia" class="form-control" placeholder="" value="<?php echo $libro_actual["materia"] ?? ""; ?>">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<label for="ejemplo_Observaciones">Comentario</label>
								<input type="text" size="40" name="comentario" class="form-control" placeholder="" value="<?php echo $libro_actual["comentario"] ?? ""; ?>">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<label>Archivo</label>
								<input id="t_file" type="text" name="archivo" class="form-control" value="<?php echo $libro_actual["archivo"] ?? ""; ?>">
							</div>
						</div>
					</div>
					<?php
					if ($operacion != 'ver') {
						echo '<button method="post" type="submit" class="btn btn-default">' . $btn_txt . '</button>';
					}
					?>
				</form>

				<form>
					<div class="form-group">
						<label>Subir archivo</label>
						<input type="file" id="fileToUpload" onchange="upload_pdf();PonerNombreArchivo();">
					</div>
					<div class="upload-msg"></div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    $("#tit_origen").autocomplete({

        source: "sugerir.php",
        minLength: 1,
        select: function (event, ui) {
        }
    });
</script>