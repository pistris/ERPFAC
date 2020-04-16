<?php
header('Content-Type: application/json');
//require("conexion.php");
require("conexionPDO.php");
include("SRC/Funciones/Funciones.php"); //eliminar_simbolos

// $conexion = retornarConexion();

$conexion = new Conexion;

$sql = "SELECT 
            tbl1.intUsuario,
            tbl1.varNombre,
            CONCAT(tbl1.varApellidoPaterno,
                    ' ',
                    IFNULL(tbl1.varApellidoMaterno, '')) AS Apellidos,
            tbl2.intEmpresa,
            tbl3.intFranquicia,
            tbl2.varLogo
        FROM
            tCatUsuario tbl1
                LEFT JOIN
            tCatEmpresa tbl2 ON tbl2.intUsuario = tbl1.intUsuario
                LEFT JOIN
            tCatFranquicia tbl3 ON tbl3.intEmpresa = tbl2.intEmpresa
        WHERE
            tbl1.varEmail = '".$_POST['usuario']."'
                AND tbl1.texPassword = MD5('".$_POST['password']."')
                AND tbl1.bitActivo = 1;";
$resultado = $conexion->Query($sql);
$exito = 0;
 foreach ($resultado as $key => $row) {
        session_start();
        $_SESSION['intUsuario'] = $row->intUsuario;
        $_SESSION['varUsuario'] = $row->varNombre;
        $_SESSION['varApellidos'] = $row->Apellidos;
        $_SESSION['intEmpresa'] = $row->intEmpresa;
        $_SESSION['intFranquicia'] = $row->intFranquicia;
        $_SESSION['logo'] = $row->varLogo;
        $exito = 1;
 }
 echo $exito;

// $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
// $clave = mysqli_real_escape_string($conexion, $_POST['clave']);
// $respuesta = mysqli_query($conexion, "SELECT 
// intUsuario,
// CONCAT(varNombre, ' ', varApellidoPaterno, ' ', IFNULL(varApellidoMaterno, '')) as Usuario
// FROM
// tCatUsuario
// WHERE
// varUsuario = '$usuario' AND texPassword = MD5('$clave');"
// );
// if (mysqli_num_rows($respuesta) == 1) {
//     session_start();
//     $_SESSION['usuario'] = $usuario;
//     echo "correcta";
// } else {
//     echo "incorrecta";
// }
?>