<?php
header('Content-Type: application/json');
require("../../conexionPDO.php");


$conexion = new Conexion;
$conexion->conectarBase();


switch ($_GET['accion']) {
    case 'listar':
   
        $sql = "SELECT 
        tbl1.intProducto AS codigo,
        tbl1.varDescripcion AS descripcion,
        tbl2.varDescripcion AS descripcioncategoria,
        tbl1.dobPrecio AS precio
     FROM tCatProducto AS tbl1
     JOIN tCatCategoriaProducto AS tbl2 
     ON tbl2.intCategoriaProducto = tbl1.intCategoriaProducto;";
        $resultado = $conexion->selectQuery($sql);
        echo $resultado;
        break;
    case 'agregar':
     
        $sql = "INSERT INTO tCatProducto(
            varDescripcion,
            dobPrecio,
            intCategoriaProducto
            ) 
            values (
                '$_POST[descripcion]',
                '$_POST[precio]',
                '$_POST[codigocategoria]'
                )";
      
        $respuesta = $conexion->excuteQuery($sql);
        echo json_encode($respuesta);
        break;
    case 'recuperar':
        $sql = "SELECT 
         intProducto as codigo, 
         varDescripcion as descripcion, 
         dobPrecio as precio, 
         intCategoriaProducto as codigocategoria 
         from 
         tCatProducto 
         where 
         intProducto=$_POST[codigo]";
 
 $resultado = $conexion->selectQuery($sql);
 echo $resultado;
        break;


    case 'borrar':
        $sql = "DELETE FROM tCatProducto where intProducto=$_POST[codigo]";
        $resultado = $conexion->excuteQuery($sql);
        echo $resultado;
        break;
        
    case 'modificar':
        $sql = "UPDATE 
        tCatProducto set 
        varDescripcion='$_POST[descripcion]',
        dobPrecio='$_POST[precio]',
        intCategoriaProducto='$_POST[codigocategoria]'
          where intProducto=".$_POST['codigo'];
             $resultado = $conexion->excuteQuery($sql);
             echo $resultado;
    break;

    case 'listarcategorias':
    
        $sql = "SELECT 
         intCategoriaProducto as codigo,
         varDescripcion as descripcion 
         from 
         tCatCategoriaProducto";
      $resultado = $conexion->selectQuery($sql);
      echo $resultado;
        break;
}
?>