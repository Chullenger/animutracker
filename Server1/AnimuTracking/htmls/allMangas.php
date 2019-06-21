<!DOCTYPE html>
<html>
<head>
        <title>Test</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/estilos.css">

        <script>
  function showMangas(sel) {
  var obj, dbParam, xmlhttp, myObj, x, txt = "",res= [],u,bool=false;
  obj = { table: sel, limit: 20 };
  dbParam = JSON.stringify(obj);
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myObj = JSON.parse(this.responseText);
      txt += "<table border='1' class = \"table table-bordered\">"
      for (x in myObj) {
        txt += "<tr>";
        txt += "<td><img src=\"http://25.90.246.130:8080/portadas/" + myObj[x].nombre + ".jpg\"></td>";
        txt += "<td>" + myObj[x].nombre + "</br>" + "Sinopsis: " +myObj[x].sinopsis + "</br>" +  "Generos: "  +myObj[x].ngenero + "</br>" + "Capitulos: " + myObj[x].capitulos + "  Tomos: " + myObj[x].tomos + "</br>" + "Estreno: " + myObj[x].fecha_est + "  Fin: " + myObj[x].fecha_fin + "</br>" + "Calificacion: " + myObj[x].calif + "  Rating #" + myObj[x].rating +"</td>";
        res=myObj[x].lista.split(" ");
        for(u in res){
            if(res[u]==myObj[x].idmanga){
                bool=true;
            }
        }
        if(bool==true){
            txt += "<td><h5>Manga agregado<h5></td>";
            bool=false;
        }else{
           txt += "<td><form id=\"sendDatas\" method=\"POST\" action=\"http://25.90.246.130:8080/addToList.php\">  <input type=\"text\" name=\"manga_idmanga\" value=\"" + myObj[x].idmanga + " \" hidden=\"true\"> <input type=\"text\" name=\"usuario_idusuario\" value=\"" + myObj[x].sess +"\" hidden=\"true\"> <input type=\"Submit\" value=\"Agregar a mi lista\"> </form></td>";
      }
      txt += "</tr>";
    }
      txt += "</table>";    
      document.getElementById("demo").innerHTML = txt;
      }
    };
  xmlhttp.open("POST", "http://25.90.246.130:8080/getmangas.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("x=" + dbParam);
}
window.onload = showMangas;
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
  <p id="usr"></p>
  <?php
  session_start();
  $nombre = $_SESSION['Nombre'];
  $mail = $_SESSION['Correo'];
  echo "<h4>".$mail."</h4><br>";
  echo $nombre;  
  ?>
  </script>
</div>
<?php
  $id=$_SESSION['ID'];
    echo $id;  
?>
<div id="demo"></div>
<script type="text/javascript">
  function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}
</script>
<script type="text/javascript">
  var $form = $("sendDatas");
  var data = getFormData($form);
</script>

</body>
</html>

