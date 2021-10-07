<?php
include_once("libreria/db_object.php");

if (!empty($_POST)) 
{
    $operacion = $_POST['operacion'] ?? 'actualizar';
    if ($operacion == 'edicion') 
    {
        $id = $_POST['id_obj'];
        $persona_actual = traer_datos("personas", $id);
        $accion = "personas.php" . '?operacion=actualizar&id_obj=' . $id;
        $btn_txt = 'Actualizar';
        $leyenda = 'Modificar datos';
    }

    if ($operacion == 'baja') 
    {
        $id = $_POST['id_obj'];
        $persona_actual = traer_datos("personas", $id);
        $accion = "personas.php" . '?operacion=borrar&id_obj=' . $id;
        $btn_txt = 'Borrar';
        $leyenda = 'Eliminar';
    }

    if($operacion == 'alta')
	{
		$accion = "personas.php" . '?operacion=alta';
		$btn_txt = 'Subir';
		$leyenda = 'Registro Personas';
	}
}
?>

<div id="capa_d">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <legend><?php echo $leyenda; ?></legend>
                <form role="form" method="POST" action="<?php echo $accion; ?>">
                    <div class="row">
                        <?php
                        if (isset($operacion)) 
                        {
                            if ($operacion == 'edicion' || $operacion == 'baja') {
                        ?>
                        <div class="col-xs-2">
                            <label for="id_usuario">ID:</label>
                            <input id="id_obj" name="id" type="text" class="form-control" value="<?php echo $id; ?>" readonly/>
                        </div>
                        <?php
                            }
                        }
                        ?>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <label for="ejemplo_apellido">Nombre</label>
                                <input type="text" size="20" name="nombre" class="form-control" id="ejemplo_nombre" placeholder="Introduce el nombre" value="<?php echo $persona_actual["nombre"] ?? ""; ?>" />
                            </div>
                        </div>

                        <div class="col-xs-5">
                            <div class="form-group">
                                <label for="ejemplo_nombre">Apellido</label>
                                <input type="text" size="20" name="apellido" class="form-control" id="ejemplo_Apellido" placeholder="Introduce el Apellido" value="<?php echo $persona_actual["apellido"] ?? ""; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Sexo</label>
                                <div class="radio">
                                    <label>
                                        <?php
                                        if (($persona_actual["sexo"] ?? "") == 'Masculino') {
                                            $ch_m = "checked";
                                            $ch_f = "";
                                        }
                                        else
                                        {
                                            $ch_m = "";
                                            $ch_f = "checked";
                                        }
                                        ?>
                                        <input type="radio" name="sexo" id="sexo_1" value="Femenino" <?php echo $ch_f; ?>>
                                        Femenino
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="sexo" id="sexo_2" value="Masculino" <?php echo $ch_m; ?>>
                                        Masculino
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="ejemplo_dni">DNI</label>
                                <input type="text" size="20" name="dni" class="form-control" id="ejemplo_dni" placeholder="Introduce el DNI" value="<?php echo $persona_actual["dni"] ?? ""; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="ejemplo_email">email</label>
                                <input type="text" size="20" name="email" class="form-control" id="ejemplo_email" placeholder="correo electronico" value="<?php echo $persona_actual["email"] ?? ""; ?>" />
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="ejemplo_telefono">telefono-Movi</label>
                                <input type="text" size="20" name="telefono" class="form-control" id="ejemplo_telefono" placeholder="Telefono fijo o movil" value="<?php echo $persona_actual["telefono"] ?? ""; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Carrera</label>
                                <select class="form-control" name="carrera">
                                    <option><?php echo $persona_actual["carrera"] ?? ""; ?></option>
                                    <option>Electronica</option>
                                    <option>Construcciones</option>
                                    <option>Electromecanica</option>
                                    <option>Quimica</option>
                                    <option>Software</option>
                                    <option>Multimedia</option>
                                    <option>Redes</option>
                                    <option>Mecatronica</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Rol</label>
                                <select class="form-control" name="rol">
                                    <option><?php echo $persona_actual["rol"] ?? ""; ?></option>
                                    <option>Estudiante</option>
                                    <option>Docente</option>
                                    <option>Bibliotecario</option>
                                    <option>administrador</option>
                                    <option>Invitado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="ejemplo_user">Usuario</label>
                                <input type="text" size="20" name="user" class="form-control" id="ejemplo_user" placeholder="Nombre de usuario" value="<?php echo $persona_actual["user"] ?? ""; ?>" />
                            </div>
                        </div>
          
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="ejemplo_pass">Password</label>
                                <input type="password" size="20" name="txtPass" class="form-control" id="ejemplo_pass" placeholder="Cambiar Pass" value="" />
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="ejemplo_pass1">Repetir Pass</label>
                                <input type="password" size="20" name="txtPass1" class="form-control" id="ejemplo_pass1" placeholder="Cambiar Pass" value="" />
                            </div>
                        </div>
                    </div>
                    <button method="post" type="submit" class="btn btn-default"><?php echo $btn_txt; ?></button>
                </form>
            </div>
        </div>
    </div>
</div>