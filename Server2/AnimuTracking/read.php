<?php
/**
 * Returns the list of manga.
 */
$sess = $_GET['sess'];
  require 'database.php';

  $anime = [];
  $sql = "SELECT * FROM anime";
    $genres="";
    $animadora="";
    $autor="";
    $animes_ve="";
  if($result = mysqli_query($con,$sql))
  {
    $i = 0;
    while($row = mysqli_fetch_assoc($result))
    {
      $anime[$i]['idanime']    = $row['idanime'];
      $anime[$i]['nombre'] = $row['nombre'];
      $anime[$i]['calif'] = $row['calif'];
      $anime[$i]['sinopsis']    = $row['sinopsis'];
      $anime[$i]['temporada']=$row['temporada'];
      $anime[$i]['fecha'] = $row['fecha_est'];
      $anime[$i]['idanimadora']    = $row['idanimadora'];
      $anime[$i]['idautor'] = $row['idautor'];
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
        $slqAnim="SELECT nombre From animadora where idanimadora={$row['idanimadora']}";
        if($resAni=mysqli_query($con,$slqAnim)){
            $k=0;
            while($rowH=mysqli_fetch_assoc($resAni)){
                $animadora=$rowH['nombre'];
                $k++;
            }
        }else{
            http_response_code(404);
        }
        $sqlGEN = "SELECT nombre,apellido FROM autor WHERE idautor={$row['idautor']}";
        if($resAut = mysqli_query($con,$sqlGEN)) //Obtendra la lista de generos
        {
          $j = 0;
          while($rowA = mysqli_fetch_assoc($resAut)) 
          {
            $autor  = "{$rowA['nombre']} {$rowA['apellido']}" ;
            $j++;
          }
          }
        else
        {
          http_response_code(404);
        }
        $sqlGEN = "SELECT idanime FROM ve WHERE idusuario={$sess}";
        if($resAut = mysqli_query($con,$sqlGEN)) //Obtendra la lista de generos
        {
          $j = 0;
          while($rowA = mysqli_fetch_assoc($resAut)) 
          {
            $animes_ve =$animes_ve.$rowA['idanime']." " ;
            $j++;  
          }
          }
        else
        {
          http_response_code(404);
        }
        $anime[$i]['sess']=$sess;
        $anime[$i]['autor']=$autor;
        $anime[$i]['animadora']=$animadora;
      $anime[$i]['genero'] = $genres;
        $anime[$i]['animes_ve']=$animes_ve;
      $anime[$i]['episodios'] = $row['episodios'];    
      $anime[$i]['rating'] = $row['rating'];
      $i++;
        $genres="";
    }
    
    echo json_encode($anime);
    }
  else
  {
    http_response_code(404);
  }
?>