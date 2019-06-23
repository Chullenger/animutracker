<?php
session_start();
$id = $_SESSION['ID'];
$name = $_SESSION['Nombre'];
$pass = $_SESSION['Password'];
$mail = $_SESSION['Correo'];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
      <link rel="icon" type="image/ico" href="../icons/icon.ico">
        <meta charset="utf-8">
        <title>Gestion de cuenta</title>

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" href="css/estilos.css">

    </head>
    <body id="EIB">
        <select class="custom-select mr-sm-2" onchange="muestra()" id="opt">
          <option>Editar</option>
          <option>Eliminar</option>
        </select>
          <div id="myDatas" class="d_visible">
            <form action="http://25.90.246.130:8080/modificarUsuario.php" method="POST">
              <b>Modificar Datos</b></br></br>
              <b>Nombre de Usuario</b></br>
              <input type="text" name="nombre" class="form-control" value="<?php echo $name ?>"></br>
              <b>Correo</b></br>
              <input type="text" name="correo" class="form-control" value="<?php echo $mail ?>"></br>
              <b>Nueva Contraseña</b></br>
              <input type="Password" name="newPass" class="form-control" value=""></br>
              <b>Contraseña Actual</b></br>
              <input type="Password" name="actPass" class="form-control" value=""></br>
              <input type="hidden" name="hidPass" value="<?php echo $pass ?>">
              <input type="hidden" name="hidID" value="<?php echo $id ?>">
              <input type="Submit" name="" class="btn btn-warning btn-center" value="Actualizar datos">
            </form>
          </div>
          <div id="elimDatas" class="d_hidden">
            <form action="http://25.90.246.130:8080/eliminarUsuario.php" method="POST">
              <b>Eliminar Cuenta</b></br></br>
              <b>Contraseña Actual</b></br>
              <input type="Password" name="actPassElim" class="form-control" value=""></br>
              <input type="hidden" name="hidPassElim" value="<?php echo $pass ?>">
              <input type="hidden" name="hidIDElim" value="<?php echo $id ?>">
              <input type="Submit" name="" class = "btn btn-danger btn-sm btn-center" value="Eliminar Cuenta">
            </form>
          </div>
          <img src="../icons/back.png" class="back_icon" onclick="back()" />
          <script>
            function muestra(){
              var elem = document.getElementById("opt").value;
              var divch = document.getElementById("myDatas");
              var divel = document.getElementById("elimDatas");
              if(elem == "Eliminar"){
                divch.setAttribute("class" , "d_hidden");
                divel.setAttribute("class" , "d_visible")
              }else{
                divch.setAttribute("class" , "d_visible");
                divel.setAttribute("class" , "d_hidden")
              }
            }
            function back(){
              window.history.back();
            }
          </script>
    </body>
</html>