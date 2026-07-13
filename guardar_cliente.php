<?php

include("config.php");

$dni = $_POST["dni"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$contrasena = $_POST["contrasena"];
$telefono = $_POST["telefono"];
$direccion = $_POST["direccion"];

$sql = "INSERT INTO clientes
(dni,nombre,apellido,email,contraseña,telefono,direccion)
VALUES
('$dni','$nombre','$apellido','$email','$contrasena','$telefono','$direccion')";

if($conexion->query($sql)){
    echo "Cliente guardado correctamente.";
}else{
    echo "Error: ".$conexion->error;
}

$conexion->close();

?>