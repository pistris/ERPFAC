<?php
header('Content-Type: application/json');
require("../../conexion.php");

$pdo = retornarConexion();

switch ($_GET['accion']) {
    case 'listar':
        $sql = $pdo->prepare( "select intCategoriaProducto as codigo, varDescripcion as descripcion from tCatCategoriaProducto");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;
    case 'agregar':
     
        $sql = $pdo->prepare("insert into tCatCategoriaProducto(varDescripcion) values (:descripcion)");
        $respuesta = $sql->execute(array("descripcion" => $_POST['descripcion']));
        echo json_encode($respuesta);
        break;


    case 'recuperar':
      
        $sql = $pdo->prepare("select intCategoriaProducto as codigo, varDescripcion as descripcion from tCatCategoriaProducto where intCategoriaProducto=:codigo");
        $sql->execute(array("codigo" => $_POST['codigo']));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;

    case 'borrar':
         $sql = $pdo->prepare("delete from tCatCategoriaProducto where intCategoriaProducto=:codigo");
        $resultado = $sql->execute(array("codigo" => $_POST['codigo']));
        echo json_encode($resultado);
        break;

    case 'modificar':
        $sql = $pdo->prepare("update tCatCategoriaProducto set varDescripcion=:descripcion where intCategoriaProducto=:codigo");
        $respuesta = $sql->execute(array(
            "descripcion" => $_POST['descripcion'],
            "codigo" => $_POST['codigo']
        ));
        echo json_encode($respuesta);
        break;
}

?>