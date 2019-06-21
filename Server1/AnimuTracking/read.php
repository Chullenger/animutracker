<?php
/**
 * Returns the list of manga.
 */
  require 'database.php';

  $manga = [];
  $sql = "SELECT * FROM manga";

  if($result = mysqli_query($con,$sql))
  {
    $i = 0;
    while($row = mysqli_fetch_assoc($result))
    {
      $manga[$i]['idmanga']    = $row['idmanga'];
      $manga[$i]['nombre'] = $row['nombre'];
      $manga[$i]['calif'] = $row['calif'];
      $manga[$i]['sinopsis']    = $row['sinopsis'];
      $manga[$i]['fecha__est'] = $row['fecha__est'];
      $manga[$i]['fecha_fin'] = $row['fecha_fin'];
      $manga[$i]['tomos']    = $row['tomos'];
      $manga[$i]['capitulos'] = $row['capitulos'];
      $manga[$i]['idautor'] = $row['idautor'];
      $manga[$i]['ideditorial']    = $row['ideditorial'];
      $manga[$i]['rating'] = $row['rating'];
      $i++;
    }

    echo json_encode($manga);
    }
  else
  {
    http_response_code(404);
  }
?>