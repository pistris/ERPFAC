<?php

function retornarConexion() {
$con = mysqli_connect(
    "bdsistemaerp.cyfdhmrju78e.us-east-2.rds.amazonaws.com",
    "adminerp",
    "RD4l2fwiczO7W87bFbhj",
    "dbERP") or die("problemas");
    mysqli_set_charset($con,'utf8');
    return $con;   
}

?>
