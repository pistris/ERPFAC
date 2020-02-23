<?php
header('Content-Type: application/json');
session_start();

require("conexion.php");

$conexion = retornarConexion();

switch ($_GET['accion']) {
    case 'listar':
        $datos = mysqli_query($conexion, "select codigo,titulo,horainicio,horafin,colortexto,colorfondo from eventospredefinidosusuarios where usuario='$_SESSION[usuario]'");
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;

    case 'agregar':
        $respuesta = mysqli_query($conexion, "insert into eventospredefinidosusuarios(titulo,horainicio,horafin,colortexto,colorfondo,usuario) values 
                                                ('$_POST[titulo]','$_POST[horainicio]','$_POST[horafin]','$_POST[colortexto]','$_POST[colorfondo]','$_SESSION[usuario]')");
        echo json_encode($respuesta);
        break;

    case 'borrar':
        $respuesta = mysqli_query($conexion, "delete from eventospredefinidosusuarios where codigo=$_POST[codigo]");
        echo json_encode($respuesta);
        break;
}
?>