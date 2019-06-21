<!DOCTYPE html>
<html>
<head>
        <title>Test</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script>
function showMyMangas(sel) {
  var obj, dbParam, xmlhttp, myObj, x, txt = "";
  obj = { table: sel, limit: 20 };
  dbParam = JSON.stringify(obj);
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myObj = JSON.parse(this.responseText);
      txt += "<table border='1'>"
      for (x in myObj) {
        txt += "<tr>";
        txt += "<td><img src=\"http://25.90.246.130:8080/portadas/" + myObj[x].nombre + ".jpg\"></td>";
        txt += "<td>" + myObj[x].nombre + "</br>" + "Sinopsis: " + myObj[x].sinopsis + "</br>" +  "Generos: "  +myObj[x].ngenero + "</br>" + "Capitulos: " + myObj[x].capitulos + "  Tomos: " + myObj[x].tomos + "</br>" + "Estreno: " + myObj[x].fecha_est + "  Fin: " + myObj[x].fecha_fin + "</br>" + "Calificacion: " + myObj[x].calif + "  Rating #" + myObj[x].rating +"</td>";
        txt += "<td><form method=\"POST\" action=\"http://25.90.246.130:8080/delete_leemanga.php\">  <input type=\"text\" name=\"manga_idmanga\" value=\"" + myObj[x].idmanga + " \" hidden=\"true\"> <input type=\"text\" name=\"usuario_idusuario\" value=\"" + myObj[x].sess +"\" hidden=\"true\"> <input type=\"Submit\" value=\"Eliminar de mi lista\"> </form>";
        txt += "<form method=\"POST\" action=\"http://25.90.246.130:8080/htmls/showMangaInfo.php\">  <input type=\"text\" name=\"manga_idmanga\" value=\"" + myObj[x].idmanga + "\" hidden=\"true\"> <input type=\"text\" name=\"usuario_idusuario\" value=\"" + myObj[x].sess +"\" hidden=\"true\"> <input type=\"text\" name=\"all_genres\" value=\"" + myObj[x].ngenero +"\" hidden=\"true\"> <input type=\"Submit\" value=\"Mostrar Informacion.\"> </form></td>";
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
<div id="menu">
  <a href="allMangas.php">Lista de Mangas</a>
  <a href="myMangas.php">Mis Mangas</a>
  <a href="Animes.php">Lista de Animes</a>
  <a href="MisAnimes.php">Mis Animes</a>
</div>

<div id="user-info">
  </div>


<p id="demo"></p>


</body>
</html>