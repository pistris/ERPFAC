<?php
header('Content-Type: application/json');

require("conexion.php");

$conexion = retornarConexion();

switch ($_GET['accion']) {
  case 'agregar':
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombrenuevo']);
    $clave = mysqli_real_escape_string($conexion, $_POST['clave1']);
    $respuesta = mysqli_query($conexion, "insert into usuarios(nombre,clave) values ('$nombre','$clave')");
    echo json_encode($respuesta);
    break;
  case 'existe':
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombrenuevo']);
    $respuesta = mysqli_query($conexion, "select nombre from usuarios where nombre='$nombre'");
    $cantidad = mysqli_num_rows($respuesta);
    if ($cantidad == 1)
      echo '{"resultado":"repetido"}';
    else
      echo '{"resultado":"norepetido"}';
    break;
}

?>