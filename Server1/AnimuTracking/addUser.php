<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$pass = $_POST['pass'];

if(isset($postdata) && !empty($postdata))
{

  $sql = "INSERT INTO `usuario`(`idusuario`,`nombre`,`contraseña`,`correo`,`preferido`) VALUES (null,'{$usuario}','{$pass}','{$correo}','Manga')";

  $sqlVali1 = "SELECT  nombre FROM usuario where nombre = '{$usuario}'";

  $result1 = mysqli_query($con,$sqlVali1);
  $totalFilas1 = mysqli_num_rows($result1); 
  
  $sqlVali2 = "SELECT  nombre FROM usuario where correo = '{$correo}'";

  $result2 = mysqli_query($con,$sqlVali2);
  $totalFilas2 = mysqli_num_rows($result2); 

  //echo $sql;

  if($totalFilas1==0&&$totalFilas2==0){
  if(mysqli_query($con,$sql))
  {
    $dir = "?usuario={$usuario}&pass={$pass}&correo={$correo}";
    header('Location: http://25.68.45.54:8080/addUser.php'.$dir);
    exit;
    http_response_code(201);
    //echo json_encode($manga);
  }
  else
  {
    
    http_response_code(422);
  }
  }
  else{
    echo "<script>
                alert('Ya existe un usuario con el nombre o correo ingresado');
                window.location= 'http://25.90.246.130:8080/index.html';
    </script>";
  }
}
?>