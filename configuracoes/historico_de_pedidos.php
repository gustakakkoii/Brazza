<?php
include_once('../config.php');
$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    include_once('./head.php');
    ?>
</head>

<body>
    <nav>
        <?php
        include_once('./menu.php');
        ?>
    </nav>
    <main>
        <div class="corpo">
            <?php
            if (isset($_POST['set'])) {
                $consulta3 = "SELECT idPedido FROM pedido";
                $con3 = $mysqli->query($consulta3) or die($mysqli->error);
                while ($dado3 = $con3->fetch_array()) {
                    $id = $dado3['idPedido'];
                    if (isset($_POST[$id])) {
                        $consulta = "SELECT COUNT(*) FROM pedido WHERE idPedido = $id;";
                        $con = $mysqli->query($consulta) or die($mysqli->error);
                        while ($dado = $con->fetch_array()) {
                            if ($dado['COUNT(*)'] > 0) {

                                $consulta2 = "DELETE FROM pedido_com_lanche WHERE pedido_idPedido = $id;";
                                $con2 = $mysqli->query($consulta2) or die($mysqli->error);
                                $consulta2 = "DELETE FROM pedido_has_combo WHERE pedido_idPedido = $id;";
                                $con2 = $mysqli->query($consulta2) or die($mysqli->error);
                                $consulta2 = "DELETE FROM pedido_has_bebidas WHERE pedido_idPedido = $id;";
                                $con2 = $mysqli->query($consulta2) or die($mysqli->error);
                                $consulta2 = "DELETE FROM pedido_has_complemento WHERE pedido_idPedido = $id;";
                                $con2 = $mysqli->query($consulta2) or die($mysqli->error);
                                $consulta2 = "DELETE FROM pedido WHERE idPedido = $id;";
                                $con2 = $mysqli->query($consulta2) or die($mysqli->error);
                            }
                        }
                    }
                }
            }
            ?>
            <form action="#" method="post" id="form">
                <input name="set" onclick="falert()" value="Salvar">
                <?php

                $consulta =
                    "SELECT datadopedido FROM pedido
            GROUP BY datadopedido
            ORDER BY datadopedido DESC;";
                $con = $mysqli->query($consulta) or die($mysqli->error);
                while ($dado = $con->fetch_array()) {
                    $datalike = $dado['datadopedido'];
                    $diasemana_numero = date('w', strtotime($datalike));
                ?>
                    <div class="data"><?= $diasemana[$diasemana_numero] .  '<br>' . substr($dado['datadopedido'], 8, 10) . '/' . substr($dado['datadopedido'], 5, -3) . '/' . substr($dado['datadopedido'], 0, 4)  ?></div>

                    <?php
                    $consulta2 =
                        "SELECT 
                    pedido.idPedido,
                    pedido.datadopedido,
                    pedido.horadopedido,
                    pedido.rua,
                    pedido.numerocasa,
                    pedido.bairro,
                    pedido.cliente,
                    pedido.valorpedido,
                    formas_de_pagamento.forma_de_pagamento
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
                    WHERE pedido.datadopedido LIKE '$datalike%'
                    GROUP BY pedido.idPedido
                    ORDER BY pedido.datadopedido DESC,pedido.horadopedido DESC;";
                    $con2 = $mysqli->query($consulta2) or die($mysqli->error);
                    while ($dado2 = $con2->fetch_array()) {
                        $combos = '';
                        $lanches = '';
                        $bebidas = '';
                        $complementos = '';
                    ?>
                        <div class=" blocos card">

                            <?php
                            $idpedido = $dado2['idPedido'];
                            $consulta3 =
                                "SELECT 
                            pedido_com_lanche.quantidade AS 'quantlanches',
                            lanches.Nome AS 'lanches'
                            FROM pedido
                            LEFT JOIN formas_de_pagamento ON formas_de_pagamento.idformas_de_pagamento = pedido.pagamento
                            LEFT JOIN pedido_com_lanche ON pedido_com_lanche.pedido_idPedido = pedido.idPedido
                            LEFT JOIN lanches ON lanches.idLanches = pedido_com_lanche.idLanches
                            WHERE idPedido = $idpedido
                            ORDER BY pedido.datadopedido DESC,pedido.horadopedido DESC;";
                            $con3 = $mysqli->query($consulta3) or die($mysqli->error);
                            while ($dado3 = $con3->fetch_array()) {
                                if ($dado3['quantlanches'] >= 1) {
                                    $lanches .= $dado3['quantlanches'] . ' ' . $dado3['lanches'] . '<br>';
                                }
                            }
                            $consulta3 =
                                "SELECT 
                            pedido_has_combo.quantidade AS 'quantcombos',
                            combo.Nome AS 'combos'
                            FROM pedido
                            LEFT JOIN pedido_has_combo ON pedido_has_combo.pedido_idPedido = pedido.idPedido
                            LEFT JOIN combo ON combo.idCombo = pedido_has_combo.combo_idCombo
                            WHERE idPedido = $idpedido
                            ORDER BY pedido.datadopedido DESC,pedido.horadopedido DESC;";
                            $con3 = $mysqli->query($consulta3) or die($mysqli->error);
                            while ($dado3 = $con3->fetch_array()) {
                                if ($dado3['quantcombos'] >= 1) {
                                    $combos .= $dado3['quantcombos'] . ' ' . $dado3['combos'] . '<br>';
                                }
                            }
                            $consulta3 =
                                "SELECT 
                            pedido_has_complemento.quantidade AS 'quantcomplementos',
                            complemento.Nome AS 'complementos'
                            FROM pedido
                            LEFT JOIN pedido_has_complemento ON pedido_has_complemento.pedido_idPedido = pedido.idPedido
                            LEFT JOIN complemento ON complemento.idComplemento = pedido_has_complemento.complemento_idComplemento
                            WHERE idPedido = $idpedido
                            ORDER BY pedido.datadopedido DESC,pedido.horadopedido DESC;";
                            $con3 = $mysqli->query($consulta3) or die($mysqli->error);
                            while ($dado3 = $con3->fetch_array()) {
                                if ($dado3['quantcomplementos'] >= 1) {
                                    $complementos .= $dado3['quantcomplementos'] . ' ' . $dado3['complementos'] . '<br>';
                                }
                            }
                            $consulta3 =
                                "SELECT 
                            pedido_has_bebidas.quantidade AS 'quantbebidas',
                            bebidas.Nome AS 'bebidas'
                            FROM pedido
                            LEFT JOIN pedido_has_bebidas ON pedido_has_bebidas.pedido_idPedido = pedido.idPedido
                            LEFT JOIN bebidas ON bebidas.idBebidas = pedido_has_bebidas.bebidas_idBebidas
                            WHERE idPedido = $idpedido
                            ORDER BY pedido.datadopedido DESC,pedido.horadopedido DESC;";
                            $con3 = $mysqli->query($consulta3) or die($mysqli->error);
                            while ($dado3 = $con3->fetch_array()) {
                                if ($dado3['quantbebidas'] >= 1) {
                                    $bebidas .= $dado3['quantbebidas'] . ' ' . $dado3['bebidas'] . '<br>';
                                }
                            ?>

                            <?php
                            } ?>
                            <h1 style="text-align: center;">Pedido: #<?= $dado2['idPedido'] ?></h1>
                            <br>
                            <table class="pedidos">
                                <tr>
                                    <th>Dados</th>
                                </tr>
                                <tr>
                                    <td>
                                        <b><?= $dado2['cliente'] . ' às ' . substr($dado2['horadopedido'], 0, 5) . 'h' ?></b>
                                        <br>
                                        Valor Total do pedido: R$<?= number_format($dado2['valorpedido'], 2) ?>
                                        <br>
                                        Forma de pagamento: <?= $dado2['forma_de_pagamento'] ?>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <table class="pedidos">
                                <tr>
                                    <th>Combos</th>
                                    <th>Lanches</th>
                                </tr>
                                <tr>
                                    <td><?= $combos ?></td>
                                    <td><?= $lanches ?></td>
                                </tr>
                            </table>
                            <br>
                            <table class="pedidos">
                                <tr>
                                    <th>Bebidas</th>
                                    <th>Complementos</th>
                                </tr>
                                <tr>
                                    <td><?= $bebidas ?></td>
                                    <td><?= $complementos ?></td>
                                </tr>
                            </table>
                            <br>
                            <?php
                            if ($dado2['rua'] == 'buscou') { ?>
                                <table class="pedidos">
                                    <tr>
                                        <th>Entrega</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            Buscou no local
                                        </td>
                                    </tr>
                                </table>
                            <?php } else {
                            ?>
                                <table class="pedidos">
                                    <tr>
                                        <th>Entrega</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?= $dado2['rua'] . ' - ' . $dado2['numerocasa'] ?>
                                            <br>
                                            <?= $dado2['bairro'] ?>
                                        </td>
                                    </tr>
                                </table> <?php
                                        } ?>
                            <div class="restaurar">
                                <input type="checkbox" name="<?= $dado2['idPedido'] ?>" id="<?= $dado2['idPedido'] ?>" value="<?= $dado2['idPedido'] ?>">
                                <label for="<?= $dado2['idPedido'] ?>">Excluir este pedido</label>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </form>
        </div>
    </main>
    <script>
        function falert() {
            if (confirm('Deseja excluir os pedidos selecionados? não sera possível restaurá-los depois!')) {
                form = document.querySelector('#form');
                form.submit();
            };
        }
    </script>
    <?php mysqli_close($mysqli); ?>
</body>

</html>