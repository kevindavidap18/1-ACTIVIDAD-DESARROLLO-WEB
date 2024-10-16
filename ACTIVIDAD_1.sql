CREATE DATABASE ACTIVIDAD_1;

USE ACTIVIDAD_1;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100),
    rol VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    telefono VARCHAR(15),
    estado VARCHAR(20),
    fecha_registro DATE
);

CREATE TABLE tablaOrden (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total FLOAT,
    cantidad INT,
    descripcion VARCHAR(255),
    fecha_orden DATE,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);
