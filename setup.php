<?php

$servidor = "localhost";
$usuario = "root";
$password = "";

// Conexión al servidor
$conexion = new mysqli($servidor, $usuario, $password);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8mb4");

// Crear la base de datos
$sql = "CREATE DATABASE IF NOT EXISTS SUPER247 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

if (!$conexion->query($sql)) {
    die("Error al crear la base de datos: " . $conexion->error);
}

// Seleccionar la base
$conexion->select_db("SUPER247");

// ==========================
// TABLA CLIENTES
// ==========================
$sql = "CREATE TABLE IF NOT EXISTS clientes(
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    dni INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(70) UNIQUE NOT NULL,
    contraseña VARCHAR(30) NOT NULL,
    telefono VARCHAR(30) NOT NULL,
    direccion VARCHAR(200)
)";
$conexion->query($sql);

// ==========================
// TABLA EMPLEADOS
// ==========================
$sql = "CREATE TABLE IF NOT EXISTS empleados(
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    dni INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(70) UNIQUE NOT NULL,
    contraseña VARCHAR(30) NOT NULL,
    disponible BOOLEAN DEFAULT TRUE
)";
$conexion->query($sql);

// ==========================
// TABLA REPARTIDORES
// ==========================
$sql = "CREATE TABLE IF NOT EXISTS repartidores(
    id_repartidor INT AUTO_INCREMENT PRIMARY KEY,
    dni INT NOT NULL,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    telefono VARCHAR(30),
    disponible BOOLEAN DEFAULT TRUE
)";
$conexion->query($sql);

// ==========================
// TABLA ADMINISTRADORES
// ==========================
$sql = "CREATE TABLE IF NOT EXISTS administradores(
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    dni INT NOT NULL,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    email VARCHAR(70),
    contraseña VARCHAR(30)
)";
$conexion->query($sql);

// ==========================
// TABLA SUCURSALES
// ==========================
$sql = "CREATE TABLE IF NOT EXISTS sucursales(
    id_sucursal INT AUTO_INCREMENT PRIMARY KEY,
    direccion VARCHAR(200)
)";
$conexion->query($sql);

// ==========================
// TABLA PRODUCTOS
// ==========================
$sql = "CREATE TABLE IF NOT EXISTS productos(
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL
)";
$conexion->query($sql);

// ==========================
// TABLA CHATS
// ==========================
$sql = "CREATE TABLE IF NOT EXISTS chats(
    id_chat INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_empleado INT NOT NULL,
    fecha_inicio DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_fin DATETIME,
    FOREIGN KEY(id_cliente) REFERENCES clientes(id_cliente),
    FOREIGN KEY(id_empleado) REFERENCES empleados(id_empleado)
)";
$conexion->query($sql);

// ==========================
// TABLA MENSAJES
// ==========================
$sql = "CREATE TABLE IF NOT EXISTS mensajes(
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
    id_chat INT NOT NULL,
    mensaje TEXT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(id_chat) REFERENCES chats(id_chat)
)";
$conexion->query($sql);

// ==========================
// TABLA PEDIDOS
// ==========================
$sql = "CREATE TABLE IF NOT EXISTS pedidos(
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_empleado INT NOT NULL,
    id_repartidor INT,
    id_sucursal INT,
    tipo_entrega ENUM('RETIRO','DELIVERY') NOT NULL,
    estado ENUM(
        'EN PREPARACION',
        'LISTO PARA RETIRAR',
        'EN REPARTO',
        'ENTREGADO'
    ) DEFAULT 'EN PREPARACION',
    fecha_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2),
    FOREIGN KEY(id_cliente) REFERENCES clientes(id_cliente),
    FOREIGN KEY(id_empleado) REFERENCES empleados(id_empleado),
    FOREIGN KEY(id_repartidor) REFERENCES repartidores(id_repartidor),
    FOREIGN KEY(id_sucursal) REFERENCES sucursales(id_sucursal)
)";
$conexion->query($sql);

// ==========================
// TABLA DETALLE PEDIDO
// ==========================
$sql = "CREATE TABLE IF NOT EXISTS detalle_pedido(
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2),
    observacion TEXT,
    FOREIGN KEY(id_pedido) REFERENCES pedidos(id_pedido),
    FOREIGN KEY(id_producto) REFERENCES productos(id_producto)
)";
$conexion->query($sql);

// ==========================
// TABLA HISTORIAL ESTADOS
// ==========================
$sql = "CREATE TABLE IF NOT EXISTS historial_estados(
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL,
    estado ENUM(
        'EN PREPARACION',
        'LISTO PARA RETIRAR',
        'EN REPARTO',
        'ENTREGADO'
    ),
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(id_pedido) REFERENCES pedidos(id_pedido)
)";
$conexion->query($sql);

echo "<h2>Instalación completada correctamente.</h2>";
echo "<p>La base de datos y todas las tablas fueron verificadas.</p>";

$conexion->close();

?>