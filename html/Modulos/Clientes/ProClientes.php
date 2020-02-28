<?php
header('Content-Type: application/json');
require("../../conexion.php");

$pdo = retornarConexion();

switch ($_GET['accion']) {
    case 'listar':
        $sql = $pdo->prepare("select intCliente as codigo, varNombre as nombre,varTelefono as telefono, varEmail as mail, varDireccion as direccion from tCatCliente");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;

    case 'agregar':
        $sql = $pdo->prepare("insert into tCatCliente(varNombre,varTelefono,varEmail,varDireccion) values (:nombre,:telefono,:mail,:direccion)");
        $respuesta = $sql->execute(array(
            "nombre" => $_POST['nombre'],
            "telefono" => $_POST['telefono'],
            "mail" => $_POST['mail'],
            "direccion" => $_POST['direccion']
        ));
        echo json_encode($respuesta);
        break;

    case 'recuperar':
        $sql = $pdo->prepare("select intCliente as codigo,varNombre as nombre,varTelefono as telefono,varEmail as mail,varDireccion as direccion from tCatCliente where intCliente=:codigo");
        $sql->execute(array("codigo" => $_POST['codigo']));
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;

    case 'borrar':
        $sql = $pdo->prepare("delete from tCatCliente where intCliente=:codigo");
        $resultado = $sql->execute(array("codigo" => $_POST['codigo']));
        echo json_encode($resultado);
        break;

    case 'modificar':
        $sql = $pdo->prepare("update tCatCliente
                                set varNombre=:nombre,
                                varTelefono=:telefono,
                                    varEmail=:mail,
                                    varDireccion=:direccion
                                where intCliente=:codigo");
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