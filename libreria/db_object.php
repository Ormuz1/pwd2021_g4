<?php
define ('DB_HOST','localhost');
define ('DB_USER','root');
define ('DB_PASS','');
define ('DB_NAME','biblio_t1');
$objConexion = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);


function guardar($nombreTabla, $datosFila)
{
    $nombresColumnas = join(",", array_keys($datosFila));
    $valoresColumnas = join("\",\"", array_values($datosFila));
    print_r($valoresColumnas);
    $sql="INSERT INTO $nombreTabla ($nombresColumnas) " .
    "VALUES ($valoresColumnas)";
    if($GLOBALS["objConexion"]->query($sql) === TRUE)
    {
        echo "Exito";
    }
    else 
    {
        die(mysqli_error($GLOBALS["objConexion"]));
    }
}
    
    
function actualizar($nombreTabla, $datosFila, $id)
{
    $nombrePk = get_table_primary_key($nombreTabla);

    $sql = "UPDATE " . $nombreTabla . " SET ";
    foreach($datosFila as $columna => $data)
    {
        $sql .= "$columna=" . (is_string($data) ? "\"$data\"" : "$data") . ", ";
    }
    $sql = rtrim($sql, ", ");

    $sql .= " WHERE " . $nombrePk . "=" . $id;
    if($GLOBALS["objConexion"]->query($sql) !== TRUE)
    {
        die(mysqli_error($GLOBALS["objConexion"]));
    }
}


function borrar($nombreTabla, $id)
{
    $nombrePk = get_table_primary_key($nombreTabla);
    $sql = "DELETE FROM $nombreTabla WHERE $nombrePk=$id";
    if($GLOBALS["objConexion"]->query($sql) === TRUE)
    {
        echo "Exito";
    }
    else 
    {
        echo mysqli_error($GLOBALS["objConexion"]);
        echo "Fracaso";
    }
}


function traer_datos($nombreTabla, $id)
{
    $nombrePk = get_table_primary_key($nombreTabla);
    $sql = "SELECT * FROM $nombreTabla WHERE $nombrePk=$id";
    return $GLOBALS["objConexion"]->query($sql)->fetch_assoc();
}


function get_table_primary_key($nombreTabla)
{
    return $GLOBALS["objConexion"]->query("SHOW KEYS FROM $nombreTabla WHERE Key_name = 'PRIMARY'")->fetch_assoc()['Column_name'];
}


function buscar($nombreTabla, $terminoBusqueda, $columnas = null, $orden = null)
{
    $sql = "SELECT * FROM $nombreTabla WHERE";
    if($columnas === null) $columnas = array_keys(listar_columnas($nombreTabla));
    foreach($columnas as $columna)
    {
        $sql .= " $columna LIKE \"%$terminoBusqueda%\" OR";
    }
    $sql = rtrim($sql, "OR"); // take out the last "OR" statement from the querys
    if($orden !== null) $sql .= "ORDER BY $orden";
    return $GLOBALS["objConexion"]->query($sql)->fetch_all(MYSQLI_ASSOC);
}


function seleccionar($nombreTabla, $columnas = "*", $extraClauses = "")
{
    $sql = "SELECT $columnas FROM $nombreTabla $extraClauses";
    return $GLOBALS["objConexion"]->query($sql)->fetch_all(MYSQLI_ASSOC);
}


function mostrar_todos($nombreTabla)
{
    $sql = "SELECT * FROM $nombreTabla";
    return $GLOBALS["objConexion"]->query($sql)->fetch_all(MYSQLI_ASSOC);
}


function listar_columnas($nombreTabla)
{
    $sql = "SHOW COLUMNS FROM $nombreTabla";
    $columnas = $GLOBALS["objConexion"]->query($sql);
    while ($fila = $columnas->fetch_assoc())
    {
        $resultado[$fila["Field"]] = "";
    }
    return $resultado;
}


function handle_db_operation($tableName, $data, $operation)
{
    $id = false;
    if (isset($data["id"]))
    {
        $id = $data["id"];
        unset($data["id"]);
    }
    if ($operation == 'alta' && !$id)
    {
        guardar($tableName, $data);
    }
    
    else if ($operation == 'actualizar' && $id)
    {
        actualizar($tableName, $data,  $id);
    }
    
    else if ($operation == 'borrar' &&  $id)
    {
        borrar($tableName,  $id);
    }
    elseif ($operation == 'prestar' && $id)
    {
        $magnitud = "";
        switch($_POST['magnitud_tiempo'])
        {
            case "dia":
                $magnitud = "D";
                break;
            case "semana":
                $magnitud = "W";
                break;
            case "mes":
                $magnitud = "M";
                break;
            
            }
        $fecha_devolucion = (new DateTime())->add(new DateInterval("P{$_POST['cantidad_tiempo']}$magnitud"))->format("Y-m-d");
        $query1 = "UPDATE libros_d SET prestado = 1 WHERE libros_d.id_libro = {$_GET['id_lib']}";
        $query2 = "INSERT INTO prestamos_libros(fecha_devolucion, libro_prestado, receptor_prestamo) VALUES ('$fecha_devolucion', {$_GET['id_lib']}, {$_POST['receptor']})";

        mysqli_query($GLOBALS["objConexion"]->enlace, $query1);
        mysqli_query($GLOBALS["objConexion"]->enlace, $query2);
    }
}


function traer_nombres_plantillas($filePath)
{
    $plantillas = file_get_contents($filePath);
    preg_match_all("/\.\w+\s*{/", $plantillas, $resultado);
    return array_map(function($item) {return rtrim(substr($item, 1, -1));},
    $resultado[0]);
}