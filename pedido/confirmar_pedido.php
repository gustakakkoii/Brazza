<?php
function prepara_texto($t)
{
    $j = explode(' ', $t);
    $te = $j[0];
    for ($h = 1; $h < sizeof($j); $h++) {
        $te = $te . '%20' . $j[$h];
    }
    $j = explode('<b>', $te);
    $te = $j[0];
    for ($h = 1; $h < sizeof($j); $h++) {
        $te = $te . '*' . $j[$h];
    }
    $j = explode('</b>', $te);
    $te = $j[0];
    for ($h = 1; $h < sizeof($j); $h++) {
        $te = $te . '*' . $j[$h];
    }
    $j = explode('<br>', $te);
    $te = $j[0];
    for ($h = 1; $h < sizeof($j); $h++) {
        $te = $te . '%0A' . $j[$h];
    }
    $j = explode("\"", $te);
    $te = $j[0];
    for ($h = 1; $h < sizeof($j); $h++) {
        $te = $te . '%22' . $j[$h];
    }
    return $te;
}
include_once('../config.php');
$textBebida = '';
$textlanches = '';
$textCombo = '';
$precototal = 0;
$cliente = $_POST['Nome'];
$_POST['Nome'] = prepara_texto($_POST['Nome']);


function preparaid($t)
{
    $j = explode(' ', $t);
    $te = $j[0];
    for ($h = 1; $h < sizeof($j); $h++) {
        $te = $te . $j[$h];
    }
    $j = explode('-', $te);
    $te = $j[0];
    for ($h = 1; $h < sizeof($j); $h++) {
        $te = $te . $j[$h];
    }
    $j = explode(':', $te);
    $te = $j[0];
    for ($h = 1; $h < sizeof($j); $h++) {
        $te = $te  . $j[$h];
    }
    $j = explode('.', $te);
    $te = $j[0];
    for ($h = 1; $h < sizeof($j); $h++) {
        $te = $te  . $j[$h];
    }
    return $te;
}


$formadepagamento = $_POST['formadepagamento'];
$consulta2 = "SELECT idformas_de_pagamento FROM formas_de_pagamento WHERE forma_de_pagamento = '$formadepagamento'";
$con2 = $mysqli->query($consulta2) or die($mysqli->error);
$b = 0;
while ($dado2 = $con2->fetch_array()) {
    $formadepagamentostl = $dado2['idformas_de_pagamento'];
}
$Rua = $_POST['Rua'];
$Bairro = $_POST['Bairro'];
$Numero = $_POST['Numero'];
if ($Numero == '') {
    $Numero = 0;
}
$Bairro = $_POST['Bairro'];
if ($Bairro == '') {
    $Bairro = 0;
}
$Rua = $_POST['Rua'];
if ($_POST['entrega'] == 0) {
    $Rua = 'buscou';
}
if ($Rua == '') {
    $Rua = 0;
}

$Rua = prepararaspas($Rua);
$Bairro = prepararaspas($Bairro);
$data = $_POST['Data'];
$hora = $_POST['Hora'];
$hora = intval(preparaid($hora));
$data = intval(preparaid($data));
$textinsert = "";

