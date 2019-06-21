<?php
	require 'database.php';

  	$mangaDatas = [];
  	$idsess = $_GET['idusuario'];
  	$idmang = $_GET['idmanga'];
  	$cap = $_GET['mCapitulos'];
  	$es = $_GET['mEstado'];
  	$cal = $_GET['mCalificacion'];
	
  	// Update.
  	$sql = "UPDATE lee SET estado='$es',capitulo='$cap',my_calif='$cal' WHERE manga_idmanga = '{$idmang}' && usuario_idusuario='{$idsess}' LIMIT 1";

  	if(mysqli_query($con, $sql))
  	{
  		header('Location: http://25.90.246.130:8080/htmls/myMangas.php');
   		exit;
    	http_response_code(204);
  	}
  	else
  	{
  		header('Location: http://25.90.246.130:8080/htmls/myMangas.php');
    	exit;
  	  	return http_response_code(422);
  	}  
	
?>