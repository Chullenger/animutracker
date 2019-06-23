<?php
require 'database.php';

  	$mangaDatas = [];
  	$idsess = $_GET['idusuario'];
  	$idmang = $_GET['idanime'];
  	$cap = $_GET['mCapitulos'];
  	$es = $_GET['mEstado'];
  	$cal = $_GET['mCalificacion'];
	
  	// Update.
  	$sql = "UPDATE ve SET estado='{$es}',capitulos='{$cap}',evaluacion='{$cal}' WHERE idanime = '{$idmang}' && idusuario='{$idsess}' LIMIT 1";

  	if(mysqli_query($con, $sql))
  	{
  		header('Location: http://25.90.246.130:8080/htmls/MisAnimes.php');
   		exit;
    	http_response_code(204);
  	}
  	else
  	{
  		header('Location: http://25.90.246.130:8080/htmls/MisAnimes.php');
    	exit;
  	  	return http_response_code(422);
  	}  





?>