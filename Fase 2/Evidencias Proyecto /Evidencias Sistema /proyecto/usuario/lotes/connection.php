<?php


function connection(){

    $host = "localhost";
    $user = "cbu91029_cberrios";
    $pass = "carlitrox21";
    $bd = "cbu91029_citt";

    $connect=mysqli_connect($host, $user, $pass);

    mysqli_select_db($connect, $bd);
    
    return $connect;
}

?>