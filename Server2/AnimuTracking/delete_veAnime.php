<?php

require 'database.php';

// Extract, validmanga and sanitize the idmanga.
$idanime = $_POST['idanime'];
session_start();
$idusuario = $_POST['idusuario'];

echo $idanime;
echo "------";
echo $idusuario;
if(!$idanime)
{
  return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `ve` WHERE `idanime` ='{$idanime}' && `idusuario` = '{$idusuario}' LIMIT 1";

if(mysqli_query($con, $sql))
{
  http_response_code(204);
}
else
{
  return http_response_code(422);
}
header('Location: http://25.90.246.130:8080/htmls/MisAnimes.php');
exit;
?>