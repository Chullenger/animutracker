<?php

require 'database.php';

// Extract, validmangaate and sanitize the idmanga.
$idmanga = ($_GET['idmanga'] !== null && (int)$_GET['idmanga'] > 0)? mysqli_real_escape_string($con, (int)$_GET['idmanga']) : false;

if(!$idmanga)
{
  return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `mangas` WHERE `idmanga` ='{$idmanga}' LIMIT 1";

if(mysqli_query($con, $sql))
{
  http_response_code(204);
}
else
{
  return http_response_code(422);
}
?>