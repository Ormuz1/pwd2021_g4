<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once("shared_head.php"); ?>
    <link rel="stylesheet" href="recursos/css/carteles.css">
</head>
<body>
    <?php
    include_once("navbar.php");
    include_once("funciones_db.php");

    $cats = seleccionar("carteles", "DISTINCT categoria");
    ?>
    <div class="container-fluid" >
        <div class="row">
            <div class="col-sm-4">
                <div id="capa_d">
                    <H3>BIBLIOTECA T1</H3>
                    <H4>Cartelera</H4>
                    <!-- La siguiente lista guarda botones que te permiten seleccionar categorias de carteles.
                    La lista se construye automaticamente con los carteles obtenidos de la base de datos
                    -->
                    <ul class="nav nav-pills nav-stacked">
                        <?php
                        foreach($cats as $cat){
                            echo '
                            <li onclick="$(\'#capa_C\').load(\'mostrar_cartelera.php?b='.$cat['categoria']
                            . '\')"><a href="#"><span>'
                            . $cat['categoria']
                            . '</span></a></li>';
                        }	  
                        ?>          
                    </ul>
                </div>
            </div>
            <!-- En el div capa_C se carga el contenido de todos los carteles de la categoria seleccionada -->
            <div class="col-sm-8">
                <div id="capa_C">   </div>
            </div>	
        
        </div> 
    </div>
</body>
</html>