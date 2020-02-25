<?php
header('Content-Type: application/json');
require("../../conexion.php");

$pdo = retornarConexion();

switch ($_GET['accion']) {
    case 'listar':
        $sql = $pdo->prepare("select codigo, nombre, telefono, mail, direccion from clientes");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;

    case 'agregar':
        $sql = $pdo->prepare("insert into clientes(nombre,telefono,mail,direccion) values (:nombre,:telefono,:mail,:direccion)");
        $respuesta = $sql->execute(array(
            "nombre" => $_POST['nombre'],
            "telefono" => $_POST['telefono'],
            "mail" => $_POST['mail'],
            "direccion" => $_POST['direccion']
        ));
        echo json_encode($respuesta);
        break;

    case 'recuperar':
        $sql = $pdo->prepare("select codigo, nombre, telefono, mail, direccion from clientes where codigo=:codigo");
        $sql->execute(array("codigo" => $_POST['codigo']));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;

    case 'borrar':
        $sql = $pdo->prepare("delete from clientes where codigo=:codigo");
        $resultado = $sql->execute(array("codigo" => $_POST['codigo']));
        echo json_encode($resultado);
        break;

    case 'modificar':
        $sql = $pdo->prepare("update clientes
                                set nombre=:nombre,
                                    telefono=:telefono,
                                    mail=:mail,
                                    direccion=:direccion
                                where codigo=:codigo");
        $respuesta = $sql->execute(array(
            "nombre" => $_POST['nombre'],
            "telefono" => $_POST['telefono'],
            "mail" => $_POST['mail'],
            "direccion" => $_POST['direccion'],
            "codigo" => $_POST['codigo']
        ));
        echo json_encode($respuesta);
        break;
}