<?php
require 'database.php';
$idanime = ($_GET['idanime'] !== null && (int)$_GET['idanime'] > 0)? mysqli_real_escape_string($con, (int)$_GET['idanime']) : false;
if(!$idanime)
{
  return http_response_code(400);
}
$sql = "SELECT eval,fecha FROM evaluacion where idanime={$idanime}";

  if($result = mysqli_query($con,$sql))
  {
    $i = 0;
    while($row = mysqli_fetch_assoc($result))
    {
      $eval[$i]['eval']=$row['eval'];
      $eval[$i]['fecha']=$row['fecha'];
      $i++;
    }

    echo json_encode($eval);
    }
  else
  {
    http_response_code(404);
  }



?>