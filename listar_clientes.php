<?php

include("menu.php");
include("config.php");

$sql = "SELECT * FROM clientes";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Listado de Clientes</title>

</head>

<body>

<h2>Clientes Registrados</h2>

<table border="1">

<tr>

<th>ID</th>
<th>DNI</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Email</th>
<th>Teléfono</th>
<th>Dirección</th>

</tr>

<?php

while($fila = $resultado->fetch_assoc()){

echo "<tr>";

echo "<td>".$fila["id_cliente"]."</td>";
echo "<td>".$fila["dni"]."</td>";
echo "<td>".$fila["nombre"]."</td>";
echo "<td>".$fila["apellido"]."</td>";
echo "<td>".$fila["email"]."</td>";
echo "<td>".$fila["telefono"]."</td>";
echo "<td>".$fila["direccion"]."</td>";

echo "</tr>";

}

?>

</table>

</body>
</html>