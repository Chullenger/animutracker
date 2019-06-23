<?php
  $generos = preg_split("/[\s,]+/", $_POST['all_genres']);
  $gen="";
  $mm = $_POST['idanime'];
  $gen = implode(", ", $generos);
    $pedroputo= $_POST['idusuario'];
  $dato = "idanime=".$_POST['idanime']."&genres=".$gen."&idusuario=".$pedroputo;
?>
<!DOCTYPE html>
<html>
<head>
        <title>Animu Tracker</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="css/estilos.css">

        <script>
function showMangaInf(sel) {
  var obj, dbParam, xmlhttp, myObj, x, txt = "";
  obj = { table: sel, limit: 20 };
  var auxDir = <?php echo json_encode($dato) ?>;
  dbParam = JSON.stringify(obj);
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myObj = JSON.parse(this.responseText);
      for (x in myObj) {
        txt += "<div class=\"mng_data1\"><img src=\"http://25.68.45.54:8080/portadas/" + myObj[x].nombre + ".jpg\"class=\"mng_img\"></div>" ;
        txt += "<div class=\"mng_data\"><h1>" + myObj[x].nombre + "</h1> </br>";
        txt += "<h2> Sinopsis " + myObj[x].sinopsis + "</h2></br>";
        txt += "<h3> Generos: " + myObj[x].ngenero + "</h3></br>";
        txt += "<p> Capitulos: " + myObj[x].episodios+ " Temporada: " + myObj[x].temporada + "</p></br>";
        txt += "<p> Estreno: " + myObj[x].fecha_est+"</p></br>";
        txt += "<p> Calificacion: " + myObj[x].calif + " Rating: #" + myObj[x].rating + "</p></br>";
        txt += "<p> Autor: " + myObj[x].autor+ "</p></br>";
        txt += "<p> Animadora: " + myObj[x].animadora +"</p></br></div>";
      }    
      document.getElementById("mangaDts").innerHTML = txt;
      txt="";
      for (x in myObj) {
        txt+= "<div class=\"mi_seg\">";
        txt += "<h1> Mi seguimiento: </h1></br>";
        txt += "<form id=\"calif\" action=\"http://25.68.45.54:8080/modifyAnimeTrack.php\"> <div class=\"datum\"> <p>Mi calificacion: </p> <input type=\"text\" class=\"form-control\" name=\"mCalificacion\" value=\"" + myObj[x].eval + "\"> </div>";
        txt += "<div class=\"datum\"><p>Último capitulo visto: </p><input type=\"text\" class=\"form-control\" name=\"mCapitulos\" value=\"" + myObj[x].capitulos + "\"></div>";
        txt+= "<div class=\"datum\"><p>Estado: </p> <input type=\"text\" name=\"mEstado\" class=\"form-control\" value=\"" + myObj[x].estado + "\"></div>";
        txt += "<input type=\"text\" name=\"idanime\" value=\"" + myObj[x].idanime + "\" hidden=\"true\">"; 
        txt += "<input type=\"text\" name=\"idusuario\" value=\"" + myObj[x].sess +"\" hidden=\"true\"> <input type=\"Submit\" class=\"btn btn-secondary btn-lg\" value=\"Actualizar Informacion\">"
        txt += "</form>";
        txt+= "</div>"

      } 
      document.getElementById("myDtas").innerHTML = txt;
      }
    };
  xmlhttp.open("POST", "http://25.68.45.54:8080/retrieveAnimeInfo.php?" + auxDir, true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("x=" + dbParam);
}
//window.onload = showMangaInf;
window.onload = function(){
        showMangaInf();
        showMangaComments();
 }
</script>
<script>
function showMangaComments(sel) {
  var obj, dbParam, xmlhttp, myObj, x, txt = "";
  obj = { table: sel, limit: 20 };
  var auxDir = <?php echo json_encode($dato) ?>;
  dbParam = JSON.stringify(obj);
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myObj = JSON.parse(this.responseText);
      txt += "</br> <h1>Comentarios</h1> </br><table border='1' class = \"table table-bordered\">";
      txt += "<tr><td>Usuario</td><td>comentario</td><td>Fecha</td></tr>";
      for (x in myObj) {
        txt += "<tr>";
        txt += "<td>" + myObj[x].name +"</td>";
        txt += "<td>" + myObj[x].comentario +"</td>";
        txt += "<td>" + myObj[x].fecha +"</td>";
        if(myObj[x].sess == myObj[x].idusuario){
          txt += "<td>";
          txt += "<form action=\"http://25.68.45.54:8080/eliminarComentarioAnime.php\" method=\"POST\">";
          txt += "<input type=\"text\" name=\"idcomen\" value=\"" + myObj[x].idcomentario + "\" hidden=\"true\">";
          txt += "<input type=\"Submit\" class = \"btn btn-danger\" value=\"Eliminar Comentario\">";
          txt+= "</form>";
          txt +="</td>";
        }
        
        txt += "</tr>";
      }    
      txt += "</table>";
      txt += "<form action=\"http://25.68.45.54:8080/addComentarioAnime.php\" method=\"POST\">";
      txt += "<input type=\"text\" name=\"idus\" value=\"" + myObj[x].sess + "\" hidden=\"true\">";
      txt += "<input type=\"text\" name=\"idan\" value=\"" + myObj[x].idanime + "\" hidden=\"true\">";
      txt += "<input type=\"text\" class=\"form-control\" name=\"com\">";
      txt += "<input type=\"Submit\" class = \"btn btn-primary\" value=\"Agregar comentario\">";
      txt += "</form>"
      document.getElementById("comentarios").innerHTML = txt;
      }
    };
  xmlhttp.open("POST", "http://25.68.45.54:8080/retrieveAnimeComments.php?" + auxDir, true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("x=" + dbParam);
}
//window.onload = showMangaComments;
</script>
</head>
<body id="SAI">
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


<div id="mangaDts"></div>
<div id="myDtas"></div>

<div id="comentarios"></div>

</body>
</html>