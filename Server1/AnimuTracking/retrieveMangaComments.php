<?php
/**
 * Returns the list of manga.
 */
  require 'database.php';

  $comentariosList = [];
  session_start();
  $idsess = $_SESSION['ID'];
  $idmang = $_GET['idmanga'];

  $sql = "SELECT com.fecha,com.comentario,us.nombre FROM comentario com, manga m,usuario us WHERE {$idmang}=com.idmanga && m.idmanga={$idmang} && com.idusuario=us.idusuario;";

  $genres = $_GET['genres'];


  if($result = mysqli_query($con,$sql))
  {
    $i = 0;
    while($row = mysqli_fetch_assoc($result)) 
    {
      $comentariosList[$i]['idmanga'] = $idmang;
      $comentariosList[$i]['comentario'] = $row['comentario'];
      $comentariosList[$i]['name'] = $row['nombre'];
      $comentariosList[$i]['fecha'] = $row['fecha'];
      $comentariosList[$i]['sess'] = $idsess;
      $i++;
    }

    echo json_encode($comentariosList);
    }
  else
  {
    http_response_code(404);
  }
?>