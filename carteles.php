<!DOCTYPE html>
<html lang="es">
<head>
    <?php 
        include_once("shared_head.php"); 
        include_once("libreria/db_object.php");
        if (!empty($_POST)) 
        {
            $copiaPOST = $_POST;
            $copiaPOST["activo"] = ($copiaPOST["activo"] ?? "") == "on" ? 1 : 0;
            handle_db_operation("carteles", $copiaPOST, $_GET["operacion"] ?? NULL);
            header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        }
    ?>
    <script src="js/carga_de_datos.js"></script>
    <script>
        $(document).ready(function ()
        {
            $("body").data("pagina_busqueda", "busqueda_c.php");
            $("body").data("pagina_form", "form_carteles.php");
        });

        function PonerNombreArchivo(id)
        {
            var f=["t_file","t_file1"];
            var dest=["fileToUpload","fileToUpload1"];
            var x = document.getElementById(dest[id]);
            var txt = "";
            var file = x.files[0];
                        
            txt = file.name ;
                
            document.getElementById(f[id]).value = txt;
        }   
    </script>
    <link rel="stylesheet" href="bootstrap/css/carteles.css">
</head>
<body>
    <?php include_once("navbar.php");?>

    <div class="container-fluid">
        <nav class="navbar navbar-default " role="navigation" >
            <ul class="nav navbar-nav" style="padding-top: 10px;padding-bottom: 0px;">
                <span style="padding-right: 20px;font-weight: bold;">Administracion Cartelera</span>
                <?php 
                if (isset($_SESSION['username']) && $_SESSION['rol']=='administrador'){
                    echo '<button type="button" class="btn btn-primary  btn-sm"   onclick="$(\'#capa_d\').load(\'form_carteles.php\', {\'operacion\': \'alta\'})">Alta</button>';  
                }
                ?>
            </ul>      
            <ul class="nav navbar-nav" style="padding-top: 10px;padding-bottom: 0px;">
                <input type="text"  id="txt_b" placeholder="Buscar" style="position: absolute;right: 100px;" >
                <button type="button" id="btn_b" class="btn btn-primary btn-sm" style="position: absolute;right: 20px;">Buscar</button>
            </ul>
        </nav>
        <div class="row">
            <div class="col-sm-6">
                <div id="capa_d">   </div>
            </div>
        
            <div class="col-sm-6">
                <div id="capa_L">   </div>
            </div>
        </div>
    </div> 
</body>
</html>