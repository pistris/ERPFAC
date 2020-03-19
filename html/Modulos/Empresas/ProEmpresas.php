<?php
header('Content-Type: application/json');
//require("../../conexion.php");
require("../../conexionPDO.php");
include("../../SRC/Funciones/Funciones.php"); //eliminar_simbolos	

//$conexion = retornarConexion();

$conexion = new Conexion;

switch ($_GET['accion']) {
    case 'listar':
        $sql = "SELECT 
                    intEmpresa,
                    varNombreComercial,
                    ifnull(varRFC,'') as varRFC,
                    IF(bitActivo = 0, 'Inactivo', 'Activo') AS estado
                FROM
                    tCatEmpresa;";
        $resultado = $conexion->selectQuery($sql);
        echo $resultado;
        break;
    case 'agregar':
        $numInterior = $_REQUEST['varNumeroInterior']== '' ? 'NULL' : "'".$_REQUEST['varNumeroInterior']."'";
        $telefono = $_REQUEST['varTelefono']== '' ? 'NULL' : "'".$_REQUEST['varTelefono']."'";
        $email = $_REQUEST['varEmail']== '' ? 'NULL' : "'".$_REQUEST['varEmail']."'";
        $random = date('Y').date('m').date('d').date('H').date('i').date('s');        
        $logo = 'NULL';
  
		if ($_POST['bitImagen'] == 'true'){
            $random = date('Y').date('m').date('d').date('H').date('i').date('s');
            $logo = eliminar_simbolos($random."_".$_FILES['imgImagen']['name']);
            move_uploaded_file($_FILES['imgImagen']['tmp_name'], '../../SRC/imagenes/Logos/'.$logo);
            $logo = "'".$logo."'";
        }        

        $sql = "INSERT INTO tCatEmpresa (
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
                                        intCiudad,
                                        intRegimenFiscal,
                                        varLogo
                                    )
                                VALUES(
                                    '$_REQUEST[varNombreComercial]', 
                                    '$_REQUEST[varRazonSocial]', 
                                    '$_REQUEST[varRFC]', 
                                    '$_REQUEST[varDireccion]', 
                                    $telefono, 
                                    $email, 
                                    $_REQUEST[bitActivo], 
                                    $numInterior, 
                                    '$_REQUEST[varNumeroExterior]', 
                                    $_REQUEST[intCodigoPostal], 
                                    $_REQUEST[intCiudad],
                                    $_REQUEST[intRegimenFiscal],
                                    $logo
                                )";
        $resultado = $conexion->excuteQuery($sql);
        echo $resultado;
        break;
    case 'recuperar':
        $sql = "SELECT
                    tbl1.*, tbl3.intEstado
                FROM
                    tCatEmpresa tbl1
                        INNER JOIN
                    tCatCiudad tbl2 ON tbl2.intCiudad = tbl1.intCiudad
                        INNER JOIN
                    tCatEstado tbl3 ON tbl3.intEstado = tbl2.intEstado
                WHERE tbl1.intEmpresa=$_POST[intEmpresa]";
        $resultado = $conexion->selectQuery($sql);
        echo $resultado;
        break;
    case 'borrar':
        $sql = "DELETE FROM tCatEmpresa WHERE intEmpresa=".$_POST['intEmpresa'];
        $resultado = $conexion->excuteQuery($sql);
        echo $resultado;
        break;
    case 'modificar':
        $numInterior = $_POST['varNumeroInterior']== '' ? 'NULL' : "'".$_POST['varNumeroInterior']."'";
        $telefono = $_POST['varTelefono']== '' ? 'NULL' : "'".$_POST['varTelefono']."'";
        $email = $_POST['varEmail']== '' ? 'NULL' : "'".$_POST['varEmail']."'";
        $logo = 'NULL';
  
		if ($_POST['bitImagen'] == 'true'){
            $random = date('Y').date('m').date('d').date('H').date('i').date('s');
            $logo = eliminar_simbolos($random."_".$_FILES['imgImagen']['name']);
            move_uploaded_file($_FILES['imgImagen']['tmp_name'], '../../SRC/imagenes/Logos/'.$logo);
            $logo = "'".$logo."'";

            if($_POST['lblLogo'] != ''){
                unlink('../../SRC/imagenes/Logos/'.$_POST['lblLogo']);
            }

        }else if($_POST['lblLogo'] != ''){
            $logo = $_POST['lblLogo'];
        }
        
        $sql = "UPDATE tCatEmpresa SET
                        varNombreComercial = '$_POST[varNombreComercial]',
                        varRazonSocial = '$_POST[varRazonSocial]',
                        varRFC = '$_POST[varRFC]', 
                        varDireccion = '$_POST[varDireccion]', 
                        varTelefono = $telefono,
                        varEmail = $email, 
                        bitActivo = $_POST[bitActivo], 
                        varNumeroInterior = $numInterior, 
                        varNumeroExterior = '$_POST[varNumeroExterior]', 
                        intCodigoPostal = $_POST[intCodigoPostal], 
                        intCiudad = $_POST[intCiudad],
                        intRegimenFiscal = $_POST[intRegimenFiscal],
                        varLogo = $logo
                    WHERE intEmpresa=".$_POST['intEmpresa'];
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
    case 'regimenfiscal':
        $sql = "SELECT 
                    intRegimenFiscal, varDescripcion
                FROM
                    tCatRegimenFiscal";
        $resultado = $conexion->selectQuery($sql);
        echo $resultado;
        break;
    case 'validaBorrarEmpresa':
        $sql = "SELECT COUNT(*) AS Franquicias FROM tCatFranquicia WHERE intEmpresa=".$_POST['intEmpresa'];
        $resultado = $conexion->selectQuery($sql);
        echo $resultado;
        break; 
}
?>