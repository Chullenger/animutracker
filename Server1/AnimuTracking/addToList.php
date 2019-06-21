<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");
$idManga = $_POST['manga_idmanga'];
$id = $_POST['usuario_idusuario'];

if(isset($postdata) && !empty($postdata))
{

  $sql = "INSERT INTO `lee`(`usuario_idusuario`,`manga_idmanga`,`estado`,`capitulo`) VALUES ('{$id}','{$idManga}','Leyendo','0')";

  //echo $sql;

  if(mysqli_query($con,$sql))
  {
    header('Location: http://25.90.246.130:8080/htmls/allMangas.php');
    exit;
    http_response_code(201);
    //echo json_encode($manga);
  }
  else
  {
    header('Location: http://25.90.246.130:8080/htmls/allMangas.php');
    exit;
    http_response_code(422);
  }
}
?>