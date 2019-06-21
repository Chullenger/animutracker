<?php
/**
 * Returns the list of manga.
 */
  require 'database.php';

  $mangaDatas = [];
  session_start();
  $idsess = $_SESSION['ID'];
  $idmang = $_GET['idmanga'];

  $sql = "SELECT m.idmanga,m.nombre, m.calif, m.sinopsis,m.fecha_est, m.fecha_fin, m.capitulos, m.tomos, m.rating,e.nombre nombre_ed, a.nombre nombre_aut, a.apellido apellido_aut,i.nombre ilust_nom,i.apellido ilust_apellido, l.my_calif my_calif, l.estado estado, l.capitulo cap_act FROM manga m, autor a, ilustrador i, dibuja d, editorial e ,lee l, usuario us WHERE m.idautor = a.idautor && m.ideditorial = e.ideditorial && i.idilustrador = d.ilustrador_idilustrador && {$idmang} = d.manga_idmanga && l.usuario_idusuario={$idsess} && us.idusuario=l.usuario_idusuario && l.manga_idmanga = {$idmang} && m.idmanga = {$idmang};";

  $genres = $_GET['genres'];


  if($result = mysqli_query($con,$sql))
  {
    $i = 0;
    while($row = mysqli_fetch_assoc($result)) 
    {
      $mangaDatas[$i]['idmanga'] = $row['idmanga'];
      $mangaDatas[$i]['nombre'] = $row['nombre'];
      $mangaDatas[$i]['calif'] = $row['calif'];
      $mangaDatas[$i]['sinopsis']    = $row['sinopsis'];
      $mangaDatas[$i]['fecha_est'] = $row['fecha_est'];
      $mangaDatas[$i]['fecha_fin'] = $row['fecha_fin'];
      $mangaDatas[$i]['capitulos'] = $row['capitulos'];
      $mangaDatas[$i]['tomos']    = $row['tomos'];
      $mangaDatas[$i]['rating'] = $row['rating'];
      $mangaDatas[$i]['ngenero'] = $genres;
      $mangaDatas[$i]['neditorial']    = $row['nombre_ed'];
      $mangaDatas[$i]['nautor'] = $row['nombre_aut'];
      $mangaDatas[$i]['apautor'] = $row['apellido_aut'];
      $mangaDatas[$i]['nilust'] = $row['ilust_nom'];
      $mangaDatas[$i]['apilust']    = $row['ilust_apellido'];
      $mangaDatas[$i]['my_calif'] = $row['my_calif'];
      $mangaDatas[$i]['estado'] = $row['estado'];
      $mangaDatas[$i]['cap_act'] = $row['cap_act'];
      $mangaDatas[$i]['sess'] = $idsess;
      $i++;
    }

    echo json_encode($mangaDatas);
    }
  else
  {
    http_response_code(404);
  }
?>