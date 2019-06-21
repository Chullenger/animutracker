<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  //if(trim($request->number) === '' || (float)$request->amount < 0)
  //{
  //  return http_response_code(400);
  //}

  // Sanitize.
  $nombre = mysqli_real_escape_string($con, trim($request->nombre));
  $calif = mysqli_real_escape_string($con, (float)$request->calif);
  $sinopsis = mysqli_real_escape_string($con, trim($request->sinopsis));
  
  $temporada = mysqli_real_escape_string($con, (int)$request->temporada);
    $fecha_est = mysqli_real_escape_string($con, trim($request->fecha_est));
  $idanimadora = mysqli_real_escape_string($con, (int)$request->idanimadoral);
    $idautor = mysqli_real_escape_string($con, (int)$request->idautor);
  $capitulos = mysqli_real_escape_string($con, (int)$request->episodios);
  
  
  $rating = mysqli_real_escape_string($con, (int)$request->rating);


  echo $postdata;

  // Create.
  $sql = "INSERT INTO `anime`(`idanime`,`nombre`,`calif`,`sinopsis`,´temporada´,`fecha_est`,´idanimadora´,´idautor´,´episodios´,`rating`) VALUES (null,'{$nombre}','{$calif}','{$sinopsis}','{$emporada}','{$fecha_est}','{$idanimadora}','{$idautor}','{$capitulos}','{$rating}')";

  //echo $sql;

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $anime = [
      'nombre' => $nombre,
      'calif' => $calif,
      'sinopsis' => $sinopsis,
    'temporada' => $temporada,
      'fecha_est' => $fecha_est,
     
       'idanimadora' => $idanimadora,
      'idautor' => $idautor,
     
        'episodios' => $capitulos,
      'rating' => $rating,
      'idmanga'    => mysqli_insert_id($con)
    ];
    //echo json_encode($manga);
  }
  else
  {
    http_response_code(422);
  }
}
?>