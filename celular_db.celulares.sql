CREATE DATABASE celular_db;

USE celular_db;

CREATE TABLE celular (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(50) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    preco_com_mao_de_obra DECIMAL(10,2) NOT NULL
);
