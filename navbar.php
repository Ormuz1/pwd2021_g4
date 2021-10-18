<div id="background"> </div>
<div class="container-fluid" >
    <nav class="navbar navbar-inverse navbar-static-top navbar2" role="navigation" >
        <ul class="nav navbar-nav ">
            <li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
            <li><a href="cartelera.php">Cartelera</a></li>
            <li><a href="libreria.php">Libros</a></li>
            <li><a href="ayuda.php">Ayuda</a></li>
            <?php 
            if (isset($_SESSION['username']) && $_SESSION['rol']=='administrador'){
                echo '<li><a href="personas.php">Usuarios</a></li>';
                echo '<li><a href="carteles.php">Carteles</a></li>';
            }
            ?>
        </ul>

        <ul class="nav navbar-nav navbar-right" style="padding-right: 10px;">
            <?php 
            if (isset($_SESSION['username'])) {
                echo " <li class='navbar-brand'>Cantidad de usuarios conectados: <span id='contador_usuarios'></span></li>";
                echo ' <li class="navbar-brand">'.$_SESSION['rol'].' : '.$_SESSION['username'].'</li>'; 
            }
            if (!isset($_SESSION['username'])) {
                echo '	  
                    <li><a href="registro.php"  data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user"></span> Registro</a></li>
                    ';
                echo '	  
                    <li><a href="login.php" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    ';
            }	 
            else {
                echo '	  
                    <li><a href="i_chat.php">Chat</a></li>
                    <li><a href="logout.php" ><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    ';
            }
            ?>		   
        </ul>    	 
    </nav>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body"> <p></p> </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
