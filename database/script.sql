-- SQLBook: Code
 CREATE DATABASE dbloja;
USE dbloja;
CREATE TABLE cliente
(
    id_cli INT(12) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome_cli varchar(50) not NULL,
    rua VARCHAR(50) NOT NULL,
    numero INT(12) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    telefone VARCHAR(15),
    documento VARCHAR(4)
)

CREATE TABLE pedido
(
    id_ped int(12) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_cli int(12) NOT NULL,
    data_ped DATE,
    prazo_entrega DATE,
    FOREIGN KEY (id_cli) REFERENCES cliente(id_cli)
);
CREATE TABLE produto
(
    id_prod int(12) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome_prod varchar(50) NOT NULL,
    desc_prod varchar(150) NOT NULL,
    preco_unit float(12) NOT NULL
)

CREATE TABLE item_pedido
(
    id_ped int(12) NOT NULL,
    id_prod int(12) NOT NULL,
    quant int NOT NULL,
    preco_unit decimal(10, 2) NOT NULL,
    PRIMARY KEY (id_ped, id_prod),
    FOREIGN KEY (id_ped) REFERENCES pedido(id_ped),
    FOREIGN KEY (id_prod) REFERENCES produto(id_prod)
);
USE dbloja;
SELECT * FROM cliente;
USE dbloja;
SELECT * FROM produto;