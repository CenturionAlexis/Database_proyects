<?php

$servidor="localhost";
$usuario="root";
$password="";
$basedatos="Data";

$conexion=new mysqli($servidor,$usuario,$password,$basedatos);

if($conexion->connect_error){
    die("Error de conexión");
}

?>