DROP DATABASE if EXISTS teste;
CREATE DATABASE teste;

-- Seleção do banco de dados
USE teste;

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
    data DATE,
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES categoria(id) ON DELETE RESTRICT
);

-- Criação da tabela de cargos
CREATE TABLE cargo (
	id int AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao VARCHAR(1000),
    data_cad DATE,
    data_updt DATE
);

-- Criação da tabela de funcionarios
CREATE TABLE funcionario (
	id int AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    dt_nasc DATE NOT NULL,
    cpf VARCHAR(13) NOT NULL UNIQUE,
    login VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    cargo_id int NOT NULL,
    FOREIGN KEY (cargo_id) REFERENCES cargo(id) ON DELETE RESTRICT
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