<?php

	require 'database.php';
	
	$id = $_POST['hidID'];
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$newPass = $_POST['newPass'];
	$hidPass = $_POST['hidPass'];
	$actPass = $_POST['actPass'];

	$sqlVerif = "SELECT idusuario FROM usuario WHERE contraseña = '{$actPass}' && idusuario='{$id}'";
	$resultVerif = mysqli_query($con, $sqlVerif);
	$totRow = mysqli_num_rows($resultVerif);

	$sql = "UPDATE usuario set nombre='{$nombre}', correo='{$correo}', contraseña='{$newPass}' WHERE idusuario='{$id}'";

	if($totRow==1){
		if(mysqli_query($con, $sql))
		{
  			http_response_code(204);
		}
		else
		{
  			return http_response_code(422);
		}
		$dir = "?idusuario={$id}&actPass={$actPass}&hidPass={$hidPass}&newPass={$newPass}&nombre={$nombre}&correo={$correo}";
		header('Location: http://25.68.45.54:8080/modificarUsuario.php'.$dir);
		exit;
	}
	else{
		echo "<script>
                alert('Contraseña Incorrecta');
                window.location= 'http://25.90.246.130:8080/htmls/editInfo.php';
    </script>";
	}
?>