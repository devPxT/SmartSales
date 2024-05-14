/* Lógico_1: */
DROP DATABASE if EXISTS SMARTSALES;
CREATE DATABASE SMARTSALES;
USE SMARTSALES;

-- Criação da tabela de categorias
CREATE TABLE categoria (
    id int AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    data_cad DATE,
    data_updt DATE
);

-- Criação da tabela de produtos
CREATE TABLE produto (
    id int PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    marca VARCHAR(255) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    genero VARCHAR(255),
    data_cad DATE,
    data_updt DATE,
    categoria_id int NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categoria(id) ON DELETE CASCADE
);

-- Criação da tabela de cargos
CREATE TABLE cargo (
    id int AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao VARCHAR(1000),
    data_cad DATE,
    data_updt DATE
);

-- Criação da tabela de estoque
CREATE TABLE estoque (
    id int AUTO_INCREMENT PRIMARY KEY,
    cor VARCHAR(255) NOT NULL,
    tamanho VARCHAR(255) NOT NULL,
    quantidade int NOT NULL,
    produto_id int NOT NULL,
    data_cad DATE,
    data_updt DATE,
    FOREIGN KEY (produto_id) REFERENCES produto(id) ON DELETE CASCADE
);

-- Criação da tabela de clientes
CREATE TABLE cliente (
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    celular VARCHAR(50),
    CPF VARCHAR(14) NOT NULL UNIQUE,
    dt_nasc DATE NOT NULL,
    data_cad DATE,
    data_updt DATE
);

-- Criação da tabela de funcionarios
CREATE TABLE funcionario (
    id int AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    dt_nasc DATE NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    login VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    cargo_id int NOT NULL,
    data_cad DATE,
    data_updt DATE,
    FOREIGN KEY (cargo_id) REFERENCES cargo(id) ON DELETE RESTRICT
);

-- Criação da tabela de compra
CREATE TABLE compra (
    id int PRIMARY KEY,
    valor FLOAT NOT NULL,
    data DATE NOT NULL,
    cliente_id int NOT NULL,
    funcionario_id int NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES cliente(id) ON DELETE CASCADE,
    FOREIGN KEY (funcionario_id) REFERENCES funcionario(id) ON DELETE CASCADE
);

-- Criação da tabela carrinho
CREATE TABLE carrinho (
	id int AUTO_INCREMENT PRIMARY KEY,
    estoque_id int,
    compra_id int,
    quantidade int,
    FOREIGN KEY (estoque_id) REFERENCES estoque(id) ON DELETE RESTRICT,
    FOREIGN KEY (compra_id) REFERENCES compra(id) ON DELETE RESTRICT
);

-- Inserção de categorias de exemplo
INSERT INTO categoria (nome, data_cad) VALUES
('Calçados', now()),
('Camiseta', now()),
('Calça', now()),
('Moletom', now());

-- Inserção de cargos de exemplo
INSERT INTO cargo (nome, descricao, data_cad) VALUES
('Administrador', 'Administrador do sistema', now()),
('Vendedor', 'Responsável pelas vendas da loja', now()),
('Almoxarife', 'Responsável pelo estoque da loja', now());

-- Inserção da única conta de administrador
INSERT INTO funcionario (nome, dt_nasc, cpf, login, senha, cargo_id, data_cad) 
VALUES ('João da Silva', '2005-06-07', '156.780.380-60', 'joao.silva', md5('Admin@123'), 1, now());

-- Inserção de cliente teste
INSERT INTO cliente (nome, email, celular, cpf, dt_nasc, data_cad) 
VALUES ('Cliente Teste', 'teste@gmail.com', '(41) 98765-4321', '636.597.050-12', '2000-01-01', now());

-- Inserção de produto teste
INSERT INTO produto (id, nome, marca, valor, genero, data_cad, categoria_id)
VALUES (125, 'Air Jordan One', 'Nike', 1050.00, 'Unisex', now(), 1);