<?php

function retornarConexion() {
    $server="bdsistemaerp.cyfdhmrju78e.us-east-2.rds.amazonaws.com";
    $usuario="adminerp";
    $clave="RD4l2fwiczO7W87bFbhj";
    $base="dbERP";
    return new PDO("mysql:dbname=$base;host=$server", "$usuario","$clave", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
}

?>