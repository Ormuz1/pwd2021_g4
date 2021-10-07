<?php
include_once("libreria/db_object.php");


$cats = seleccionar("carteles", "DISTINCT categoria");
if (!empty($_POST)) 
{    
    $operacion = $_POST['operacion'] ?? 'actualizar';
    
    if ($operacion == 'edicion') 
    {
        $id = $_POST['id_obj'];
        $cartel_actual = traer_datos("carteles", $id);
        
        $accion = "carteles.php" . '?operacion=actualizar&id_obj=' . $id;
        $btn_txt = 'Actualizar';
        $leyenda = 'Modificar Publicacion de Cartelera ';
    }
    
    if ($operacion == 'baja') 
    {
        $id = $_POST['id_obj'];
        $cartel_actual = traer_datos("carteles", $id);
        
        $accion = "carteles.php" . '?operacion=borrar&id_obj=' . $id;
        $btn_txt = 'Borrar';
        $leyenda = 'Eliminar';
    }
    
    if($operacion == 'alta')
	{
		$accion = "carteles.php" . '?operacion=alta';
		$btn_txt = 'Subir';
		$leyenda = 'Registro Carteles';
	}
}
?>

<div id="capa_d">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <legend><?php echo $leyenda; ?></legend>
                <form role="form" method="POST" action="<?php echo $accion; ?>">
                    <div class="row">
                        <div class="col-xs-2">
                            <?php
                            if (isset($operacion)) 
                            {
                                if ($operacion == 'edicion' || $operacion == 'baja') 
                                {
                            ?>
                                    <label for="id_usuario">ID:</label>
                                    <input id="id_cart" name="id" type="text" class="form-control" readonly value="<?php echo $id; ?>" />
                            <?php
                                }
                            ?>
                                </div>
                                <?php
                                if($operacion != 'alta')
                                {
                                ?>
                                <div class="col-xs-8">
                                    <a href="#"><span onclick="preview();">Vista Previa</span></a>
                                </div>
                            <?php
                                }
                            }
                            else
                            { 
                            ?>
                                </div>
                            <?php 
                            } 
                            ?>
                        <div class="form-group">

                            <div class="col-xs-12">
                                <label>Titulo</label>
                                <input type="text" size="20" name="titulo" class="form-control" id="tit_titulo" placeholder="Encabezado/Titulo de la publicacion" value="<?php echo $cartel_actual["titulo"] ?? ""; ?>">
                            </div>

                            <div class="col-xs-12">
                                <label>Texto</label>
                                <textarea rows="3" cols="30" name="texto" class="form-control" id="aut_texto"><?php echo $cartel_actual["texto"] ?? ""; ?></textarea>
                            </div>

                            <div class="col-xs-12">
                                <label>Otro Texto</label>
                                <textarea rows="3" cols="30" name="texto1" class="form-control" id="aut_texto1"><?php echo $cartel_actual["texto1"] ?? ""; ?></textarea>
                            </div>
                            <div class="col-xs-12">
                                <label>Mas Texto</label>
                                <textarea rows="3" cols="30" name="texto2" class="form-control" id="aut_texto2"><?php echo $cartel_actual["texto2"] ?? ""; ?></textarea>
                            </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-xs-8">
                            <label>Link</label>
                            <input type="url" size="10" name="link" class="form-control" id="tit_link" placeholder="Un enlace optativo" value="<?php echo $cartel_actual["link"] ?? ""; ?>">
                        </div>

                        <div class="col-xs-4">
                            <label>Categoria</label>
                            <input type="text" class="form-control" name="categoria" id="tit_categoria" value="<?php echo $cartel_actual["categoria"] ?? ""; ?>">
                            <select class="form-control" id="sel_categoria" onchange="poner_cat();">
                                <?php
                                foreach ($cats as $cat) {
                                    echo '<option>' . $cat['categoria'] . '</option>';
                                } ?> </select>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <div class="ui-widget">
                                <label for="tit_origen">Fecha Desde</label>
                                <input type="text" size="20" name="v_desde" class="form-control" id="tit_fechaD" placeholder="Fecha de inicio de la publicacion" value="<?php echo $cartel_actual["v_desde"] ?? ""; ?>">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label>Fecha Hasta</label>
                            <input type="text" size="20" name="v_hasta" class="form-control" id="tit_fechaH" placeholder="Fecha de finalizacion de la publicacion" value="<?php echo $cartel_actual["v_hasta"] ?? ""; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>Plantilla</label>
                            <select name="plantilla" class="form-control" id="tit_Plantilla" onchange="preview();">
                                <?php
                                $plantillas = traer_nombres_plantillas("bootstrap/css/carteles.css");
                                $plantilla_seleccionada = $operacion == "alta" ? $plantillas[0] : $cartel_actual["plantilla"];
                                for($i = 0; $i < count($plantillas); $i++)
                                {
                                    echo "<option" . ($plantillas[$i] == $plantilla_seleccionada ? " selected" : "") . ">" . $plantillas[$i] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-xs-6">
                            <?php

                            if (($cartel_actual["activo"]  ?? "") == "1") {
                                $ch_a = "checked";
                            }
                            else{
                                $ch_a = "unchecked";
                            }

                            ?>
                            Activo<input type="checkbox" name="activo" id="tit_activo" <?php echo $ch_a;?>>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>Imagen Cuerpo</label>
                            <input id="t_file" type="text" name="imagen" class="form-control" value="<?php echo $cartel_actual["imagen"] ?? ""; ?>">
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label>Imagen Encabezado</label>
                                <input id="t_file1" type="text" name="imagen1" class="form-control" value="<?php echo $cartel_actual["imagen1"] ?? ""; ?>">
                            </div>

                        </div>




                    <button method="post" type="submit" class="btn btn-default"><?php echo $btn_txt; ?></button>

                </form>
                <form>
                    <div class="form-group">
                        <label>Subir Imagen Cuerpo</label>
                        <input type="file" id="fileToUpload" onchange="upload_image(0);PonerNombreArchivo(0);">

                    </div>
                    <div class="upload-msg"></div>
                    <!--Para mostrar la respuesta del archivo llamado via ajax -->

                </form>
                <form>
                    <div class="form-group">
                        <label>Subir Imagen Encabezado</label>
                        <input type="file" id="fileToUpload1" onchange="upload_image(1);PonerNombreArchivo(1);">
                    </div>
                    <div class="upload-msg"></div>
                    <!--Para mostrar la respuesta del archivo llamado via ajax -->

                </form>

            </div>
        </div>


    </div>
</div>