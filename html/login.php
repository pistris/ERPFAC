<?php
require("conexion.php");

$conexion = retornarConexion();

$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
$clave = mysqli_real_escape_string($conexion, $_POST['clave']);
$respuesta = mysqli_query($conexion, "SELECT 
intUsuario,
CONCAT(varNombre, ' ', varApellidoPaterno, ' ', IFNULL(varApellidoMaterno, '')) as Usuario
FROM
tCatUsuario
WHERE
varUsuario = '$usuario' AND texPassword = MD5('$clave');"
);
if (mysqli_num_rows($respuesta) == 1) {
    session_start();
    $_SESSION['usuario'] = $usuario;
    echo "correcta";
} else {
    echo "incorrecta";
}
?>