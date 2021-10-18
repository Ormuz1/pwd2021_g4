<!DOCTYPE html>
<html lang="es">

<head>
    <?php 
        include_once("shared_head.php");
        include_once("funciones_db.php");
    ?>
</head>

<body>
    <?php
    include_once("navbar.php");
    $cart = seleccionar("carteles", "*", "WHERE categoria = 'Ayuda' AND activo = 1");
    if (isset($cart)) {
        foreach ($cart as $carteles) {
            echo '<div class="' . $carteles['plantilla'] . '" style="opacity: 1;">';
            if ($carteles['imagen1'] <> "") {
                $img_h = "recursos/imagenes/cartelera/" . $carteles['imagen1'];
                echo "<div style=\"background-image: url(" . $img_h . ");\"><header>
               <h1>$carteles[titulo]</h1>
               </header></div>";
            } else {
                echo "<header>
               <h1>$carteles[titulo]</h1>
               </header>";
            }



            if ($carteles['link'] <> "") {
                echo "<nav><a href='$carteles[link]' target='_blank'>$carteles[titulo] en la web</a></nav>";
            }
            echo "<article>$carteles[texto]</article>";


            if ($carteles['imagen'] <> "" && $carteles['texto1'] <> "" && $carteles['texto2'] <> "") {
                $img = 'recursos/imagenes/cartelera/' . $carteles['imagen'];
                echo "<div id='cartel_imagen' class='row'>";
                echo "<div class='col-sm-4'>$carteles[texto1]</div>";
                echo "<div class='col-sm-4'><img src='$img'></div>";
                echo "<div class='col-sm-4'>$carteles[texto2]</div>";
                echo "</div> ";
            }
            if ($carteles['imagen'] <> "" && $carteles['texto1'] == "" && $carteles['texto2'] == "") {
                $img = 'recursos/imagenes/cartelera/' . $carteles['imagen'];
                echo "<div id='cartel_imagen' class='row'>";
                echo "<div class='col-sm-2'>  </div>";
                echo "<div class='col-sm-10'><img src='$img'></div>";
                echo "</div> ";
            }
            if ($carteles['imagen'] <> "" && $carteles['texto1'] <> "" && $carteles['texto2'] == "") {
                $img = 'recursos/imagenes/cartelera/' . $carteles['imagen'];
                echo "<div id='cartel_imagen' class='row'>";
                echo "<div class='col-sm-6'>$carteles[texto1]</div>";
                echo "<div class='col-sm-6'><img src='$img'></div>";
                echo "</div> ";
            }
            if ($carteles['imagen'] <> "" && $carteles['texto1'] == "" && $carteles['texto2'] <> "") {
                $img = 'recursos/imagenes/cartelera/' . $carteles['imagen'];
                echo "<div id='cartel_imagen' class='row'>";
                echo "<div class='col-sm-6'><img src='$img'></div>";
                echo "<div class='col-sm-6'>$carteles[texto2]</div>";
                echo "</div> ";
            }


            if ($carteles['v_desde'] <> "" || $carteles['v_hasta'] <> "") {
                echo "<footer><h3>$carteles[v_desde] $carteles[v_hasta]</h3></footer>";
            }
            echo '</div><br>';
        }
    ?>
    <?php
    }
    ?>