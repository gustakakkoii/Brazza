SELECT * FROM pedido;
SELECT * FROM pedido_com_lanche;
SELECT * FROM pedido_has_complemento;
SELECT * FROM pedido_has_combo;
SELECT * FROM pedido_has_bebidas;

-- Ficha completa dos pedidos
SELECT 
pedido.idPedido,
pedido.datadopedido,
pedido.horadopedido,
pedido.cliente,
pedido.valorpedido,
pedido.rua,
pedido.numerocasa,
pedido.bairro,
formas_de_pagamento.forma_de_pagamento,
pedido_com_lanche.Quantidade AS 'quantlanches',
lanches.Nome AS 'lanches', 
pedido_has_bebidas.quantidade AS 'quantbebidas',
bebidas.Nome AS 'bebidas',
pedido_has_combo.quantidade AS 'quantcombos',
combo.Nome AS 'combos',
pedido_has_complemento.quantidade AS 'quantcomplementos',
complemento.Nome AS 'complementos'
FROM pedido
LEFT JOIN formas_de_pagamento ON formas_de_pagamento.idformas_de_pagamento = pedido.pagamento
LEFT JOIN pedido_com_lanche ON pedido_com_lanche.pedido_idPedido = pedido.idPedido
LEFT JOIN lanches ON lanches.idLanches = pedido_com_lanche.idLanches
LEFT JOIN pedido_has_bebidas ON pedido_has_bebidas.pedido_idPedido = pedido.idPedido
LEFT JOIN bebidas ON bebidas.idBebidas = pedido_has_bebidas.bebidas_idBebidas
LEFT JOIN pedido_has_combo ON pedido_has_combo.pedido_idPedido = pedido.idPedido
LEFT JOIN combo ON combo.idCombo = pedido_has_combo.combo_idCombo
LEFT JOIN pedido_has_complemento ON pedido_has_complemento.pedido_idPedido = pedido.idPedido
LEFT JOIN complemento ON complemento.idComplemento = pedido_has_complemento.complemento_idComplemento
ORDER BY pedido.datadopedido DESC,pedido.horadopedido DESC;

-- Quanto de cada lanche vendido em uma determinada data
SELECT lanches.Nome, SUM(pedido_com_lanche.quantidade) AS 'Soma'
FROM pedido
INNER JOIN pedido_com_lanche ON pedido_com_lanche.pedido_idPedido = pedido.idPedido
INNER JOIN lanches ON lanches.idLanches = pedido_com_lanche.idLanches
WHERE pedido.datadopedido LIKE '2022-11-0%'
GROUP BY lanches.Nome
ORDER BY lanches.Nome;

-- Quanto de cada Combo vendido em uma determinada data
SELECT combo.Nome, SUM(pedido_has_combo.quantidade) AS 'Soma'
FROM pedido
INNER JOIN pedido_has_combo ON pedido_has_combo.pedido_idPedido = pedido.idPedido
INNER JOIN combo ON combo.idCombo = pedido_has_combo.combo_idCombo
WHERE pedido.datadopedido LIKE '2022-11-0%'
GROUP BY combo.Nome
ORDER BY combo.Nome;

-- Quanto de cada complemento vendido em uma determinado data
SELECT complemento.Nome, SUM(pedido_has_complemento.quantidade) AS 'Soma'
FROM pedido
INNER JOIN pedido_has_complemento ON pedido_has_complemento.pedido_idPedido = pedido.idPedido
INNER JOIN complemento ON complemento.idComplemento = pedido_has_complemento.complemento_idComplemento
WHERE pedido.datadopedido LIKE '2022-11-0%'
GROUP BY complemento.Nome
ORDER BY complemento.Nome;

-- Quantas entregas foram feitas em uma determinada data
SELECT COUNT(*) FROM pedido
WHERE Rua != 'buscou'
AND pedido.datadopedido LIKE '2022-11-0%';

-- Quanto de cada lanche foi vendido em cada dia?
SELECT pedido.datadopedido, lanches.Nome, SUM(pedido_com_lanche.quantidade) AS 'Soma'
FROM pedido
INNER JOIN pedido_com_lanche ON pedido_com_lanche.pedido_idPedido = pedido.idPedido
INNER JOIN lanches ON lanches.idLanches = pedido_com_lanche.idLanches
WHERE pedido.datadopedido LIKE '2022-11-0%'
GROUP BY pedido.datadopedido, lanches.Nome
ORDER BY pedido.datadopedido, lanches.Nome DESC;

-- Quantos pedidos foram feitos por dia?
SELECT pedido.datadopedido, COUNT(*) FROM pedido
GROUP BY pedido.datadopedido
ORDER BY pedido.datadopedido DESC;

-- Qual foi o dia que mais lucrou?
CREATE VIEW IF NOT EXISTS lucrodiario AS
SELECT pedido.datadopedido, SUM(pedido.valorpedido) AS 'Soma' FROM pedido
GROUP BY pedido.datadopedido;

SELECT lucrodiario.datadopedido, lucrodiario.Soma FROM lucrodiario
WHERE Soma = (SELECT MAX(Soma) FROM lucrodiario);






SELECT * FROM combo WHERE ativo = 1;

SELECT lanches.Nome, combo_com_lanche.Quantidade FROM combo
left JOIN combo_com_lanche ON combo_com_lanche.idCombo = combo.idCombo
left JOIN lanches ON lanches.idLanches = combo_com_lanche.idLanches
WHERE combo.idCombo = '1';

SELECT * FROM combo
left JOIN combo_com_lanche ON combo_com_lanche.idCombo = combo.idCombo
left JOIN lanches ON lanches.idLanches = combo_com_lanche.idLanches;



SELECT * FROM config