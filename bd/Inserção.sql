USE SMARTSALES;

INSERT INTO Funcionario (CodFuncionario, Nome, CPF, Senha, Cargo) 
VALUES (1, 'João da Silva', '12345678901', 'senha123', 'Vendedor'),
       (2, 'Maria Oliveira', '23456789012', 'segredo456', 'Gerente de Vendas'),
       (3, 'Carlos Pereira', '34567890123', 'acesso789', 'Estoquista');

INSERT INTO Categoria (Cod_Categoria, Categoria)
VALUES (1, 'Camisetas'),
       (2, 'Calças'),
       (3, 'Casacos'),
       (4, 'Blusas'),
       (5, 'Shorts');
       
INSERT INTO Produto (Marca, Modelo, CodProduto, Valor, fk_Categoria_Cod_Categoria)
VALUES ('Adidas', 'Camiseta Preta', 1, 29.99, 1),
       ('Nike', 'Calça Jeans', 2, 49.99, 2),
       ('Puma', 'Moletom Cinza', 3, 39.99, 3),
       ('Zara', 'Blusa Floral', 4, 19.99, 1),
       ('Levis', 'Shorts Jeans', 5, 34.99, 2);



INSERT INTO Cliente (Nome, Email, Celular, CPF, DataNasc)
VALUES ('Ana Silva', 'ana@example.com', '(11) 91234-5678', 12345678901, '1990-05-15'),
       ('Pedro Oliveira', 'pedro@example.com', '(11) 99876-5432', 23456789012, '1985-10-20'),
       ('Juliana Pereira', 'juliana@example.com', '(11) 98765-4321', 34567890123, '2000-03-25');

INSERT INTO Estoque (Cor, Tamanho, Quantidade, CodProdutoEstoque, fk_Produto_CodProduto)
VALUES ('Preto', 'M', 50, 1, 1),
       ('Azul', 'G', 30, 2, 2),
       ('Cinza', 'P', 20, 3, 3),
       ('Floral', 'M', 40, 4, 4),
       ('Jeans', 'G', 25, 5, 5),
       ('Branco', 'P', 15, 6, 1),
       ('Verde', 'G', 10, 7, 2),
       ('Vermelho', 'M', 25, 8, 3),
       ('Preto', 'GG', 20, 9, 4),
       ('Amarelo', 'P', 30, 10, 5);

INSERT INTO Compra (CodCompra, Valor, Data, fk_Cliente_CPF, fk_Funcionario_CodFuncionario)
VALUES (1, 59.99, '2024-04-08', 12345678901, 1),
       (2, 129.98, '2024-04-09', 23456789012, 2),
       (3, 99.97, '2024-04-09', 34567890123, 3),
       (4, 74.95, '2024-04-10', 12345678901, 1),
       (5, 199.96, '2024-04-10', 23456789012, 2);

       
INSERT INTO Carrinho (fk_Estoque_CodProdutoEstoque, fk_Compra_CodCompra, Quantidade)
VALUES (1, 1, 2),    -- 2 itens da compra 1
       (2, 1, 1),    -- mais 1 item da compra 1, totalizando 3 itens
       (3, 2, 1),    -- 1 item da compra 2
       (4, 2, 2),    -- mais 2 itens da compra 2, totalizando 3 itens
       (5, 3, 1),    -- 1 item da compra 3
       (6, 3, 2),    -- mais 2 itens da compra 3, totalizando 3 itens
       (7, 4, 1),    -- 1 item da compra 4
       (8, 4, 2),    -- mais 2 itens da compra 4, totalizando 3 itens
       (9, 5, 1),    -- 1 item da compra 5
       (10, 5, 2);   -- mais 2 itens da compra 5, totalizando 3 itens


