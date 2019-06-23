<!DOCTYPE html>
<html>
<head>
        <title>Animu Tracker</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="css/estilos.css">

        <script>
function showMyAnime(sel) {
  var obj, dbParam, xmlhttp, myObj, x, txt = "";
  obj = { table: sel, limit: 20 };
  dbParam = JSON.stringify(obj);
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myObj = JSON.parse(this.responseText);
      txt += "<table border='1' class = \"table table-bordered\">";
      for (x in myObj) {
        txt += "<tr>";
        txt += "<td><img src=\"http://25.68.45.54:8080/portadas/" + myObj[x].nombre + ".jpg\"></td>";
        txt += "<td><p>" + myObj[x].nombre + "</br>" + myObj[x].sinopsis+ "</br>"+"Generos: "+myObj[x].ngenero  + "</br>"+"Calificacion: "+myObj[x].calif +"</br>" +  "Capitulos: " + myObj[x].episodios + "  Temporada: " + myObj[x].temporada + "</br>" + "Comenzaste en : " + myObj[x].fecha_est+ "</br>" + "Casa Animadora: " + myObj[x].animadora + "</br>" + "Autor: " + myObj[x].autor  + "</br>" + "  Rating #" + myObj[x].rating +"</p></td>";
        txt += "<td><form method=\"POST\" action=\"http://25.68.45.54:8080/delete_veAnime.php\">  <input type=\"text\" name=\"idanime\" value=\"" + myObj[x].idanime + "\" hidden=\"true\"> <input type=\"text\" name=\"idusuario\" value=\"" + myObj[x].sess +"\" hidden=\"true\"> <input type=\"Submit\" class= \"btn btn-primary\" value=\"Eliminar de mi lista\"> </form>";
        txt += "<form method=\"POST\" action=\"http://25.90.246.130:8080/htmls/showAnimeInfo.php\">  <input type=\"text\" name=\"idanime\" value=\"" + myObj[x].idanime + "\" hidden=\"true\"> <input type=\"text\" name=\"idusuario\" value=\"" + myObj[x].sess +"\" hidden=\"true\"> <input type=\"text\" name=\"all_genres\" value=\"" + myObj[x].ngenero +"\" hidden=\"true\"> <input type=\"Submit\" class= \"btn btn-primary\" value=\"Mostrar Informacion.\"> </form></td>";
        txt += "</tr>";
      }
      txt += "</table>"    
      document.getElementById("demo").innerHTML = txt;
      }
    };
  xmlhttp.open("POST", "http://25.68.45.54:8080/misAnimes.php?sess=" + <?php session_start(); echo $_SESSION['ID']; ?> + "", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("x=" + dbParam);
}
window.onload = showMyAnime;
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