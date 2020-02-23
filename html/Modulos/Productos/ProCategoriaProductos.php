<?php
header('Content-Type: application/json');
require("../../conexion.php");

$conexion = retornarConexion();

switch ($_GET['accion']) {
    case 'listar':
        $respuesta = mysqli_query($conexion, "select intCategoriaProducto as codigo, varDescripcion as descripcion from tCatCategoriaProducto");
        $resultado = mysqli_fetch_all($respuesta, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;
    case 'agregar':
        $respuesta = mysqli_query($conexion, "insert into tCatCategoriaProducto(varDescripcion) values ('$_POST[descripcion]')");
        echo json_encode($respuesta);
        break;
    case 'recuperar':
        $respuesta = mysqli_query($conexion, "select intCategoriaProducto as codigo, varDescripcion as descripcion from tCatCategoriaProducto where intCategoriaProducto=$_POST[codigo]");
        $resultado = mysqli_fetch_all($respuesta, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;
    case 'borrar':
        $respuesta = mysqli_query($conexion, "delete from tCatCategoriaProducto where intCategoriaProducto=".$_POST['codigo']);
        echo json_encode($respuesta);
        break;
    case 'modificar':
        $respuesta = mysqli_query($conexion, "update tCatCategoriaProducto set varDescripcion='$_POST[descripcion]' where intCategoriaProducto=$_POST[codigo]");
        echo json_encode($respuesta);
        break;        
}

?>