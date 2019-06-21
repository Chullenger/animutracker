<?php
require 'database.php';

// Extract, validmangaate and sanitize the idmanga.
$idanime = ($_GET['idanime'] !== null && (int)$_GET['idanime'] > 0)? mysqli_real_escape_string($con, (int)$_GET['idanime']) : false;

if(!$idanime)
{
  return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `ve` WHERE `idanime` ='{$idanime}' LIMIT 1";

if(mysqli_query($con, $sql))
{
  http_response_code(204);
}
else
{
  return http_response_code(422);
}


?>