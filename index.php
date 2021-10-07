<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once("shared_head.php"); ?>
    <script>
        $(document).ready(function(){
            $('#capa_C').load('mostrar_cartelera.php?b=Portada');
            $('li').click(function() {
                if (!$("#capa_P").is(":empty"))
                {
                    $("#capa_P").empty();
                    $("#n_proyecto").empty();
                }
            });
        });
    </script>
    <link rel="stylesheet" href="bootstrap/css/carteles.css">
</head>
<body>
    <?php include_once("navbar.php"); ?>
    <div class="container-fluid" id="capa_T">
        <!-- Columna de publicaciones digitales -->
        <div class="row"> 
            <div class="col-sm-3">
                <div id="capa_d">
                    <H3>BIBLIOTECA T1</H3>
                    <H4>Publicaciones Digitales</H4>
                    <ul class="nav nav-pills nav-stacked">
                        <li onclick="$('#capa_C').load('txts/origen.html')"><a href="#"><span>Origen</span></a></li>
                        <li onclick="$('#capa_C').load('txts/objetivo.html')"><a href="#"><span>Objetivo</span></a></li>
                        <li onclick="$('#capa_C').load('txts/tecnologias.html')"><a href="#"><span>Tecnologias</span></a></li>
                        <li onclick="$('#capa_C').load('txts/proyectos.html')"><a href="#"><span>Proyectos</a></span></li>
                        <li onclick="$('#capa_C').load('txts/referencias.html')"><a href="#"><span>Referencias</a></span></li>
                    </ul>
                </div>
            </div>

            <!-- Contenido de la publicacion digital seleccionada -->
            <div class="col-sm-6">
                <div id="capa_C">	
                    <div id="titulo">	</div>
                    <div id="contenido">	</div>
                    <H3></H3>
                </div>
            </div>

            <!-- Si seleccionaste "Proyectos" en la columna de pulbicaciones digitales, aca se pone el contenido del proyecto seleccionado -->
            <div class="col-sm-3" >
                <H4>
                <div id="n_proyecto"  style="color: RED"></div>
                <br><br></H4>
                <div id="capa_P" style="position: absolute"></div>
            </div>
        </div>
    </div>
</body>
</html>