CREATE DATABASE SUPER247;
USE SUPER247;
CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    dni int NOTNULL,
    nombre VARCHAR(50) NOTNULL,
    apellido VARCHAR(50) NOTNULL,
    email VARCHAR(70) UNIQUE NOTNULL,
    contraseña VARCHAR(30) NOTNULL,

    telefono VARCHAR(30) NOTNULL,

    direccion VARCHAR(200)

);

CREATE TABLE empleados (

    id_empleado INT AUTO_INCREMENT PRIMARY KEY,

    dni int NOTNULL,

    nombre VARCHAR(50) NOT NULL,

    apellido VARCHAR(50) NOT NULL,

    email VARCHAR(70) NOTNULL UNIQUE,

    contraseña VARCHAR(30) NOTNULL,

    disponible BOOLEAN DEFAULT TRUE

);

CREATE TABLE repartidores (

    id_repartidor INT AUTO_INCREMENT PRIMARY KEY,

    dni int NOTNULL,

    nombre VARCHAR(100),

    apellido VARCHAR(100),

    telefono VARCHAR(30),

    disponible BOOLEAN DEFAULT TRUE

);

CREATE TABLE administradores (

    id_admin INT AUTO_INCREMENT PRIMARY KEY,

    dni int NOTNULL,

    nombre VARCHAR(50),

    apellido VARCHAR(50),

    email VARCHAR(70),

    contraseña VARCHAR(30)

);



CREATE TABLE sucursales (

    id_sucursal INT AUTO_INCREMENT PRIMARY KEY,

    direccion VARCHAR(200)

);

CREATE TABLE productos (

    id_producto INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    descripcion TEXT,

    precio DECIMAL(10,2) NOT NULL,

    stock INT NOT NULL

    

);

CREATE TABLE chats (

    id_chat INT AUTO_INCREMENT PRIMARY KEY,

    id_cliente INT NOT NULL,

    id_empleado INT NOT NULL,

    fecha_inicio DATETIME DEFAULT CURRENT_TIMESTAMP,

    fecha_fin DATETIME,



    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),

    FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado)

);

CREATE TABLE mensajes (

    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,

    id_chat INT NOT NULL,

    mensaje TEXT NOT NULL,

    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,



    FOREIGN KEY (id_chat) REFERENCES chats(id_chat)

);



CREATE TABLE pedidos (

    id_pedido INT AUTO_INCREMENT PRIMARY KEY,

    id_cliente INT NOT NULL,

    id_empleado INT NOT NULL,

    id_repartidor INT NULL,

    id_sucursal INT NULL,



    tipo_entrega ENUM('RETIRO','DELIVERY') NOT NULL,



    estado ENUM(

        'EN PREPARACION',

        'LISTO PARA RETIRAR',

        'EN REPARTO',

        'ENTREGADO'

    ) DEFAULT 'EN PREPARACION',



    fecha_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,

    total DECIMAL(10,2),



    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),

    FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado),

    FOREIGN KEY (id_repartidor) REFERENCES repartidores(id_repartidor),

    FOREIGN KEY (id_sucursal) REFERENCES sucursales(id_sucursal)

);

CREATE TABLE detalle_pedido (

    id_detalle INT AUTO_INCREMENT PRIMARY KEY,

    id_pedido INT NOT NULL,

    id_producto INT NOT NULL,

    cantidad INT NOT NULL,

    precio_unitario DECIMAL(10,2),

    observacion TEXT,



    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),

    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)

);

CREATE TABLE historial_estados (

    id_historial INT AUTO_INCREMENT PRIMARY KEY,

    id_pedido INT NOT NULL,

    estado ENUM(

        'EN PREPARACION',

        'LISTO PARA RETIRAR',

        'EN REPARTO',

        'ENTREGADO'

    ),

    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,



    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido)

);