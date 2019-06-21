<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");
$idanime = $_POST['idanime'];
$idusuario = $_POST['idusuario'];

if(isset($postdata) && !empty($postdata))
{

  $sql = "INSERT INTO `ve`(`idanime`,`idusuario`,`fehca`,`evaluacion`,`estado`,`capitulos`) VALUES ('{$idanime}','{$idusuario}',null,'0','Viendo','1')";

  //echo $sql;

  if(mysqli_query($con,$sql))
  {
    header('Location: http://25.90.246.130:8080/htmls/Animes.php');
    exit;
    http_response_code(201);
    //echo json_encode($manga);
  }
  else
  {
    header('Location: http://25.90.246.130:8080/htmls/Animes.php');
    exit;
    http_response_code(422);
  }
}
?>