$quantBebida = intval($_POST['quantBebida2']);
if ($quantBebida > 0) {
    $consulta2 = "SELECT * FROM bebidas";
    $con2 = $mysqli->query($consulta2) or die($mysqli->error);
    $b = 0;
    while ($dado2 = $con2->fetch_array()) {
        $QUANTB = 'QuantidadeB' .  $dado2['idBebidas'];
        $bebida = 'Bebidas' .  $dado2['idBebidas'];
        if (isset($_POST[$QUANTB])) {
            if ($_POST[$QUANTB] != 0) {
                $idBebidas = $_POST[$bebida];
                $consulta3 = "SELECT Nome FROM bebidas WHERE idBebidas = $idBebidas";
                $con3 = $mysqli->query($consulta3) or die($mysqli->error);
                while ($dado3 = $con3->fetch_array()) {
                    $textBebida = $textBebida . "<br>" . $_POST[$QUANTB] . ' ' . $dado3['Nome'];
                    $precototal += floatval($_POST[$QUANTB]) * floatval($dado2['Preco']);

                    $bebidas_idBebidas = $dado2['idBebidas'];
                    $quantidade = $_POST[$QUANTB];
                    $textinsert = $textinsert . "INSERT INTO pedido_has_bebidas (pedido_idPedido, bebidas_idBebidas, quantidade) VALUES( (SELECT idPedido FROM pedido WHERE datadopedido = $data AND horadopedido = $hora), $bebidas_idBebidas, $quantidade);";

                    $b++;
                }
            }
        }
    }
    if ($b > 0) {
        $textBebida = '<b>Bebidas:</b>' . $textBebida . "<br><br>";
    }
}
$quantCombo = intval($_POST['quantCombo']);
if ($quantCombo > 0) {
    $consulta2 = "SELECT * FROM combo";
    $con2 = $mysqli->query($consulta2) or die($mysqli->error);
    $c = 0;
    while ($dado2 = $con2->fetch_array()) {
        $QuantC = 'quantidadeC' .  $dado2['idCombo'];
        $combo = 'Combo' .  $dado2['idCombo'];
        if (isset($_POST[$QuantC])) {
            if ($_POST[$QuantC] != 0) {
                $idCombo = $_POST[$combo];
                $consulta3 = "SELECT Nome FROM combo WHERE idCombo = $idCombo";
                $con3 = $mysqli->query($consulta3) or die($mysqli->error);
                while ($dado3 = $con3->fetch_array()) {
                    $textCombo = $textCombo . "<br>" . $_POST[$QuantC] . ' ' . $dado3['Nome'];
                    $precototal += floatval($_POST[$QuantC]) * floatval($dado2['Preco']);
                    $c++;

                    $combo_idCombo = $dado2['idCombo'];
                    $quantidade = $_POST[$QuantC];
                    $textinsert = $textinsert . "INSERT INTO pedido_has_combo (pedido_idPedido, combo_idCombo, quantidade) VALUES((SELECT idPedido FROM pedido WHERE datadopedido = $data AND horadopedido = $hora), $combo_idCombo, $quantidade);";
                }
            }
        }
    }
    if ($c > 0) {
        $textCombo = '<b>Combos:</b>' . $textCombo . "<br><br>";
    }
}
$quantLanche = intval($_POST['quantLanche']);
if ($quantLanche > 0) {
    $c = 0;
    for ($i = 0; $i <= $quantLanche; $i++) {
        $QauntB = 'quantidadeL' .  $i;
        $lanche = 'Lanche' .  $i;
        if (isset($_POST[$QauntB])) {
            if ($_POST[$QauntB] > 0) {
                $quantidade = $_POST[$QauntB];
                $textlanches = $textlanches . "<br>" . $_POST[$QauntB] . ' ' . $_POST[$lanche];
                $nomeL = $_POST[$lanche];
                $nomeL = prepararaspas($nomeL);
                $consulta2 = "SELECT * FROM lanches WHERE Nome = '$nomeL' AND ativo = 1";
                $con2 = $mysqli->query($consulta2) or die($mysqli->error);
                while ($dado2 = $con2->fetch_array()) {
                    $precototal += floatval($_POST[$QauntB]) * floatval($dado2['Preco']);

                    $idLanches = $dado2['idLanches'];
                    $textinsert = $textinsert . "INSERT INTO pedido_com_lanche (pedido_idPedido, idLanches, quantidade) VALUES((SELECT idPedido FROM pedido WHERE datadopedido = $data AND horadopedido = $hora), $idLanches, $quantidade);";
                }
                $complementos = [];
                $consulta2 = "SELECT * FROM complemento WHERE ativo = 1";
                $con2 = $mysqli->query($consulta2) or die($mysqli->error);
                $j = 0;
                while ($dado2 = $con2->fetch_array()) {
                    $complemento = $lanche . $dado2['idComplemento'];
                    if (isset($_POST[$complemento])) {
                        $complementos[] = $dado2['Nome'];
                        $precototal += floatval($_POST[$QauntB]) * floatval($dado2['Preco']);

                        $complemento_idComplemento = $dado2['idComplemento'];
                        $textinsert = $textinsert . "INSERT INTO pedido_has_complemento (pedido_idPedido, complemento_idComplemento, quantidade) VALUES((SELECT idPedido FROM pedido WHERE datadopedido = $data AND horadopedido = $hora), $complemento_idComplemento, $quantidade);";
                    }
                }
                for ($j = 0; $j < sizeof($complementos); $j++) {
                    if ($j == 0) {
                        $textlanches = $textlanches . ' com adicional de ' . $complementos[$j];
                    } else {
                        if ($j == sizeof($complementos) - 1) {
                            $textlanches = $textlanches . ' e ' . $complementos[$j];
                        } else {
                            $textlanches = $textlanches . ', ' . $complementos[$j];
                        }
                    }
                }
                $c++;
            }
        }
    }
    if ($c > 0) {
        $textlanches = '<b>Lanches:</b>' . $textlanches . "<br><br>";
    }
}
$consulta2 = "SELECT * FROM config";
$con2 = $mysqli->query($consulta2) or die($mysqli->error);
while ($dado2 = $con2->fetch_array()) {
    $localdeentrega = $dado2['localdebusca'];
    $taxadeentrega = floatval($dado2['taxa']);
}
$textentrega = '';
if (isset($_POST['entrega'])) {
    if ($_POST['entrega'] == 0) {
        $textentrega = '<b>Buscarei meu pedido no endereço:</b><br>' . $localdeentrega . '<br><br>';
    } else {
        $textentrega = '<b>Entregar no endereço:</b><br>' . $_POST['Rua'] . ' - ' . $_POST['Numero'] . '<br>' . $_POST['Bairro'] . '<br><br>';
        if ($precototal < 50) {
            $precototal += $taxadeentrega;
        }
    }
}
$consulta2 = "SELECT * FROM config";
$con2 = $mysqli->query($consulta2) or die($mysqli->error);
while ($dado2 = $con2->fetch_array()) {
    $formadepagamento = '<b>Forma de pagamento:</b><br>' . $_POST['formadepagamento'] . '<br>';
    if ($_POST['formadepagamento'] == 'PIX') {
        $formadepagamento .= $dado2['chavepix'] . '<br>';
    }
    $precototal = number_format($precototal, 2);
    $precototaltext = '<br>Valor Total do pedido: ' . '<b>R$' . $precototal . "</b><br>";
    $textinsert = "SELECT COUNT(*) FROM pedido WHERE idPedido = (SELECT idPedido FROM pedido WHERE datadopedido = $data AND horadopedido = $hora);INSERT INTO pedido (cliente, rua, numerocasa, bairro, valorpedido, pagamento, datadopedido, horadopedido) VALUES('$cliente', '$Rua', $Numero, '$Bairro', '$precototal', $formadepagamentostl, $data, $hora);" . $textinsert;
    $pedido = 'https://wa.me/' . $dado2['pais'] . $dado2['ddd'] . $dado2['telefone'] . prepara_texto('?text=Olá! Meu nome é ' . $_POST['Nome'] . ', e eu gostaria de fazer um pedido:<br>');
    $text = '<br>' . $textCombo . $textlanches . $textBebida . $textentrega . $formadepagamento;
}
mysqli_close($mysqli);
?>
<?php
$timezone = new DateTimeZone('America/Sao_Paulo');
$agora = new DateTime('now', $timezone);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=j initial-scale=1.0">
    <title>Brazza - Confirmar Pedido</title>
    <link rel="shortcut icon" href="../fontes/logo.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <?php
    include_once('../fontes/style.php')
    ?>
