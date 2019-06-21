<?php
	$generos = preg_split("/[\s,]+/", $_POST['all_genres']);
	$gen="";
	$mm = $_POST['manga_idmanga'];
	$gen = implode("", $generos);
	$dato = "idmanga=".$_POST['manga_idmanga']."&genres=".$gen;
?>
<!DOCTYPE html>
<html>
<head>
        <title>Test</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        txt += "<img src=\"http://25.90.246.130:8080/portadas/" + myObj[x].nombre + ".jpg\">" ;
        txt += "<h1>" + myObj[x].nombre + "</h1> </br>";
        txt += "<h2> Sinopsis " + myObj[x].sinopsis + "</h2></br>";
        txt += "<h3> Generos: " + myObj[x].ngenero + "</h3></br>";
        txt += "<p> Capitulos: " + myObj[x].capitulos + " Tomos: " + myObj[x].tomos + "</p></br>";
        txt += "<p> Estreno: " + myObj[x].fecha_est + " Fin: " + myObj[x].fecha_fin + "</p></br>";
        txt += "<p> Calificacion: " + myObj[x].calif + " Rating: #" + myObj[x].rating + "</p></br>";
        txt += "<p> Autor: " + myObj[x].nautor + " " + myObj[x].apautor + "</p></br>";
        txt += "<p> Dibujante: " + myObj[x].nilust + " " + myObj[x].appilust + "</p></br>";
        txt += "<p> Editorial: " + myObj[x].neditorial + "</p></br>";
      }    
      document.getElementById("mangaDts").innerHTML = txt;
      txt="";
      for (x in myObj) {
      	txt += "<h1> Mi seguimiento: </h1></br>";
        txt += "<form id=\"calif\" action=\"http://25.90.246.130:8080/modifyMangaTrack.php\"> <p>Mi calificacion: </p> <input type=\"text\" name=\"mCalificacion\" value=\"" + myObj[x].my_calif + "\">";
        txt += "<p>Capitulo leido: </p><input type=\"text\" name=\"mCapitulos\" value=\"" + myObj[x].cap_act + "\">";
        txt+= "<p>Estado: </p> <input type=\"text\" name=\"mEstado\" value=\"" + myObj[x].estado + "\">";
        txt += "<input type=\"text\" name=\"idmanga\" value=\"" + myObj[x].idmanga + "\" hidden=\"true\"> <input type=\"text\" name=\"idusuario\" value=\"" + myObj[x].sess +"\" hidden=\"true\"> <input type=\"Submit\" value=\"Actualizar Informacion\">"
        txt += "</form>";

      } 
      document.getElementById("myDtas").innerHTML = txt;
      }
    };
  xmlhttp.open("POST", "http://25.90.246.130:8080/retrieveMangaInfo.php?" + auxDir, true);
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
      txt += "</br> <h1>Comentarios</h1> </br><table border='1'>";
      txt += "<tr><td>Usuario</td><td>comentario</td><td>Fecha</td></tr>";
      for (x in myObj) {
        txt += "<tr>";
        txt += "<td>" + myObj[x].name +"</td>";
        txt += "<td>" + myObj[x].comentario +"</td>";
        txt += "<td>" + myObj[x].fecha +"</td>";
        txt += "</tr>"
      }    
      txt += "</table>";
      document.getElementById("comentarios").innerHTML = txt;
      }
    };
  xmlhttp.open("POST", "http://25.90.246.130:8080/retrieveMangaComments.php?" + auxDir, true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("x=" + dbParam);
}
//window.onload = showMangaComments;
</script>
</head>
<body>
<div id="menu">
  <a href="allMangas.php">Lista de Mangas</a>
  <a href="myMangas.php">Mis Mangas</a>
  <a href="Animes.php">Lista de Animes</a>
  <a href="MisAnimes.php">Mis Animes</a>
</div>

<div id="user-info">
</div>


<div id="mangaDts"></div>
<div id="myDtas"></div>

<div id="comentarios"></div>

</body>
</html>