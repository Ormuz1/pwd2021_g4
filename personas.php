<!DOCTYPE html>
<html>
<head>
    <?php 
        include_once("shared_head.php"); 
        include_once("funciones_db.php");
        
        
        if (!isset($_SESSION['username']) || $_SESSION['rol']!='administrador')
        {
            exit;
        }
        
        if (!empty($_POST)) 
        {   
            // Validamos y encriptamos la contraseña
            $copia_post = $_POST;
            $validez_passwd = $_POST['txtPass'] != "" && $_POST['txtPass1'] != "" && ($_POST['txtPass'] == $_POST['txtPass1']);
            $copia_post["passwd"] = $validez_passwd ? md5($copia_post["txtPass"]) : md5("1234");
            unset($copia_post["txtPass"], $copia_post["txtPass1"]);
            
            handle_db_operation("personas", $copia_post, $_GET["operacion"] ?? "alta");
            header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        }
    ?>
    <script src="recursos/js/carga_de_datos.js"></script>
    <script>
        $(document).ready(function ()
        {
            $("body").data("pagina_busqueda", "busqueda_p.php");
            $("body").data("pagina_form", "form_personas.php");
        });
    </script>
</head>
<body>
    <?php include_once("navbar.php"); ?>
    <div class="container-fluid">
        <nav class="navbar navbar-default " role="navigation" >
            <ul class="nav navbar-nav" style="padding-top: 10px;padding-bottom: 0px;">
                <span style="padding-right: 20px;font-weight: bold;">Usuarios</span>
                <button type="button" class="btn btn-primary  btn-sm"   onclick="$('#capa_d').load('form_personas.php', {'operacion': 'alta'})">Alta</button>
            </ul>      
            <ul class="nav navbar-nav" style="padding-top: 10px;padding-bottom: 0px;">
                <input type="text"  id="txt_b" placeholder="Buscar" style="position: absolute;right: 100px;" >
                <button type="button" id="btn_b" class="btn btn-primary btn-sm" style="position: absolute;right: 20px;">Buscar</button>
            </ul>
        </nav>
    </div> 

    <div class="row">
        <div class="col-sm-6">
            <div id="capa_d">   </div>
        </div>

        <div class="col-sm-6">
            <div id="capa_L">   </div>
        </div>
    </div>
</body>

</html>