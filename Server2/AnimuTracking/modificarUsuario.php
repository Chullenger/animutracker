<?php

    require 'database.php';
	
	$id = $_GET['idusuario'];
	$nombre = $_GET['nombre'];
	$correo = $_GET['correo'];
	$newPass = $_GET['newPass'];
	$hidPass = $_GET['hidPass'];
	$actPass = $_GET['actPass'];
    
    $sql = "UPDATE usuario set nombre='{$nombre}', correo='{$correo}', contraseña='{$newPass}' WHERE idusuario='{$id}'";

    if(mysqli_query($con, $sql))
		{
  			http_response_code(204);
		}
		else
		{
  			return http_response_code(422);
		}
    header('Location: http://25.90.246.130:8080/htmls/allMangas.php');
		exit;

?>
    

    
    
   