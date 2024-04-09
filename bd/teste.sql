DROP DATABASE if EXISTS teste;
CREATE DATABASE teste;

-- Seleção do banco de dados
USE teste;

-- Criação da tabela de categorias
CREATE TABLE categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

-- Criação da tabela de produtos
CREATE TABLE produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    marca VARCHAR(255) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    genero VARCHAR(255),
    data DATE,
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES categoria(id) ON DELETE SET NULL
);

-- Inserção de categorias de exemplo
INSERT INTO categoria (nome) VALUES
('Calçados'),
('Camiseta'),
('Calça'),
('Moletom');