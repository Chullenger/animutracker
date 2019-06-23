<?php
/**
 * Returns the list of manga.
 */
  require 'database.php';

  $comentariosList = [];
  session_start();
  $idsess = $_GET['idusuario'];
  $idanime = $_GET['idanime'];

  $sql = "SELECT com.idcomentario,com.fecha,com.comentario,us.nombre,com.idusuario FROM comentario com, anime m,usuario us WHERE {$idanime}=com.idanime && m.idanime={$idanime} && com.idusuario=us.idusuario";

  $genres = $_GET['genres'];


  if($result = mysqli_query($con,$sql))
  {
    $i = 0;
    while($row = mysqli_fetch_assoc($result)) 
    {
      $comentariosList[$i]['idanime'] = $idanime;
      $comentariosList[$i]['idcomentario']=$row['idcomentario'];
      $comentariosList[$i]['comentario'] = $row['comentario'];
      $comentariosList[$i]['name'] = $row['nombre'];
      $comentariosList[$i]['fecha'] = $row['fecha'];
      $comentariosList[$i]['sess'] = $idsess;
      $comentariosList[$i]['idusuario']=$row['idusuario'];
      $i++;
    }

    echo json_encode($comentariosList);
    }
  else
  {
    http_response_code(404);
  }
?>