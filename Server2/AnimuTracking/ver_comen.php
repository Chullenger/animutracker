<?php
require 'database.php';
$idanime = ($_GET['idanime'] !== null && (int)$_GET['idanime'] > 0)? mysqli_real_escape_string($con, (int)$_GET['idanime']) : false;
if(!$idanime)
{
  return http_response_code(400);
}
$sql = "SELECT comentario,fecha FROM comentario where idanime={$idanime}";

  if($result = mysqli_query($con,$sql))
  {
    $i = 0;
    while($row = mysqli_fetch_assoc($result))
    {
      $comentario[$i]['comentario']=$row['comentario'];
      $comentario[$i]['fecha']=$row['fecha'];
      $i++;
    }

    echo json_encode($comentario);
    }
  else
  {
    http_response_code(404);
  }
?>