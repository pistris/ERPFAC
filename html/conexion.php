<?php
function retornarConexion() {
    $server="bhuaagzhlgugk5u9beiw-mysql.services.clever-cloud.com";
    $usuario="uqmqkkwu33ddsizp";
    $clave="RZIZqzC0eIuZ901QyzPA";
    $base="bhuaagzhlgugk5u9beiw";
    return new PDO("mysql:dbname=$base;host=$server", "$usuario","$clave", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
}
?>