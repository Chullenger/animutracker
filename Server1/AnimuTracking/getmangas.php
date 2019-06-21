<?php
/**
 * Returns the list of manga.
 */
  require 'database.php';

  session_start();
  $idsess = $_SESSION['ID'];

  $mangaDatas = [];

  $mangas_lee="";
  
  $sql = "SELECT m.idmanga, m.nombre, m.calif, m.sinopsis,m.fecha_est, m.fecha_fin, m.capitulos, m.tomos, m.rating FROM manga m";

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
      $sqlGEN = "SELECT g.nombre FROM manga m, genero g, m_es mes WHERE g.idgenero=mes.genero_idgenero && mes.manga_idmanga = m.idmanga && m.idmanga={$row['idmanga']}";


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
      $mangaDatas[$i]['tomos']    = $row['tomos'];
      $mangaDatas[$i]['rating'] = $row['rating'];
      $mangaDatas[$i]['sess'] = $idsess;
      $sqlLEE = "SELECT manga_idmanga FROM lee WHERE usuario_idusuario={$idsess}";
        if($resAut = mysqli_query($con,$sqlLEE)) //Obtendra la lista de generos
        {
          $l = 0;
          while($rowA = mysqli_fetch_assoc($resAut)) 
          {
            $mangas_lee =$mangas_lee.$rowA['manga_idmanga']." " ;
            $l++;  
          }
          }
        else
        {
          http_response_code(404);
        }
        $mangaDatas[$i]['lista']=$mangas_lee;
      $genres = "";
      $i++;
      //echo $mangaDatas[$i];
    }

    echo json_encode($mangaDatas);
    }
  else
  {
    http_response_code(404);
  }
?>