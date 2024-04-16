
/* Lógico_1: */
CREATE DATABASE SMARTSALES;
USE SMARTSALES;
--add DataCadastrada DATE
--add fk_Marca_Cod_Marca INT -> FK
CREATE TABLE Produto (
    Marca VARCHAR(50),
    Modelo VARCHAR(100),
    CodProduto INT PRIMARY KEY,
    Valor FLOAT,
    fk_Categoria_Cod_Categoria INT
);

--add Genero VARCHAR(50)
CREATE TABLE Estoque (
    Cor VARCHAR(50),
    Tamanho VARCHAR(50),
    Quantidade INT,
    CodProdutoEstoque INT PRIMARY KEY,
    fk_Produto_CodProduto INT
);

--add CREATE TABLE Marca
--add CodMarca INT PRIMARY KEY AUTO INCREMENT
--add Nome VARCHAR(50)
--add DataCadastrada DATE
--add DataAtualizada DATE

CREATE TABLE Cliente (
    Nome VARCHAR(100),
    Email VARCHAR(50),
    Celular VARCHAR(50),
    CPF BIGINT PRIMARY KEY,
    DataNasc DATE
);

CREATE TABLE Compra (
    CodCompra INT PRIMARY KEY,
    Valor FLOAT,
    Data DATE,
    fk_Cliente_CPF BIGINT,
    fk_Funcionario_CodFuncionario INT
);

CREATE TABLE Funcionario (
    CodFuncionario INT PRIMARY KEY,
    Nome VARCHAR(100),
    CPF VARCHAR(50),
    Senha VARCHAR(50),
    Cargo VARCHAR(50)
);

--add DataCadastrada DATE
--add DataAtualizada DATE
CREATE TABLE Categoria (
    Cod_Categoria INT PRIMARY KEY,
    Categoria VARCHAR(50)
);

CREATE TABLE Carrinho (
    fk_Estoque_CodProdutoEstoque INT,
    fk_Compra_CodCompra INT,
    Quantidade INT
);
 
ALTER TABLE Produto ADD CONSTRAINT FK_Produto_2
    FOREIGN KEY (fk_Categoria_Cod_Categoria)
    REFERENCES Categoria (Cod_Categoria)
    ON DELETE CASCADE;
 
ALTER TABLE Estoque ADD CONSTRAINT FK_Estoque_2
    FOREIGN KEY (fk_Produto_CodProduto)
    REFERENCES Produto (CodProduto)
    ON DELETE CASCADE;
 
ALTER TABLE Compra ADD CONSTRAINT FK_Compra_2
    FOREIGN KEY (fk_Cliente_CPF)
    REFERENCES Cliente (CPF)
    ON DELETE CASCADE;
 
ALTER TABLE Compra ADD CONSTRAINT FK_Compra_3
    FOREIGN KEY (fk_Funcionario_CodFuncionario)
    REFERENCES Funcionario (CodFuncionario)
    ON DELETE CASCADE;
 
ALTER TABLE Carrinho ADD CONSTRAINT FK_Carrinho_1
    FOREIGN KEY (fk_Estoque_CodProdutoEstoque)
    REFERENCES Estoque (CodProdutoEstoque)
    ON DELETE RESTRICT;
 
ALTER TABLE Carrinho ADD CONSTRAINT FK_Carrinho_2
    FOREIGN KEY (fk_Compra_CodCompra)
    REFERENCES Compra (CodCompra)
    ON DELETE SET NULL;