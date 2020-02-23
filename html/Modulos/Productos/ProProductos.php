<?php
header('Content-Type: application/json');
require("../../conexion.php");

$conexion = retornarConexion();

switch ($_GET['accion']) {
    case 'listar':
        $respuesta = mysqli_query($conexion, "select 
                                                 pro.intProducto as codigo,
                                                 pro.varDescripcion as descripcion,
                                                 cat.varDescripcion as descripcioncategoria,
                                                 pro.dobPrecio as precio
                                              from tCatProducto as pro
                                              join tCatCategoriaProducto as cat on cat.intCategoriaProducto=pro.intCategoriaProducto");
        $resultado = mysqli_fetch_all($respuesta, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;
    case 'agregar':
        $respuesta = mysqli_query($conexion, "insert into tCatProducto(varDescripcion,dobPrecio,intCategoriaProducto) values ('$_POST[descripcion]',$_POST[precio],$_POST[codigocategoria])");
        echo json_encode($respuesta);
        break;
    case 'recuperar':
        $respuesta = mysqli_query($conexion, "select intProducto as codigo, varDescripcion as descripcion, dobPrecio as precio, intCategoriaProducto as codigocategoria from tCatProducto where intProducto=$_POST[codigo]");
        $resultado = mysqli_fetch_all($respuesta, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;
    case 'borrar':
        $respuesta = mysqli_query($conexion, "delete from tCatProducto where intProducto=" . $_POST['codigo']);
        echo json_encode($respuesta);
        break;
    case 'modificar':
        $respuesta = mysqli_query($conexion, "update tCatProducto set varDescripcion='$_POST[descripcion]', dobPrecio=$_REQUEST[precio], intCategoriaProducto=$_POST[codigocategoria] where intProducto=$_POST[codigo]");
        echo json_encode($respuesta);
        break;
    case 'listarcategorias':
        $respuesta = mysqli_query($conexion, "select intCategoriaProducto as codigo, varDescripcion as descripcion from tCatCategoriaProducto");
        $resultado = mysqli_fetch_all($respuesta, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;
}
?>