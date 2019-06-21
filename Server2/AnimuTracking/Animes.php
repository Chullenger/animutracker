<!DOCTYPE html>
<html>
<head>
        <title>Test</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script>
function AllAnimes(sel) {
  var obj, dbParam, xmlhttp, myObj, x, txt = "",res,u,bool;
  obj = { table: sel, limit: 20 };
  dbParam = JSON.stringify(obj);
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myObj = JSON.parse(this.responseText);
      txt += "<table border='1'>"
      for (x in myObj) {
        txt += "<tr>";
        txt += "<td><img src=\"http://25.68.45.54:8080/portadas/" + myObj[x].nombre + ".jpg\"></td>";
        txt += "<td>" + myObj[x].nombre + "</br>" + myObj[x].sinopsis+ "</br>"+"Generos: "+myObj[x].genero  + "</br>"+"Calificacion: "+myObj[x].calif +"</br>" +  "Capitulos: " + myObj[x].episodios + "  Temporada: " + myObj[x].temporada + "</br>" + "Estreno: " + myObj[x].fecha+ "</br>" + "Casa Animadora: " + myObj[x].animadora + "</br>" + "Autor: " + myObj[x].autor  + "</br>" + "  Rating #" + myObj[x].rating +"</td>";
        res=myObj[x].animes_ve.split(" ");
        for(u in res){
            if(res[u]==myObj[x].idanime){
                bool=true;
            }
        }
        if(bool==true){
            txt += "<td><h5>Anime agregado<h5></td>";
            bool=false;
        }else{
            txt += "<td><button> Agregar a la lista</td>";
        }
        txt += "</tr>";
        
      }
      txt += "</table>"    
      document.getElementById("demo").innerHTML = txt;
      }
    };
  xmlhttp.open("POST", "http://25.68.45.54:8080/read.php?sess=" + <?php session_start(); echo $_SESSION['ID']; ?> + "", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("x=" + dbParam);
}
window.onload = AllAnimes;
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