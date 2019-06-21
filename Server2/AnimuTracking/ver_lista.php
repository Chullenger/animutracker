<?php
require 'database.php';
$idanime = ($_GET['idanime'] !== null && (int)$_GET['idanime'] > 0)? mysqli_real_escape_string($con, (int)$_GET['idanime']) : false;
$idusuario=($_GET['idusuario'] !== null && (int)$_GET['idusuario'] > 0)? mysqli_real_escape_string($con, (int)$_GET['idusurio']) : false;
if(!$idanime||$idusuario)
{
  return http_response_code(400);
}
$sql = "SELECT anime.nombre Anime , usuario.nombre Usuario, ve.fehca Fecha 
from anime 
join ve on ve.idanime=anime.idanime

join usuario on usuario.idusuario=ve.idusuario 
where usuario.idusuario={$idusuario};";
$Mi_lista=[];
  if($result = mysqli_query($con,$sql))
  {
    $i = 0;
    while($row = mysqli_fetch_assoc($result))
    {
      $Mi_lista[$i]['Anime']=$row['Anime'];
      $Mi_lista[$i]['Usuario']=$row['Usuario'];
    $Mi_lista[$i]['Fecha']=$row['Fecha'];
      $i++;
    }

    echo json_encode($comentario);
    }
  else
  {
    http_response_code(404);
  }

?>