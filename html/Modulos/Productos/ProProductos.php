<?php
header('Content-Type: application/json');
require("../../conexion.php");

$pdo = retornarConexion();

switch ($_GET['accion']) {
    case 'listar':
   
        $sql = $pdo->prepare("select 
        pro.intProducto as codigo,
        pro.varDescripcion as descripcion,
        cat.varDescripcion as descripcioncategoria,
        pro.dobPrecio as precio
     from tCatProducto as pro
     join tCatCategoriaProducto as cat on cat.intCategoriaProducto=pro.intCategoriaProducto");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($resultado);
break;
    case 'agregar':
     
        $sql = $pdo->prepare("insert into tCatProducto(varDescripcion,dobPrecio,intCategoriaProducto) values (:descripcion,:precio,:codigocategoria)");
        $respuesta = $sql->execute(array(
            "descripcion" => $_POST['descripcion'],
            "precio" => $_POST['precio'],
            "codigocategoria" => $_POST['codigocategoria']
        ));
        echo json_encode($respuesta);
        break;
    case 'recuperar':
       $sql = $pdo->prepare("select intProducto as codigo, varDescripcion as descripcion, dobPrecio as precio, intCategoriaProducto as codigocategoria from tCatProducto where intProducto=:codigo");
        $sql->execute(array("codigo" => $_POST['codigo']));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;


    case 'borrar':
        $sql = $pdo->prepare("delete from tCatProducto where intProducto=:codigo");
        $resultado = $sql->execute(array("codigo" => $_POST['codigo']));
        echo json_encode($resultado);
        break;
        
    case 'modificar':
        $sql = $pdo->prepare("update tCatProducto set varDescripcion=:descripcion,
        dobPrecio=:precio,
        intCategoriaProducto=:codigocategoria
    where intProducto=:codigo");
$respuesta = $sql->execute(array(
"descripcion" => $_POST['descripcion'],
"precio" => $_POST['precio'],
"codigocategoria" => $_POST['codigocategoria'],
"codigo" => $_POST['codigo']
));
echo json_encode($respuesta);
break;
    case 'listarcategorias':
    
        $sql = $pdo->prepare("select intCategoriaProducto as codigo,varDescripcion as descripcion from tCatCategoriaProducto");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;
}
?>