</head>

<body>
    <main>
        <label style="margin-top:20px;" for="">Seu pedido:</label>
        <div class="corpo">

            <div class="espacodesobra">
                <div class="blocos">
                    <p class="pedido"><?= $text ?><br></p>
                </div>
                <div class="valorpedido">
                    <p>Valor total: </p><sup>R$</sup>
                    <p><?= $precototal ?></p>
                </div>
            </div>
            <div class="card">Caso seja necessário alguma modificação especial você pode nos avisar no próprio chat do whatsapp</div>
            <a class="voltar" href="javascript:history.back()">Voltar e conferir pedido</a>
            <form style="margin: 0;" id="form" action="cadastrar_pedido.php" method="POST">
                <input type="text" class="sumiu" name="textinsertpedido" value="<?= $textinsert ?>">
                <input type="text" class="sumiu" name="textlink" value="<?= $pedido . prepara_texto($text) . prepara_texto($precototaltext) ?>">
                <div class="submit enviar" onclick="enviar('#form')">
                    <svg width="36" height="28" viewBox="0 0 36 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.1452 25.7097C20.6924 25.7097 26 20.4021 26 13.8548C26 7.30759 20.6924 2 14.1452 2C7.59791 2 2.29032 7.30759 2.29032 13.8548C2.29032 15.9591 2.83857 17.9353 3.80003 19.6484C3.8394 19.7186 3.84894 19.8017 3.82535 19.8786L2 25.8306L7.77544 23.9762C7.85651 23.9502 7.9448 23.9613 8.01765 24.0053C9.80579 25.0871 11.9028 25.7097 14.1452 25.7097Z" stroke="white" stroke-width="2.37097" />
                        <path d="M11.871 10.7336C11.7723 11.2417 11.1452 11.8949 10.613 12.5239C11.1694 13.8546 11.6401 14.4117 12.6453 15.3061C13.7224 16.2645 14.5807 16.8062 15.8872 17.0723C16.7581 16.5401 16.9517 15.6449 17.363 15.3061C18.0314 15.0884 20.8489 16.5401 20.9194 16.8062C21.1374 17.6288 20.98 18.0371 20.6775 18.6448C20.0655 19.8743 18.5726 20.2494 17.5082 20.169C12.3791 19.7819 7.37106 14.0238 7.10496 10.9271C6.91163 8.67715 8.62916 7.24968 9.01625 7.29807C9.40335 7.34645 9.8777 7.26524 10.3711 7.46742C11.3388 9.20942 11.5322 9.86271 11.871 10.7336Z" fill="white" />
                    </svg>
                    Enviar pedido
                </div>
                <script>
                    function enviar(id) {
                        form = document.querySelector(id);
                        form.submit();
                    }
                </script>
            </form>
        </div>
    </main>
</body>

</html>