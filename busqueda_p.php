<?php
include_once("funciones_db.php");

$str_b =  $_GET['b'];
$pers = buscar("personas", $str_b, array("carrera", "user", "nombre", "apellido", "dni"));

?>
<?php
if (isset($pers)){
?>

<div class="panel panel-default " >
 
  <div class="panel-heading " >Personas Encontradas</div> 
	<div  style="overflow: scroll;height: 350px;"> 	  
	 <table class="tabla_edicion table table-hover">
	  <thead>
			  <tr>
			  <th id="proceso">Id</th>
              <th>Nombre</th>
			  <th>Apellido</th>
			  <th>Usuario</th>
			  <th>Rol</th>
			  
			  </tr>
		  </thead>
	   
	  <tbody>
	 
	  
	  <?php
		  foreach($pers as $personas){
		   echo "
		   <tr>
		   <td>$personas[id]</td>
		   <td>$personas[nombre]</td>
		   <td>$personas[apellido]</td>
		   <td>$personas[user]</td>
		   <td>$personas[rol]</td>";
	  
	     echo '<td><button class="btn btn-primary btn-xs" onclick="editar(' . $personas['id'] . ')" >Editar</button></td>';
		 echo '<td><button class="btn btn-primary btn-xs" onclick="borrar(' . $personas['id'] . ')" >Borrar</button></td>';
         
		  echo " </tr> ";
		   }
	  ?>
	
	  </tbody>
	  
	  </table>
  
	  </div></div>
	  </div>
	 
	  
<?php
}
?>