<?php
/**
 * Returns the list of manga.
 */
  require 'database.php';

  $usersDatas = [];
  $nombreIngresado = $_POST["user"];
  $pass = $_POST["pass"];

  $sql = "SELECT  idusuario, nombre, contraseña, correo, preferido FROM usuario where nombre = '{$nombreIngresado}' && contraseña = '{$pass}'";

  if($result = mysqli_query($con,$sql))
  {
    $i = 0;
    $success = false;
    while($row = mysqli_fetch_assoc($result))
    {
      $success=true;
      $usersDatas[$i]['idusuario']    = $row['idusuario'];
      $usersDatas[$i]['nombre'] = $row['nombre'];
      $usersDatas[$i]['contraseña'] = $row['contraseña'];
      $usersDatas[$i]['correo']    = $row['correo'];
      $usersDatas[$i]['preferido'] = $row['preferido'];
      $i++;
    }

    echo json_encode($usersDatas);
    }
  else
  {
    http_response_code(404);
  }

  if($success){
    session_start();
    $_SESSION['ID'] = $usersDatas[0]['idusuario'];
    $_SESSION['Nombre'] = $usersDatas[0]['nombre'];
    $_SESSION['Correo'] = $usersDatas[0]['correo'];
    $_SESSION['Password'] = $usersDatas[0]['contraseña'];
    header('Location: http://25.90.246.130:8080/htmls/allMangas.php');
    exit;
  }
  else{
    header('Location: http://25.90.246.130:8080');
    exit;
  }
?>