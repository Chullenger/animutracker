<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  // Validate.
  //if ((int)$request->id < 1 || trim($request->number) == '' || (float)$request->amount < 0) {
    //return http_response_code(400);
  //}

  // Sanitize.
  
  $comentario = mysqli_real_escape_string($con, trim($request->comentario));
  $fecha = mysqli_real_escape_string($con, trim($request->fecha);

  // Update.
  $sql = "UPDATE `comentario` SET `comentario`='$comentario',`amount`='$fecha' WHERE `idcomentario` = '{$id}' LIMIT 1";

  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}
?>