-- CREATE DATABASE dbloja;
USE dbloja;
CREATE TABLE cliente
(
    id_cli INT(12) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome_cli
    rua VARCHAR(255) NOT NULL,
    numero INT(12) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    uf VARCHAR(2) NOT NULL,
    telefone VARCHAR(15)
)
CREATE TABLE pedido