<?php
header('Content-Type: application/json');
require("../../conexionPDO.php");

$conexion = new Conexion;
$conexion->conectarBase();


// $db = new Conexion;
// $db->conectarPDO();

switch ($_GET['accion']) {
    case 'listar':
        $sql = "SELECT 
                    tbl1.intFranquicia,
                    tbl1.varNombre,
                    tbl2.intEmpresa,
                    tbl2.varNombreComercial,
                    IF(tbl1.bitActivo = 0, 'Inactivo', 'Activo') AS estado
                FROM
                    tCatFranquicia tbl1
                        INNER JOIN
                    tCatEmpresa tbl2 ON tbl2.intEmpresa = tbl1.intEmpresa;";
        $resultado = $conexion->selectQuery($sql);
        echo $resultado;
        break;
    case 'agregar':
        $sql = "INSERT INTO tCatFranquicia (
                                        intEmpresa, 
                                        varNombre, 
                                        varDireccion, 
                                        varNumeroInterior, 
                                        varNumeroExterior, 
                                        varTelefono, 
                                        intCiudad, 
                                        bitActivo
                                    )
                                    VALUES(
                                        $_POST[intEmpresa], 
                                        '$_POST[varNombre]', 
                                        '$_POST[varDireccion]', 
                                        '$_POST[varNumeroInterior]', 
                                        '$_POST[varNumeroExterior]', 
                                        '$_POST[varTelefono]', 
                                        $_POST[intCiudad], 
                                        $_POST[bitActivo]
                                    )";

        $resultado = $conexion->excuteQuery($sql);
        echo $resultado;
        break;
    case 'recuperar':
        $sql = "SELECT 
                    tbl1.intEmpresa, 
                    tbl1.varNombre, 
                    tbl1.varDireccion, 
                    IFNULL(tbl1.varNumeroInterior,'') AS varNumeroInterior, 
                    IFNULL(tbl1.varNumeroExterior,'') AS varNumeroExterior, 
                    IFNULL(tbl1.varTelefono,'') AS varTelefono, 
                    tbl1.intCiudad, 
                    tbl1.bitActivo, 
                    tbl2.intEmpresa,
                    tbl2.varNombreComercial,
                    tbl4.intEstado
                FROM
                    tCatFranquicia tbl1
                        INNER JOIN
                    tCatEmpresa tbl2 ON tbl2.intEmpresa = tbl1.intEmpresa
                        INNER JOIN
                    tCatCiudad tbl3 ON tbl3.intCiudad = tbl1.intCiudad
                        INNER JOIN
                    tCatEstado tbl4 ON tbl4.intEstado = tbl3.intEstado
                WHERE
                    tbl1.intFranquicia = $_POST[intFranquicia]";
        $resultado = $conexion->selectQuery($sql);
        echo $resultado;
        break;
    case 'borrar':
        $sql = "DELETE FROM tCatFranquicia WHERE intFranquicia=".$_POST['intFranquicia'];
        $resultado = $conexion->excuteQuery($sql);
        echo $resultado;
        break;
    case 'modificar':
        $numInterior = $_POST['varNumeroInterior']== '' ? 'NULL' : "'".$_POST['varNumeroInterior']."'";
        $telefono = $_POST['varTelefono']== '' ? 'NULL' : "'".$_POST['varTelefono']."'";
        $sql = "UPDATE tCatFranquicia SET
                    intEmpresa = $_POST[intEmpresa],
                    varNombre = '$_POST[varNombre]',
                    varDireccion = '$_POST[varDireccion]', 
                    varNumeroInterior = $numInterior, 
                    varNumeroExterior = '$_POST[varNumeroExterior]', 
                    varTelefono = $telefono,
                    intCiudad = $_POST[intCiudad], 
                    bitActivo = $_POST[bitActivo]
                WHERE intFranquicia =". $_POST['intFranquicia'];
        $resultado = $conexion->excuteQuery($sql);
        echo $resultado;
        break;
    case 'estados':
        $sql = "SELECT intEstado, varEstado FROM tCatEstado;";
        $resultado = $conexion->selectQuery($sql);
        echo $resultado;
        break; 
    case 'ciudad':
        $sql = "SELECT 
                    intCiudad, VarNombre
                FROM
                    tCatCiudad
                WHERE
                    intEstado =". $_POST['intEstado'];
        $resultado = $conexion->selectQuery($sql);
        echo $resultado;
        break;   
    case 'empresas':
        $sql = "SELECT intEmpresa, varNombreComercial FROM tCatEmpresa";
        $resultado = $conexion->selectQuery($sql);
        echo $resultado;
        break;   

}
?>