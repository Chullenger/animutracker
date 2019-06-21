<?php

  require 'database.php';
    
  $animeDatas = [];
  $iduser =$_GET['sess'];

  $sql = "SELECT m.idanime, m.nombre, m.calif, m.sinopsis,m.fecha_est, m.episodios, m.temporada, m.rating,e.nombre nombre_anima, a.nombre nombre_aut, a.apellido apellido_aut FROM anime m, autor a,ve l,animadora e, usuario us WHERE m.idautor = a.idautor && m.idanimadora = e.idanimadora && l.idusuario={$iduser} && us.idusuario=l.idusuario && l.idanime = m.idanime";

  $genres = "";




  if($result = mysqli_query($con,$sql))
  {
    $i = 0;
    while($row = mysqli_fetch_assoc($result)) 
    {
      $animeDatas[$i]['idanime']    = $row['idanime'];
      $animeDatas[$i]['nombre'] = $row['nombre'];
      $animeDatas[$i]['calif'] = $row['calif'];
      $animeDatas[$i]['sinopsis']    = $row['sinopsis'];
      $animeDatas[$i]['fecha_est'] = $row['fecha_est'];
      $animeDatas[$i]['episodios'] = $row['episodios'];
      $animeDatas[$i]['temporada']    = $row['temporada'];
      $animeDatas[$i]['rating'] = $row['rating'];
       $sqlGEN = "SELECT g.nombre FROM anime m, genero g, a_es mes WHERE g.idgenero=mes.idgenero && mes.idanime = m.idanime && m.idanime={$row['idanime']}";
        if($resGen = mysqli_query($con,$sqlGEN)) //Obtendra la lista de generos
        {
          $j = 0;
          while($rowG = mysqli_fetch_assoc($resGen)) 
          {
            $genres  = $genres  . $rowG['nombre']. " ";
            $j++;
          }
          }
        else
        {
          http_response_code(404);
        }
      $anime[$i]['sess']=$iduser;
      $animeDatas[$i]['ngenero'] = $genres;
      $animeDatas[$i]['animadora']    = $row['nombre_anima'];
      $animeDatas[$i]['autor'] = $row['nombre_aut']. " ".$row['apellido_aut'];
      
      $genres = "";
      $i++;
    }

    echo json_encode($animeDatas);
    }
  else
  {
    http_response_code(404);
  }

?>