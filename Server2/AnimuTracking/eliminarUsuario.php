<?php

	require 'database.php';
	
	$id = $_GET['idusuario'];
	//$hidPass = $_POST['hidPassElim'];
	//$actPass = $_POST['actPassElim'];

	$sql = "DELETE FROM `usuario` WHERE `idusuario` ='{$id}' LIMIT 1";
    $slq2 ="DELETE FROM `ve` WHERE `idusuario` ='{$id}' LIMIT 1";

	mysqli_query($con,$slq2);
		if(mysqli_query($con, $sql))
		{    
            
  			http_response_code(204);
		}
		else
		{
  			return http_response_code(422);
		}
		//$dir = "?idusuario={$id}";
		header('Location: http://25.90.246.130:8080/index.html');
		exit;
	
?>