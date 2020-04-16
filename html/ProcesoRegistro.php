<?php
    header('Content-Type: application/json');
    require("conexionPDO.php");

    $conexion = new Conexion;
	$conexion->conectarBase();


    $apellidoM = $_REQUEST['txtApellidoM']== '' ? 'NULL' : "'".$_REQUEST['txtApellidoM']."'";     

    $sql = "INSERT INTO tCatUsuario (
                                    varNombre,
                                    varApellidoPaterno, 
                                    varApellidoMaterno, 
                                    varUsuario, 
                                    texPassword, 
                                    varEmail, 
                                    bitActivo, 
                                    intPlanPago
                                )
                            VALUES(
                                '$_REQUEST[txtNombre]', 
                                '$_REQUEST[txtAppellidoP]', 
                                $apellidoM, 
                                '$_REQUEST[txtNombre]', 
                                '$_REQUEST[txtPassword]',
                                '$_REQUEST[txtEmail]',
                                1,
                                2
                            )";
    $conexion->excuteConsulta($sql);
    $resultado = $conexion->ultimoId();
    $exito = 0;
    if($resultado > 0){
        session_start();
        $_SESSION['intUsuario'] = $resultado;
        $_SESSION['varUsuario'] = $_REQUEST['txtNombre'];
        $_SESSION['varApellidos'] = $_REQUEST['txtAppellidoP']. ' '.$_REQUEST['txtApellidoM'];
        $_SESSION['intEmpresa'] = '';
        $_SESSION['intFranquicia'] = '';
        $_SESSION['logo'] = '';
        $exito = 1;
 }
 echo $exito;
    // echo $sql;

?>