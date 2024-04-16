# PREVIEW DA COMPRA / RECIBO

USE SMARTSALES;
SELECT 
    p.Marca,
    p.Modelo,
    e.Cor,
    e.Tamanho,
    c.Quantidade,
    p.Valor AS ValorUnitario,
    (c.Quantidade * p.Valor) AS ValorTotalItem,
    comp.Valor AS ValorTotalCompra
FROM Carrinho c
JOIN Estoque e ON c.fk_Estoque_CodProdutoEstoque = e.CodProdutoEstoque
JOIN Produto p ON e.fk_Produto_CodProduto = p.CodProduto
JOIN Compra comp ON c.fk_Compra_CodCompra = comp.CodCompra
WHERE comp.CodCompra = 1;

# COMPRAS FEITAS POR FUNCIONÁRIO

SELECT 
    comp.CodCompra,
    cl.Nome AS NomeCliente,
    comp.Data,
    comp.Valor AS ValorTotalCompra,
    (SELECT SUM(Valor) FROM Compra WHERE fk_Funcionario_CodFuncionario = 1) AS SomaTotalVendas
FROM Compra comp
JOIN Cliente cl ON comp.fk_Cliente_CPF = cl.CPF
JOIN Funcionario func ON comp.fk_Funcionario_CodFuncionario = func.CodFuncionario
WHERE func.CodFuncionario = 1;

# PRODUTOS EXISTENTES NO ESTOQUE, POR ORDEM CRESCENTE DE VALOR

SELECT 
    p.Marca,
    p.Modelo,
    MIN(p.Valor) AS MenorValor
FROM Produto p
JOIN Estoque e ON p.CodProduto = e.fk_Produto_CodProduto
WHERE e.Quantidade > 0
GROUP BY p.Marca, p.Modelo
ORDER BY MenorValor ASC;