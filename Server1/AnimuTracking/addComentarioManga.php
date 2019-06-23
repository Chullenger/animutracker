<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");
$idManga = $_POST['idmg'];
$idusuario = $_POST['idus'];
$comentar = $_POST['com'];

if(isset($postdata) && !empty($postdata))
{

  $sql = "INSERT INTO `comentario`(`idcomentario`,`comentario`,`fecha`,`idusuario`,`idmanga`) VALUES (null,'{$comentar}',CURDATE(),'{$idusuario}','{$idManga}')";

  //echo $sql;

  if(mysqli_query($con,$sql))
  {
    header('Location:http://25.90.246.130:8080/htmls/myMangas.php');
    exit;
    http_response_code(201);
    //echo json_encode($manga);
  }
  else
  {
    header('Location:http://25.90.246.130:8080/htmls/myMangas.php');
    exit;
    http_response_code(422);
  }
}
?>