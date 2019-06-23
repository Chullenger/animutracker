<?php

require 'database.php';

// Extract, validmanga and sanitize the idmanga.
$idcom = $_POST['idcomen'];
session_start();


$sql = "DELETE FROM `comentario` WHERE `idcomentario` ='{$idcom}' LIMIT 1";

if(mysqli_query($con, $sql))
{
  http_response_code(204);
}
else
{
  return http_response_code(422);
}
header('Location: http://25.90.246.130:8080/htmls/myMangas.php');
exit;
?>