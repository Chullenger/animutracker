<?php

require 'database.php';

// Extract, validmanga and sanitize the idmanga.
$idmanga = ($_GET['idmanga'] !== null && (int)$_GET['idmanga'] > 0)? mysqli_real_escape_string($con, (int)$_GET['idmanga']) : false;
$idusuario = "1"
if(!$idmanga)
{
  return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `lee` WHERE `manga_idmanga` ='{$idmanga}' && `usuario_idusuario` = `{$idusuario}`LIMIT 1";

if(mysqli_query($con, $sql))
{
  http_response_code(204);
}
else
{
  return http_response_code(422);
}
?>