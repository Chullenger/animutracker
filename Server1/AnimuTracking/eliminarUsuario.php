<?php

	require 'database.php';
	
	$id = $_POST['hidIDElim'];
	$hidPass = $_POST['hidPassElim'];
	$actPass = $_POST['actPassElim'];

	$sqlVerif = "SELECT idusuario FROM usuario WHERE contraseña = '{$actPass}' && idusuario='{$id}'";
	$resultVerif = mysqli_query($con, $sqlVerif);
	$totRow = mysqli_num_rows($resultVerif);

	$sql = "DELETE FROM usuario WHERE idusuario ={$id}";
	$sql2 = "DELETE FROM lee WHERE usuario_idusuario ={$id}";

	echo $sql;
	if($totRow==1){
		mysqli_query($con, $sql2);
		if(mysqli_query($con, $sql))
		{
  			http_response_code(204);
		}
		else
		{
  			return http_response_code(422);
		}
		$dir = "?idusuario={$id}";
		header('Location: http://25.68.45.54:8080/eliminarUsuario.php'.$dir);
		exit;
	}
	else{
    echo "<script>
                alert('Contraseña incorrecta');
                window.location= 'http://25.90.246.130:8080/index.html';
    </script>";
	}
?>