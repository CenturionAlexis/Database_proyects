<?php
include("menu.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Cliente</title>
</head>

<body>

<h2>Registrar Cliente</h2>

<form action="guardar_cliente.php" method="POST">

    <label>DNI</label><br>
    <input type="number" name="dni" required><br><br>

    <label>Nombre</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Apellido</label><br>
    <input type="text" name="apellido" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Contraseña</label><br>
    <input type="password" name="contrasena" required><br><br>

    <label>Teléfono</label><br>
    <input type="text" name="telefono" required><br><br>

    <label>Dirección</label><br>
    <input type="text" name="direccion"><br><br>

    <input type="submit" value="Guardar">

</form>

</body>
</html>