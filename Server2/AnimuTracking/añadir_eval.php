<?php
require 'database.php';
$idusuario = ($_GET['idusuario'] !== null && (int)$_GET['idusuario'] > 0)? mysqli_real_escape_string($con, (int)$_GET['idusuario']) : false;
$idanime = ($_GET['idanime'] !== null && (int)$_GET['idanime'] > 0)? mysqli_real_escape_string($con, (int)$_GET['idanime']) : false;

if(!$idanime || !$idusuario)
{
  return http_response_code(400);
}
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
  $evaluacion = mysqli_real_escape_string($con, trim($request->evaluacion));
    $fecha = mysqli_real_escape_string($con, trim($request->fecha));
  echo $postdata;

  // Create.
  $sql = "INSERT INTO `evaluacion`(`idevaluacion`,`eval`,`fecha`,`idusuario`,`idanime`) VALUES (null,'{$evaluacion}','{$fecha},'{$idusuario}','{$idanime}')";
    if(mysqli_query($con,$sql)){
        http_response_code(201);
  }
  else
  {
    http_response_code(422);
  }
}



?>