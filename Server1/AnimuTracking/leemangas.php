<?php
/**
 * Returns the list of manga.
 */
  require 'database.php';

  $mangaDatas = [];
  session_start();
  $idsess = $_SESSION['ID'];

  $sql = "SELECT m.idmanga, m.nombre, m.calif, m.sinopsis,m.fecha_est, m.fecha_fin, m.capitulos, m.tomos, m.rating,e.nombre nombre_ed, a.nombre nombre_aut, a.apellido apellido_aut,i.nombre ilust_nom,i.apellido ilust_apellido FROM manga m, autor a, ilustrador i, dibuja d, editorial e ,lee l, usuario us WHERE m.idautor = a.idautor && m.ideditorial = e.ideditorial && i.idilustrador = d.ilustrador_idilustrador && m.idmanga = d.manga_idmanga && l.usuario_idusuario={$idsess} && us.idusuario=l.usuario_idusuario && l.manga_idmanga = m.idmanga;";

  $genres = "";


  if($result = mysqli_query($con,$sql))
  {
    $i = 0;
    while($row = mysqli_fetch_assoc($result)) 
    {
      $mangaDatas[$i]['idmanga']    = $row['idmanga'];
      $mangaDatas[$i]['nombre'] = $row['nombre'];
      $mangaDatas[$i]['calif'] = $row['calif'];
      $mangaDatas[$i]['sinopsis']    = $row['sinopsis'];
      $mangaDatas[$i]['fecha_est'] = $row['fecha_est'];
      $mangaDatas[$i]['fecha_fin'] = $row['fecha_fin'];
      $mangaDatas[$i]['capitulos'] = $row['capitulos'];
      $mangaDatas[$i]['tomos']    = $row['tomos'];
      $mangaDatas[$i]['rating'] = $row['rating'];
      $sqlGEN = "SELECT g.nombre FROM manga m, genero g, m_es mes,lee l, usuario us WHERE g.idgenero=mes.genero_idgenero && mes.manga_idmanga = m.idmanga && m.idmanga={$row['idmanga']} && l.usuario_idusuario={$idsess} && us.idusuario=l.usuario_idusuario && l.manga_idmanga = m.idmanga";
  

        if($resGen = mysqli_query($con,$sqlGEN)) //Obtendra la lista de generos
        {
          $j = 0;
          while($rowG = mysqli_fetch_assoc($resGen)) 
          {
            $genres  = $genres . " " . $rowG['nombre'];
            $j++;
          }
          }
        else
        {
          http_response_code(404);
        }
      $mangaDatas[$i]['ngenero'] = $genres;
      $mangaDatas[$i]['neditorial']    = $row['nombre_ed'];
      $mangaDatas[$i]['nautor'] = $row['nombre_aut'];
      $mangaDatas[$i]['apautor'] = $row['apellido_aut'];
      $mangaDatas[$i]['nilust'] = $row['ilust_nom'];
      $mangaDatas[$i]['apilust']    = $row['ilust_apellido'];
      $mangaDatas[$i]['sess'] = $idsess;
      $genres = "";
      $i++;
    }

    echo json_encode($mangaDatas);
    }
  else
  {
    http_response_code(404);
  }
?>