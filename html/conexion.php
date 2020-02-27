<?php

function retornarConexion() {
$con = mysqli_connect(
    "bhuaagzhlgugk5u9beiw-mysql.services.clever-cloud.com", //host
    "uqmqkkwu33ddsizp", //usr
    "RZIZqzC0eIuZ901QyzPA", //pass
    "bhuaagzhlgugk5u9beiw") or die("problemas");
    mysqli_set_charset($con,'utf8');
    return $con;   
}

?>
