<?php
require 'database.php';

// Get the posted data.
//$postdata = file_get_contents("php://input");
//$idAnime = $_POST['idan'];
//$idusuario = $_POST['idus'];
//$comentar = $_POST['com'];
$usuario = $_GET['usuario'];
$correo = $_GET['correo'];
$pass = $_GET['pass'];


  $sql = "INSERT INTO `usuario`(`idusuario`,`nombre`,`contraseña`,`correo`) VALUES (null,'{$usuario}','{$pass}','{$correo}')";

  //echo $sql;

  if(mysqli_query($con,$sql))
  {
    header('Location:http://25.90.246.130:8080/index.html');
    exit;
    http_response_code(201);
    //echo json_encode($manga);
  }
  else
  {
    header('Location:http://25.90.246.130:8080/index.html');
    exit;
    http_response_code(422);
  }





?>




