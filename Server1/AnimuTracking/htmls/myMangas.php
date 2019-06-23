<!DOCTYPE html>
<html>
<head>
        <title>Animu Tracker</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/estilos.css">

        <script>
function showMyMangas(sel) {
  var obj, dbParam, xmlhttp, myObj, x, txt = "";
  obj = { table: sel, limit: 20 };
  dbParam = JSON.stringify(obj);
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myObj = JSON.parse(this.responseText);
      txt += "<table border='1' class = \"table table-bordered\">"
      for (x in myObj) {
        txt += "<tr>";
        txt += "<td class=\"td_img\"><img src=\"http://25.90.246.130:8080/portadas/" + myObj[x].nombre + ".jpg\"></td>";
        txt += "<td><p>" + myObj[x].nombre + "</br>" + "Sinopsis: " + myObj[x].sinopsis + "</br>" +  "Generos: "  +myObj[x].ngenero + "</br>" + "Capitulos: " + myObj[x].capitulos + "  Tomos: " + myObj[x].tomos + "</br>" + "Estreno: " + myObj[x].fecha_est + "  Fin: " + myObj[x].fecha_fin + "</br>" + "Calificacion: " + myObj[x].calif + "  Rating #" + myObj[x].rating +"</p></td>";
        txt += "<td><form method=\"POST\" action=\"http://25.90.246.130:8080/delete_leemanga.php\">  <input type=\"text\" name=\"manga_idmanga\" value=\"" + myObj[x].idmanga + " \" hidden=\"true\"> <input type=\"text\" name=\"usuario_idusuario\" value=\"" + myObj[x].sess +"\" hidden=\"true\"> <input type=\"Submit\" value=\"Eliminar de mi lista\" class=\"btn btn-primary\"> </form>";
        txt += "<form method=\"POST\" action=\"http://25.90.246.130:8080/htmls/showMangaInfo.php\">  <input type=\"text\" name=\"manga_idmanga\" value=\"" + myObj[x].idmanga + "\" hidden=\"true\"> <input type=\"text\" name=\"usuario_idusuario\" value=\"" + myObj[x].sess +"\" hidden=\"true\"> <input type=\"text\" name=\"all_genres\" value=\"" + myObj[x].ngenero +"\" hidden=\"true\"> <input type=\"Submit\" value=\"Mostrar Informacion.\" class=\"btn btn-primary\"> </form></td>";
        txt += "</tr>";
      }
      txt += "</table>";    
      document.getElementById("demo").innerHTML = txt;
      }
    };
  xmlhttp.open("POST", "http://25.90.246.130:8080/leemangas.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("x=" + dbParam);
}
window.onload = showMyMangas;
</script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top" id="menu">
  <a href="allMangas.php">Lista de Mangas</a>
  <a href="myMangas.php">Mis Mangas</a>
  <a href="Animes.php">Lista de Animes</a>
  <a href="MisAnimes.php">Mis Animes</a>
</nav>

<div class="user-info">
  <p id="usr"></p>

  <?php
  session_start();
  $nombre = $_SESSION['Nombre'];
  $mail = $_SESSION['Correo'];
  echo "<h4>".$nombre."</h4><br>";
  echo $mail;  
  ?>
<br>
  <a href="http://25.90.246.130:8080/htmls/editInfo.php">Gestion de Cuenta</a></br>
  <a href="http://25.90.246.130:8080/cerrarSesion.php">Cerrar Sesión</a>

</div>


<p id="demo"></p>


</body>
</html>