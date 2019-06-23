<?php
	$generos = preg_split("/[\s,]+/", $_POST['all_genres']);
	$gen="";
	$mm = $_POST['idanime'];
	$gen = implode("", $generos);
    $pedroputo= $_POST['idusuario'];
	$dato = "idanime=".$_POST['idanime']."&genres=".$gen."&idusuario=".$pedroputo;
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
        txt += "<img src=\"http://25.68.45.54:8080/portadas/" + myObj[x].nombre + ".jpg\">" ;
        txt += "<h1>" + myObj[x].nombre + "</h1> </br>";
        txt += "<h2> Sinopsis " + myObj[x].sinopsis + "</h2></br>";
        txt += "<h3> Generos: " + myObj[x].genero + "</h3></br>";
        txt += "<p> Capitulos: " + myObj[x].episodios+ " Temporada: " + myObj[x].temporada + "</p></br>";
        txt += "<p> Estreno: " + myObj[x].fecha_est+"</p></br>";
        txt += "<p> Calificacion: " + myObj[x].calif + " Rating: #" + myObj[x].rating + "</p></br>";
        txt += "<p> Autor: " + myObj[x].autor+ "</p></br>";
        txt += "<p> Animadora: " + myObj[x].animadora +"</p></br>";
        
      }    
      document.getElementById("mangaDts").innerHTML = txt;
      txt="";
      for (x in myObj) {
      	txt += "<h1> Mi seguimiento: </h1></br>";
        txt += "<form id=\"calif\" action=\"http://25.68.45.54:8080/modifyAnimeTrack.php\"> <p>Mi calificacion: </p> <input type=\"text\" name=\"mCalificacion\" value=\"" + myObj[x].eval + "\">";
        txt += "<p>Capitulo leido: </p><input type=\"text\" name=\"mCapitulos\" value=\"" + myObj[x].capitulos + "\">";
        txt+= "<p>Estado: </p> <input type=\"text\" name=\"mEstado\" value=\"" + myObj[x].estado + "\">";
        txt += "<input type=\"text\" name=\"idanime\" value=\"" + myObj[x].idanime + "\" hidden=\"true\"> <input type=\"text\" name=\"idusuario\" value=\"" + myObj[x].sess +"\" hidden=\"true\"> <input type=\"Submit\" value=\"Actualizar Informacion\">"
        txt += "</form>";

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
      txt += "</br> <h1>Comentarios</h1> </br><table border='1'>";
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
          txt += "<input type=\"Submit\" value=\"Eliminar Comentario\">";
          txt+= "</form>";
          txt +="</td>";
        }
        
        txt += "</tr>";
      }    
      txt += "</table>";
      txt += "<form action=\"http://25.68.45.54:8080/addComentarioAnime.php\" method=\"POST\">";
      txt += "<input type=\"text\" name=\"idus\" value=\"" + myObj[x].sess + "\" hidden=\"true\">";
      txt += "<input type=\"text\" name=\"idan\" value=\"" + myObj[x].idanime + "\" hidden=\"true\">";
      txt += "<input type=\"text\" name=\"com\">";
      txt += "<input type=\"Submit\" value=\"Agregar comentario\">";
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