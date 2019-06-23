<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");
$idAnime = $_POST['idan'];
$idusuario = $_POST['idus'];
$comentar = $_POST['com'];

if(isset($postdata) && !empty($postdata))
{

  $sql = "INSERT INTO `comentario`(`idcomentario`,`comentario`,`fecha`,`idusuario`,`idanime`) VALUES (null,'{$comentar}',CURDATE(),'{$idusuario}','{$idAnime}')";

  //echo $sql;

  if(mysqli_query($con,$sql))
  {
    header('Location:http://25.90.246.130:8080/htmls/MisAnimes.php');
    exit;
    http_response_code(201);
    //echo json_encode($manga);
  }
  else
  {
    header('Location:http://25.90.246.130:8080/htmls/MisAnimes.php');
    exit;
    http_response_code(422);
  }
}
?>