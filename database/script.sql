-- SQLBook: Markup

-- SQLBook: Code
-- CREATE DATABASE dbloja;
USE dbloja;
CREATE TABLE cliente
(
    id_cli INT(12) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome_cli varchar(50) not NULL,
    rua VARCHAR(255) NOT NULL,
    numero INT(12) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    uf VARCHAR(2) NOT NULL,
    telefone VARCHAR(15),
    documento VARCHAR(4)
)
CREATE TABLE pedido
(
    id_ped int(12) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_cli int(12) FOREIGN KEY AUTO_INCREMENT NOT NULL,
    data_
)