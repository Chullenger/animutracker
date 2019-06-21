<?php
require 'database.php';

// Extract, validmangaate and sanitize the idmanga.
$idcomentario = ($_GET['idcomentario'] !== null && (int)$_GET['idcomentario'] > 0)? mysqli_real_escape_string($con, (int)$_GET['idcomentario']) : false;

if(!$idcomentario)
{
  return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `comentario` WHERE `idcomentario` ='{$idcomentario}' LIMIT 1";

if(mysqli_query($con, $sql))
{
  http_response_code(204);
}
else
{
  return http_response_code(422);
}

?>