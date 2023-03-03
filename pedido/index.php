<?php
date_default_timezone_set('America/Sao_Paulo');
$timezone = new DateTimeZone('America/Sao_Paulo');
$agora = new DateTime('now', $timezone);
include_once('../config.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=j initial-scale=1.0">
    <title>Brazza - Pedido</title>
    <link rel="shortcut icon" href="../fontes/logo.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php
    include_once('../fontes/style.php')
    ?>

</head>

<body>
    <main>
        <?php
        $consulta22 = "SELECT * FROM config";
        $con22 = $mysqli->query($consulta22) or die($mysqli->error);
        while ($dado22 = $con22->fetch_array()) {
            if ($dado22['aceitandopedido'] == 1) { ?>
                <div class="corpo">
                    <form action="confirmar_pedido.php" method="POST" id="criar">
                        <div class="blocos">
                            <label for="Nome">Nome:</label>
                            <input name="Nome" class="input" id="Nome" type="text" placeholder="Seu nome">
                            <script>
                                document.getElementById("Nome").onkeypress = function(e) {
                                    var chr = String.fromCharCode(e.which);
                                    if ("1234567890qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNMãõáéíóúâêîôûàèìòùÃÕÁÉÍÓÚÂÊÎÔÛÀÈÌÒÙ".indexOf(chr) < 0)
                                        return false;
                                };
                            </script>
                        </div>
                        <div class="blocos sumiu">
                            <label for="Data">Data:</label>
                            <input name="Data" type="date" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="blocos sumiu">
                            <label for="Hora">Hora:</label>
                            <input name="Hora" type="time" value="<?= $agora->format('H:i:s') ?>">
                        </div>
                        <div class="blocos">
                            <div id="adicionar_pedido3">
                                <p id="adicionar_combo">Combos</p>
                                <input id="quantCombo" class='sumiu' name='quantCombo' type='number' value='0'>
                                <div id="somar3">
                                    <?php
                                    $consulta3 = "SELECT * FROM combo WHERE ativo = 1";
                                    $con3 = $mysqli->query($consulta3) or die($mysqli->error);
                                    while ($dado = $con3->fetch_array()) { ?>
                                        <div class="blocos" id="combo<?= $dado['idCombo'] ?>">
                                            <div class="combos" id="C<?= $dado['idCombo'] ?>">
                                                <div class="card-img-top" style="background-image: url('../combos/<?= $dado['Imagem'] ?>');"></div>
                                                <div class="card" id="combo2<?= $dado['idCombo'] ?>">
                                                    <div class="card-body">
                                                        <div class="card-title">
                                                            <p class="title"><?php echo $dado['Nome']; ?></p>
                                                            <input class="sumiu" name="Combo<?php echo $dado['idCombo'] ?>" type="text" value="<?php echo $dado['idCombo'] ?>">
                                                            <div class="card-text">
                                                                <?php
                                                                $pesquisa = prepararaspas($dado['Nome']);
                                                                $cons2 = "SELECT idCombo From combo WHERE Nome = '$pesquisa'";
                                                                $consulta2 = mysqli_query($mysqli, $cons2);
                                                                $x = '';
                                                                while ($dado2 = $consulta2->fetch_array()) {
                                                                    $idCombo = $dado2['idCombo'];
                                                                    $consulta3 = mysqli_query($mysqli, "SELECT * FROM combo_com_lanche WHERE idCombo = '$idCombo'");
                                                                    while ($dado3 = $consulta3->fetch_array()) {
                                                                        $idLanche = $dado3['idLanches'];
                                                                        $consulta4 = mysqli_query($mysqli, "SELECT Nome FROM lanches WHERE idLanches = '$idLanche'");
                                                                        while ($dado4 = $consulta4->fetch_array()) {
                                                                            if ($dado3['Quantidade'] > 1) {
                                                                                if ($x == '') {
                                                                                    $x = $dado3['Quantidade'] . ' ' . $dado4['Nome'];
                                                                                } else {
                                                                                    $x = $x . ', ' . $dado3['Quantidade'] . ' ' . $dado4['Nome'];
                                                                                }
                                                                            } else {
                                                                                if ($x == '') {
                                                                                    $x = $dado4['Nome'];
                                                                                } else {
                                                                                    $x = $x . ', ' . $dado4['Nome'];
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    $consulta5 = mysqli_query($mysqli, "SELECT * FROM combo_com_bebida WHERE idCombo = '$idCombo'");
                                                                    while ($dado5 = $consulta5->fetch_array()) {
                                                                        $idBebida = $dado5['idBebidas'];
                                                                        $consulta6 = mysqli_query($mysqli, "SELECT Nome FROM bebidas WHERE idBebidas = '$idBebida'");
                                                                        while ($dado6 = $consulta6->fetch_array()) {
                                                                            if ($dado5['Quantidade'] > 1) {
                                                                                if ($x == '') {
                                                                                    $x = $dado5['Quantidade'] . ' ' . $dado6['Nome'];
                                                                                } else {
                                                                                    $x = $x . ', ' . $dado5['Quantidade'] . ' ' . $dado6['Nome'];
                                                                                }
                                                                            } else {
                                                                                if ($x == '') {
                                                                                    $x = $dado6['Nome'];
                                                                                } else {
                                                                                    $x = $x . ', ' . $dado6['Nome'];
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    if ($x == '') {
                                                                        $x = $dado['Especialidades'];
                                                                    } else {
                                                                        $x = $x . ', ' . $dado['Especialidades'];
                                                                    }
                                                                }
                                                                ?>
                                                                <p><?= $x ?> </p>
                                                            </div>
                                                        </div>
                                                        <div class="direita">
                                                            <div class="btn">
                                                                <sup>R$</sup>
                                                                <p><?php echo number_format($dado['Preco'], 2) ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="blocos">
                            <div id="adicionar_pedido2">
                                <p id="adicionar_bebida">Adicionar bebida</p>

                                <input id="quantBebida2" class='sumiu' name='quantBebida2' type='number' value='0'>
                                <div id="somar2">
                                    <?php
                                    $consulta = "SELECT * FROM bebidas";
                                    $con = $mysqli->query($consulta) or die($mysqli->error);
                                    while ($dado = $con->fetch_array()) { ?>
                                        <div class="blocos" id="B<?= $dado['idBebidas'] ?>">
                                            <div class="lista">
                                                <p><?php echo $dado['Nome']; ?></p>
                                                <input class="sumiu" name="Bebidas<?php echo $dado['idBebidas'] ?>" type="text" value="<?php echo $dado['idBebidas'] ?>">
                                                <div class="linhatracejada"></div>
                                                <div class="valor">
                                                    <p>R$<?php echo number_format($dado['Preco'], 2) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } ?>
                                </div>
                                <div class="card">
                                    <p>OBS: Para excluir uma bebida basta deixar a quantidade em zero</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <?php
                            if ($dado22['entrega'] == 1) { ?>
                                <div class="entrega">
                                    <input class="sumiu" type="radio" name="entrega" id="pedidoativada" value="1" checked='checked'>
                                    <label id="lpedidoativada" for="pedidoativada">Entregar</label>
                                    <input class="sumiu" type="radio" name="entrega" id="pedidodesativada" value="0">
                                    <label id="lpedidodesativada" for="pedidodesativada">Buscar no local</label>

                                </div>
                                <div id="informa_telefone" class="endereco">
                                    <div class="card">Só fazemos entregas no município de Ilicínea<br>Taxa de entrega: R$<?= $dado22['taxa'] ?><br>Pedidos acima de R$50,00 não cobramos taxa de entrega</div>
                                    <input name="Rua" id="Rua" class="input" type="text" placeholder="Endereço:">
                                    <input name="Numero" class="input" type="number" placeholder="Número:">
                                    <input name="Bairro" id="Bairro" class="input" type="text" placeholder="Bairro:">
                                    <script>
                                        document.getElementById("Rua").onkeypress = function(e) {
                                            var chr = String.fromCharCode(e.which);
                                            if ("1234567890qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNMãõáéíóúâêîôûàèìòùÃÕÁÉÍÓÚÂÊÎÔÛÀÈÌÒÙ".indexOf(chr) < 0)
                                                return false;
                                        };
                                        document.getElementById("Bairro").onkeypress = function(e) {
                                            var chr = String.fromCharCode(e.which);
                                            if ("1234567890qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNMãõáéíóúâêîôûàèìòùÃÕÁÉÍÓÚÂÊÎÔÛÀÈÌÒÙ".indexOf(chr) < 0)
                                                return false;
                                        };
                                    </script>
                                </div>
                                <div id="textpedido">
                                    <div class="card" style="height: 90%;">Endereço para buscar o pedido:<br><?= $dado22['localdebusca'] ?></div>
                                </div>
                                <script>
                                    textareap = document.querySelector('#textpedido');
                                    eativada = document.querySelector('#pedidoativada');
                                    edesativada = document.querySelector('#pedidodesativada');
                                    telefone = document.querySelector('#informa_telefone');

                                    eativada.addEventListener('click', function() {
                                        textareap.style.height = 0;
                                        telefone.style.height = '300px';
                                    })
                                    edesativada.addEventListener('click', function() {
                                        textareap.style.height = '300px';
                                        telefone.style.height = 0;
                                    })
                                </script>
                            <?php } else { ?>
                                <div class="atencao"><?= $dado22['mensagemerro'] ?></div>
                                <div class="card">Devido à falta de entrega, é necessário buscar o pedido no seguinte endereço:<br><?= $dado22['localdebusca'] ?></div>
                            <?php }
                            ?>
                        </div>
                        <div>
                            <label>Pagamento:</label>
                            <select name="formadepagamento">
                                <?php
                                $consulta = "SELECT * FROM formas_de_pagamento";
                                $con = $mysqli->query($consulta) or die($mysqli->error);
                                while ($dado = $con->fetch_array()) { ?>
                                    <option value="<?= $dado['forma_de_pagamento'] ?>"><?= $dado['forma_de_pagamento'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="submit" onclick="enviar('#criar')">Somar pedido</div>
                    </form>
                </div>
            <?php
            } else { ?><input name="Rua" id="Rua" class="input sumiu" type="text" placeholder="Endereço:">
                <input name="Numero" class="input sumiu" type="number" placeholder="Número:">
                <input name="Bairro" id="Bairro" class="input sumiu" type="text" placeholder="Bairro:">
                <div class="atencao"><?= $dado22['mensagempedido'] ?></div>
        <?php }
        } ?>
    </main>
    <?php
    include_once('./pedidoscript.php');
    ?>
</body>

</html>