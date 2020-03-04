<?php
header('Content-Type: application/json');
require("../../conexion.php");

$conexion = retornarConexion();

switch ($_GET['accion']) {
    case 'listar':
        $sql = $conexion->prepare("SELECT 
                                intEmpresa,
                                varNombreComercial,
                                ifnull(varRFC,'') as varRFC,
                                IF(bitActivo = 0, 'Inactivo', 'Activo') AS estado
                            FROM
                                tCatEmpresa;");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;
    case 'agregar':
        $sql = $conexion->prepare("INSERT INTO tCatEmpresa (
                                            varNombreComercial, 
                                            varRazonSocial, 
                                            varRFC, 
                                            varDireccion, 
                                            varTelefono, 
                                            varEmail, 
                                            bitActivo, 
                                            varNumeroInterior, 
                                            varNumeroExterior, 
                                            intCodigoPostal, 
                                            intCiudad
                                        )
                                    VALUES(
                                        '$_POST[varNombreComercial]', 
                                        '$_POST[varRazonSocial]', 
                                        '$_POST[varRFC]', 
                                        '$_POST[varDireccion]', 
                                        '$_POST[varTelefono]', 
                                        '$_POST[varEmail]', 
                                        $_POST[bitActivo], 
                                        '$_POST[varNumeroInterior]', 
                                        '$_POST[varNumeroExterior]', 
                                        $_POST[intCodigoPostal], 
                                        $_POST[intCiudad]
                                    )");
        $respuesta = $sql->execute();
        echo json_encode($respuesta);
        break;
    case 'recuperar':
        $sql = $conexion->prepare("SELECT
                                        tbl1.*, tbl3.intEstado
                                    FROM
                                        tCatEmpresa tbl1
                                            INNER JOIN
                                        tCatCiudad tbl2 ON tbl2.intCiudad = tbl1.intCiudad
                                            INNER JOIN
                                        tCatEstado tbl3 ON tbl3.intEstado = tbl2.intEstado
                                    WHERE tbl1.intEmpresa=$_POST[intEmpresa]");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;
    case 'borrar':
        //echo "DELETE FROM tCatEmpresa WHERE intEmpresa=".$_POST['intEmpresa'];
        $sql = $conexion->prepare("DELETE FROM tCatEmpresa11 WHERE intEmpresa=".$_POST['intEmpresa']);
        $respuesta = $sql->execute();
        echo json_encode($respuesta);
        break;
    case 'modificar':
        $sql = $conexion->prepare("UPDATE tCatEmpresa SET
                                        varNombreComercial = '$_POST[varNombreComercial]',
                                        varRazonSocial = '$_POST[varRazonSocial]',
                                        varRFC = '$_POST[varRFC]', 
                                        varDireccion = '$_POST[varDireccion]', 
                                        varTelefono = '$_POST[varTelefono]',
                                        varEmail = '$_POST[varEmail]', 
                                        bitActivo = $_POST[bitActivo], 
                                        varNumeroInterior = '$_POST[varNumeroInterior]', 
                                        varNumeroExterior = '$_POST[varNumeroExterior]', 
                                        intCodigoPostal = $_POST[intCodigoPostal], 
                                        intCiudad = $_POST[intCiudad] WHERE intEmpresa=".$_POST['intEmpresa']);
        $respuesta = $sql->execute();
        echo json_encode($respuesta);
        break;
    case 'estados':
        $sql = $conexion->prepare("SELECT intEstado, varEstado FROM tCatEstado;");
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break; 
    case 'ciudad':
        $sql = $conexion->prepare("SELECT 
                                    intCiudad, VarNombre
                                FROM
                                    tCatCiudad
                                WHERE
                                    intEstado =". $_POST['intEstado']);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;
    case 'validaBorrarEmpresa':
        $sql = $conexion->prepare("SELECT COUNT(*) AS Franquicias FROM tCatFranquicia WHERE intEmpresa=".$_POST['intEmpresa']);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break; 
}
?>