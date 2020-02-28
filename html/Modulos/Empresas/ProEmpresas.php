<?php
header('Content-Type: application/json');
require("../../conexion.php");

$conexion = retornarConexion();

switch ($_GET['accion']) {
    
    case 'listar':
        $respuesta = mysqli_query($conexion, "SELECT 
                                                intEmpresa,
                                                varNombreComercial,
                                                ifnull(varRFC,'') as varRFC,
                                                IF(bitActivo = 0, 'Inactivo', 'Activo') AS estado
                                            FROM
                                                tCatEmpresa;");
        $resultado = mysqli_fetch_all($respuesta, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;
    case 'agregar':
       $respuesta = mysqli_query($conexion, "INSERT INTO tCatEmpresa (
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
        echo json_encode($respuesta);
        break;
    case 'recuperar':
        $respuesta = mysqli_query($conexion, "SELECT
                                                tbl1.*, tbl3.intEstado
                                            FROM
                                                tCatEmpresa tbl1
                                                    INNER JOIN
                                                tCatCiudad tbl2 ON tbl2.intCiudad = tbl1.intCiudad
                                                    INNER JOIN
                                                tCatEstado tbl3 ON tbl3.intEstado = tbl2.intEstado
                                            WHERE tbl1.intEmpresa=$_POST[intEmpresa]");
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
    case 'estados':
        $respuesta = mysqli_query($conexion, "SELECT intEstado, varEstado FROM tCatEstado;");
        $resultado = mysqli_fetch_all($respuesta, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break; 
    case 'ciudad':
        $respuesta = mysqli_query($conexion, "SELECT 
                                                    intCiudad, VarNombre
                                                FROM
                                                    tCatCiudad
                                                WHERE
                                                    intEstado =". $_POST['intEstado']);
        $resultado = mysqli_fetch_all($respuesta, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;   
}

?>