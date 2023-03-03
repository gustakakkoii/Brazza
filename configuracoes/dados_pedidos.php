<?php
include_once('../config.php');
date_default_timezone_set('America/Sao_Paulo');
$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
if (isset($_POST['pesquisa'])) {
    if ($_POST['pesquisa'] == 'Hoje') {
        $pesquisa = date('Y-m-d');
        $pesquisaderefencia = date('Y-m-d', mktime(0, 0, 0, date(" m "), date(" d ") - 1, date(" Y ")));
        $curvadelucro = date('Y-m');
        $textpesquisa = 'Hoje';
        $textpesquisaderefencia = 'Ontem';
    } else if ($_POST['pesquisa'] == 'Ontem') {
        $pesquisa = date('Y-m-d', mktime(0, 0, 0, date(" m "), date(" d ") - 1, date(" Y ")));
        $pesquisaderefencia = date('Y-m-d', mktime(0, 0, 0, date(" m "), date(" d ") - 2, date(" Y ")));
        $curvadelucro = date('Y-m');
        $textpesquisa = 'Ontem';
        $textpesquisaderefencia = 'Anteontem';
    } else if ($_POST['pesquisa'] == 'Este mês') {
        $pesquisa = date('Y-m');
        $pesquisaderefencia = date('Y-m', mktime(0, 0, date(" Y "), date(" m ") - 1));
        $curvadelucro = date('Y');
        $textpesquisa = 'Este mês';
        $textpesquisaderefencia = 'Mês Passado';
    } else if ($_POST['pesquisa'] == 'Mês passado') {
        $pesquisa = date('Y-m', mktime(0, 0, date(" Y "), date(" m ") - 1));
        $pesquisaderefencia = date('Y-m', mktime(0, 0, date(" Y "), date(" m ") - 2));
        $curvadelucro = date('Y');
        $textpesquisa = 'Mês passado';
        $textpesquisaderefencia = 'Mês retrasado';
    } else if ($_POST['pesquisa'] == 'Este ano') {
        $pesquisa = date('Y');
        $pesquisaderefencia = date(" Y ") - 1;
        $curvadelucro = date('Y');
        $textpesquisa = 'Este ano';
        $textpesquisaderefencia = 'Ano pasado';
    } else if ($_POST['pesquisa'] == 'Ano passado') {
        $pesquisa = date(" Y ") - 1;
        $pesquisaderefencia = date(" Y ") - 2;
        $curvadelucro = date('Y') - 1;
        $textpesquisa = 'Ano passado';
        $textpesquisaderefencia = 'Ano retrasado';
    } else {
        $pesquisa = date('Y-m-d');
        $pesquisaderefencia = date('Y-m-d', mktime(0, 0, 0, date(" m "), date(" d ") - 1, date(" Y ")));
        $curvadelucro = date('Y');
        $textpesquisa = 'Hoje';
        $textpesquisaderefencia = 'Ontem';
    }
} else {
    $pesquisa = date('Y-m-d');
    $pesquisaderefencia = date('Y-m-d', mktime(0, 0, 0, date(" m "), date(" d ") - 1, date(" Y ")));
    $curvadelucro = date('Y');
    $textpesquisa = 'Hoje';
    $textpesquisaderefencia = 'Ontem';
}

function deporarray($lista)
{
    $resposta = '';
    for ($i = 0; $i < sizeof($lista); $i++) {
        $resposta .= '[';
        for ($j = 0; $j < sizeof($lista[$i]); $j++) {
            if ($j == 0) {
                $resposta .= $lista[$i][$j];
            } else {
                $resposta .= ', ' . $lista[$i][$j];
            }
        }
        if ($i == sizeof($lista) - 1) {
            $resposta .= ']';
        } else {
            $resposta .= '],';
        }
    }
    return $resposta;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    include_once('./head.php');
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>
    <nav>
        <?php
        include_once('./menu.php');
        ?>
    </nav>
    <main>
        <div class="corpo" id="conteudo">
            <form action="#" method="post" id="pesquisar">
                <select class="input" name="pesquisa" id="pesquisa">
                    <option value="-">-</option>
                    <option value="Hoje">Hoje</option>
                    <option value="Ontem">Ontem</option>
                    <option value="Este mês">Este mês</option>
                    <option value="Mês passado">Mês passado</option>
                    <option value="Este ano">Este ano</option>
                    <option value="Ano passado">Ano passado</option>
                </select>
                <div class="submit" onclick="enviar('#pesquisar')">Pesquisar</div>
            </form>
            <div class="data"><?= $pesquisa ?></div>
            <div class="blocos card">
                <div class="blocos">
                    <h1>Lucro total de <?= $textpesquisa ?>:</h1>
                    <p id="lucro">R$<?php
                                    $consulta =
                                        "SELECT SUM(pedido.valorpedido) AS 'Soma'
                        FROM pedido
                        WHERE pedido.datadopedido LIKE '$pesquisa%';";
                                    $con = $mysqli->query($consulta) or die($mysqli->error);
                                    while ($dado = $con->fetch_array()) {
                                        echo $dado['Soma'];
                                    }
                                    ?>
                    </p>
                </div>
                <div class="blocos">
                    <p>Curva de lucro ao longo do tempo:</p>

                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                <?php
                                $soma = 0;
                                $array = [];
                                $consulta =
                                    "SELECT pedido.datadopedido, SUM(pedido.valorpedido) AS 'Soma'
                                    FROM pedido
                                    WHERE pedido.datadopedido LIKE '$curvadelucro%'
                                    GROUP BY pedido.datadopedido
                                    ORDER BY pedido.datadopedido;";
                                $con = $mysqli->query($consulta) or die($mysqli->error);
                                while ($dado = $con->fetch_array()) {
                                    array_push($array, ['"' . $dado['datadopedido'] . '"', $dado['Soma'], 0]);
                                }
                                echo "['Datas', 'Valor arrecadado no dia', 'Valor arrecadado no dia'";
                                echo '],';
                                echo deporarray($array);
                                ?>
                            ]);

                            var chart = new google.visualization.AreaChart(document.getElementById('curvadelucro'));
                            chart.draw(data, null);
                        }
                    </script>
                    <div class="grafico" id="curvadelucro"></div>
                </div>
            </div>
            <div class="blocos card">
                <div class="blocos">
                    <h1>Pagamentos utilizados:</h1>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            packages: ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            // Define the chart to be drawn.
                            var data = new google.visualization.DataTable();
                            data.addColumn('string', 'Element');
                            data.addColumn('number', 'Percentage');
                            data.addRows([
                                <?php
                                $soma = 0;
                                $consulta =
                                    "SELECT formas_de_pagamento.forma_de_pagamento, COUNT(*), SUM(pedido.valorpedido) AS 'Soma'
                                    FROM pedido
                                    INNER JOIN formas_de_pagamento ON pedido.pagamento = formas_de_pagamento.idformas_de_pagamento
                                    WHERE pedido.datadopedido LIKE '$pesquisa%'
                                    GROUP BY formas_de_pagamento.forma_de_pagamento;";
                                $con = $mysqli->query($consulta) or die($mysqli->error);
                                while ($dado = $con->fetch_array()) {
                                    echo '["' . $dado['forma_de_pagamento'] . '", ' . $dado['COUNT(*)'] . '],';
                                }
                                ?>
                            ]);

                            // Instantiate and draw the chart.
                            var chart = new google.visualization.PieChart(document.getElementById('formaspagutliz'));
                            chart.draw(data, null);
                        }
                    </script>
                    <div class="grafico" id="formaspagutliz">
                    </div>
                </div>
                <div class="blocos">

                    <h1>Valor total arrecadado:</h1>
                    <p>(Por forma de pagamento, em relação a <?= $textpesquisaderefencia ?>)</p>

                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Lanches', '<?= $textpesquisa ?>', '<?= $textpesquisaderefencia ?>'],
                                <?php
                                $soma = 0;
                                $array = [];
                                $consulta =
                                    "SELECT formas_de_pagamento.forma_de_pagamento, COUNT(*), SUM(pedido.valorpedido) AS 'Soma'
                                    FROM pedido
                                    INNER JOIN formas_de_pagamento ON pedido.pagamento = formas_de_pagamento.idformas_de_pagamento
                                    WHERE pedido.datadopedido LIKE '$pesquisa%'
                                    GROUP BY formas_de_pagamento.forma_de_pagamento
									ORDER BY formas_de_pagamento.forma_de_pagamento;";
                                $con = $mysqli->query($consulta) or die($mysqli->error);
                                while ($dado = $con->fetch_array()) {
                                    array_push($array, ['"' . $dado['forma_de_pagamento'] . '"', $dado['Soma'], 0]);
                                }
                                $consulta =
                                    "SELECT formas_de_pagamento.forma_de_pagamento, COUNT(*), SUM(pedido.valorpedido) AS 'Soma'
                                    FROM pedido
                                    INNER JOIN formas_de_pagamento ON pedido.pagamento = formas_de_pagamento.idformas_de_pagamento
                                    WHERE pedido.datadopedido LIKE '$pesquisaderefencia%'
                                    GROUP BY formas_de_pagamento.forma_de_pagamento
									ORDER BY formas_de_pagamento.forma_de_pagamento;";
                                $con = $mysqli->query($consulta) or die($mysqli->error);
                                $c = true;
                                while ($dado = $con->fetch_array()) {
                                    for ($i = 0; $i < sizeof($array); $i++) {
                                        if ('"' . $dado['forma_de_pagamento'] . '"' == $array[$i][0]) {
                                            $array[$i][2] = $dado['Soma'];
                                            $c = false;
                                        }
                                    }
                                }
                                echo deporarray($array);
                                ?>
                            ]);

                            var chart = new google.visualization.AreaChart(document.getElementById('formdepagvtotal'));
                            chart.draw(data, null);
                        }
                    </script>
                    <div class="grafico" id="formdepagvtotal"></div>
                </div>
            </div>
            <div class="blocos card">
                <h1>Entregas feitas:
                    <?php
                    $consulta =
                        "SELECT COUNT(*) FROM pedido
                        WHERE Rua != 'buscou'
                        AND pedido.datadopedido LIKE '$pesquisa%';";
                    $con = $mysqli->query($consulta) or die($mysqli->error);
                    while ($dado = $con->fetch_array()) {
                        echo $dado['COUNT(*)'];
                    }
                    ?>
                </h1>
                <script type="text/javascript">
                    google.charts.load('current', {
                        packages: ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        // Define the chart to be drawn.
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Element');
                        data.addColumn('number', 'Percentage');
                        data.addRows([
                            <?php
                            $soma = 0;
                            $consulta =
                                "SELECT COUNT(*) FROM pedido
                                    WHERE Rua != 'buscou'
                                    AND pedido.datadopedido LIKE '$pesquisa%'";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            while ($dado = $con->fetch_array()) {
                                echo '[' . "'Pedidos com entrega'," .  $dado['COUNT(*)'] . '],';
                            }
                            $consulta =
                                "SELECT COUNT(*) FROM pedido
                                    WHERE Rua != 'buscou'
                                    AND pedido.datadopedido LIKE '$pesquisa%'";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            while ($dado = $con->fetch_array()) {
                                echo '[' . "'Pedidos sem entrega'," . $dado['COUNT(*)'] . ']';
                            }
                            ?>
                        ]);

                        // Instantiate and draw the chart.
                        var chart = new google.visualization.PieChart(document.getElementById('entregasfeitas'));
                        chart.draw(data, null);
                    }
                </script>
                <div class="grafico" id="entregasfeitas">
                </div>
            </div>
            <div class="blocos card">
                <h1>Lanches:</h1>
                <script type="text/javascript">
                    google.charts.load('current', {
                        packages: ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        // Define the chart to be drawn.
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Element');
                        data.addColumn('number', 'Percentage');
                        data.addRows([
                            <?php
                            $soma = 0;
                            $array = [];
                            $consulta =
                                "SELECT lanches.Nome, SUM(pedido_com_lanche.quantidade) AS 'COUNT(*)'
                                FROM pedido
                                INNER JOIN pedido_com_lanche ON pedido_com_lanche.pedido_idPedido = pedido.idPedido
                                INNER JOIN lanches ON lanches.idLanches = pedido_com_lanche.idLanches
                                WHERE pedido.datadopedido LIKE '$pesquisa%'
                                GROUP BY lanches.Nome
                                ORDER BY lanches.Nome;";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            while ($dado = $con->fetch_array()) {
                                array_push($array, ['"' . prepararaspas($dado['Nome']) . '"', $dado['COUNT(*)']]);
                                $soma += $dado['COUNT(*)'];
                            }
                            echo deporarray($array);
                            ?>
                        ]);

                        // Instantiate and draw the chart.
                        var chart = new google.visualization.PieChart(document.getElementById('lanchepizza'));
                        chart.draw(data, null);
                    }
                </script>
                <div class="grafico" id="lanchepizza">
                </div>
                <p>Em relação a <?= $textpesquisaderefencia ?></p>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Lanches', '<?= $textpesquisa ?>', '<?= $textpesquisaderefencia ?>'],
                            <?php
                            $soma = 0;
                            $array = [];
                            $consulta =
                                "SELECT lanches.Nome, SUM(pedido_com_lanche.quantidade) AS 'COUNT(*)'
                                FROM pedido
                                INNER JOIN pedido_com_lanche ON pedido_com_lanche.pedido_idPedido = pedido.idPedido
                                INNER JOIN lanches ON lanches.idLanches = pedido_com_lanche.idLanches
                                WHERE pedido.datadopedido LIKE '$pesquisa%'
                                GROUP BY lanches.Nome
                                ORDER BY lanches.Nome;";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            while ($dado = $con->fetch_array()) {
                                array_push($array, ['"' . prepararaspas($dado['Nome']) . '"', $dado['COUNT(*)'], 0]);
                                $soma += $dado['COUNT(*)'];
                            }
                            $consulta =
                                "SELECT lanches.Nome, SUM(pedido_com_lanche.quantidade) AS 'COUNT(*)'
                                FROM pedido
                                INNER JOIN pedido_com_lanche ON pedido_com_lanche.pedido_idPedido = pedido.idPedido
                                INNER JOIN lanches ON lanches.idLanches = pedido_com_lanche.idLanches
                                WHERE pedido.datadopedido LIKE '$pesquisaderefencia%'
                                GROUP BY lanches.Nome
                                ORDER BY lanches.Nome;";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            $c = 1;
                            while ($dado = $con->fetch_array()) {
                                for ($i = 0; $i < sizeof($array); $i++) {
                                    if ('"' . prepararaspas($dado['Nome']) . '"' == $array[$i][0]) {
                                        $array[$i][2] = $dado['COUNT(*)'];
                                        $c = 0;
                                    }
                                }
                            }
                            echo deporarray($array);
                            ?>
                        ]);

                        var chart = new google.visualization.AreaChart(document.getElementById('lanchearea'));
                        chart.draw(data, null);
                    }
                </script>
                <div class="grafico" id="lanchearea"></div>
                <p>Total: <?= $soma ?> lanches</p>
            </div>
            <div class="blocos card">
                <h1>Combos:</h1>
                <script type="text/javascript">
                    google.charts.load('current', {
                        packages: ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        // Define the chart to be drawn.
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Element');
                        data.addColumn('number', 'Percentage');
                        data.addRows([
                            <?php
                            $soma = 0;
                            $array = [];
                            $consulta =
                                "SELECT combo.Nome, SUM(pedido_has_combo.quantidade) AS 'COUNT(*)'
                                FROM pedido
                                INNER JOIN pedido_has_combo ON pedido_has_combo.pedido_idPedido = pedido.idPedido
                                INNER JOIN combo ON combo.idCombo = pedido_has_combo.combo_idCombo
                                WHERE pedido.datadopedido LIKE '$pesquisa%'
                                GROUP BY combo.Nome
                                ORDER BY combo.Nome;";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            while ($dado = $con->fetch_array()) {
                                array_push($array, ['"' . prepararaspas($dado['Nome']) . '"', $dado['COUNT(*)']]);
                                $soma += $dado['COUNT(*)'];
                            }
                            echo deporarray($array);
                            ?>
                        ]);

                        // Instantiate and draw the chart.
                        var chart = new google.visualization.PieChart(document.getElementById('combospizza'));
                        chart.draw(data, null);
                    }
                </script>
                <div class="grafico" id="combospizza">
                </div>
                <p>Em relação a <?= $textpesquisaderefencia ?></p>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Combos', '<?= $textpesquisa ?>', '<?= $textpesquisaderefencia ?>'],
                            <?php
                            $soma = 0;
                            $array = [];
                            $consulta =
                                "SELECT combo.Nome, SUM(pedido_has_combo.quantidade) AS 'COUNT(*)'
                                FROM pedido
                                INNER JOIN pedido_has_combo ON pedido_has_combo.pedido_idPedido = pedido.idPedido
                                INNER JOIN combo ON combo.idCombo = pedido_has_combo.combo_idCombo
                                WHERE pedido.datadopedido LIKE '$pesquisa%'
                                GROUP BY combo.Nome
                                ORDER BY combo.Nome;";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            while ($dado = $con->fetch_array()) {
                                array_push($array, ['"' . prepararaspas($dado['Nome']) . '"', $dado['COUNT(*)'], 0]);
                                $soma += $dado['COUNT(*)'];
                            }
                            $consulta =
                                "SELECT combo.Nome, SUM(pedido_has_combo.quantidade) AS 'COUNT(*)'
                                FROM pedido
                                INNER JOIN pedido_has_combo ON pedido_has_combo.pedido_idPedido = pedido.idPedido
                                INNER JOIN combo ON combo.idCombo = pedido_has_combo.combo_idCombo
                                WHERE pedido.datadopedido LIKE '$pesquisaderefencia%'
                                GROUP BY combo.Nome
                                ORDER BY combo.Nome;";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            while ($dado = $con->fetch_array()) {
                                for ($i = 0; $i < sizeof($array); $i++) {
                                    if ('"' . prepararaspas($dado['Nome']) . '"' == $array[$i][0]) {
                                        $array[$i][2] = $dado['COUNT(*)'];
                                    }
                                }
                            }
                            echo deporarray($array);
                            ?>
                        ]);

                        var chart = new google.visualization.AreaChart(document.getElementById('combosarea'));
                        chart.draw(data, null);
                    }
                </script>
                <div class="grafico" id="combosarea"></div>
                <p>Total: <?= $soma ?> lanches</p>
            </div>
            <div class="blocos card">
                <h1>Bebidas:</h1>
                <script type="text/javascript">
                    google.charts.load('current', {
                        packages: ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        // Define the chart to be drawn.
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Element');
                        data.addColumn('number', 'Percentage');
                        data.addRows([
                            <?php
                            $soma = 0;
                            $array = [];
                            $consulta =
                                "SELECT bebidas.Nome, SUM(pedido_has_bebidas.quantidade) AS 'COUNT(*)'
                                FROM pedido
                                INNER JOIN pedido_has_bebidas ON pedido_has_bebidas.pedido_idPedido = pedido.idPedido
                                INNER JOIN bebidas ON bebidas.idBebidas = pedido_has_bebidas.bebidas_idBebidas
                                WHERE pedido.datadopedido LIKE '$pesquisa%'
                                GROUP BY bebidas.Nome
                                ORDER BY bebidas.Nome;";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            while ($dado = $con->fetch_array()) {
                                array_push($array, ['"' . prepararaspas($dado['Nome']) . '"', $dado['COUNT(*)']]);
                                $soma += $dado['COUNT(*)'];
                            }
                            echo deporarray($array);
                            ?>
                        ]);

                        // Instantiate and draw the chart.
                        var chart = new google.visualization.PieChart(document.getElementById('bebidaspizza'));
                        chart.draw(data, null);
                    }
                </script>
                <div class="grafico" id="bebidaspizza">
                </div>
                <p>Em relação a <?= $textpesquisaderefencia ?></p>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Bebidas', '<?= $textpesquisa ?>', '<?= $textpesquisaderefencia ?>'],
                            <?php
                            $soma = 0;
                            $array = [];
                            $consulta =
                                "SELECT bebidas.Nome, SUM(pedido_has_bebidas.quantidade) AS 'COUNT(*)'
                                FROM pedido
                                INNER JOIN pedido_has_bebidas ON pedido_has_bebidas.pedido_idPedido = pedido.idPedido
                                INNER JOIN bebidas ON bebidas.idBebidas = pedido_has_bebidas.bebidas_idBebidas
                                WHERE pedido.datadopedido LIKE '$pesquisa%'
                                GROUP BY bebidas.Nome
                                ORDER BY bebidas.Nome;";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            while ($dado = $con->fetch_array()) {
                                array_push($array, ['"' . prepararaspas($dado['Nome']) . '"', $dado['COUNT(*)'], 0]);
                                $soma += $dado['COUNT(*)'];
                            }
                            $consulta =
                                "SELECT bebidas.Nome, SUM(pedido_has_bebidas.quantidade) AS 'COUNT(*)'
                                FROM pedido
                                INNER JOIN pedido_has_bebidas ON pedido_has_bebidas.pedido_idPedido = pedido.idPedido
                                INNER JOIN bebidas ON bebidas.idBebidas = pedido_has_bebidas.bebidas_idBebidas
                                WHERE pedido.datadopedido LIKE '$pesquisaderefencia%'
                                GROUP BY bebidas.Nome
                                ORDER BY bebidas.Nome;";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            $c = 1;
                            while ($dado = $con->fetch_array()) {
                                for ($i = 0; $i < sizeof($array); $i++) {
                                    if ('"' . prepararaspas($dado['Nome']) . '"' == $array[$i][0]) {
                                        $array[$i][2] = $dado['COUNT(*)'];
                                        $c = 0;
                                    }
                                }
                            }
                            echo deporarray($array);
                            ?>
                        ]);

                        var chart = new google.visualization.AreaChart(document.getElementById('bebidasarea'));
                        chart.draw(data, null);
                    }
                </script>
                <div class="grafico" id="bebidasarea"></div>
                <p>Total: <?= $soma ?> lanches</p>
            </div>
            <div class="blocos card">
                <h1>Complementos:</h1>
                <script type="text/javascript">
                    google.charts.load('current', {
                        packages: ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        // Define the chart to be drawn.
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Element');
                        data.addColumn('number', 'Percentage');
                        data.addRows([
                            <?php
                            $soma = 0;
                            $array = [];
                            $consulta =
                                "SELECT complemento.Nome, SUM(pedido_has_complemento.quantidade) AS 'COUNT(*)'
                                FROM pedido
                                INNER JOIN pedido_has_complemento ON pedido_has_complemento.pedido_idPedido = pedido.idPedido
                                INNER JOIN complemento ON complemento.idComplemento = pedido_has_complemento.complemento_idComplemento
                                WHERE pedido.datadopedido LIKE '$pesquisa%'
                                GROUP BY complemento.Nome
                                ORDER BY complemento.Nome;";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            while ($dado = $con->fetch_array()) {
                                array_push($array, ['"' . prepararaspas($dado['Nome']) . '"', $dado['COUNT(*)']]);
                                $soma += $dado['COUNT(*)'];
                            }
                            echo deporarray($array);
                            ?>
                        ]);

                        // Instantiate and draw the chart.
                        var chart = new google.visualization.PieChart(document.getElementById('complementopizza'));
                        chart.draw(data, null);
                    }
                </script>
                <div class="grafico" id="complementopizza">
                </div>
                <p>Em relação a <?= $textpesquisaderefencia ?></p>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Complementos', '<?= $textpesquisa ?>', '<?= $textpesquisaderefencia ?>'],
                            <?php
                            $soma = 0;
                            $array = [];
                            $consulta =
                                "SELECT complemento.Nome, SUM(pedido_has_complemento.quantidade) AS 'COUNT(*)'
                                FROM pedido
                                INNER JOIN pedido_has_complemento ON pedido_has_complemento.pedido_idPedido = pedido.idPedido
                                INNER JOIN complemento ON complemento.idComplemento = pedido_has_complemento.complemento_idComplemento
                                WHERE pedido.datadopedido LIKE '$pesquisa%'
                                GROUP BY complemento.Nome
                                ORDER BY complemento.Nome;";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            while ($dado = $con->fetch_array()) {
                                array_push($array, ['"' . prepararaspas($dado['Nome']) . '"', $dado['COUNT(*)'], 0]);
                                $soma += $dado['COUNT(*)'];
                            }
                            $consulta =
                                "SELECT complemento.Nome, SUM(pedido_has_complemento.quantidade) AS 'COUNT(*)'
                                FROM pedido
                                INNER JOIN pedido_has_complemento ON pedido_has_complemento.pedido_idPedido = pedido.idPedido
                                INNER JOIN complemento ON complemento.idComplemento = pedido_has_complemento.complemento_idComplemento
                                WHERE pedido.datadopedido LIKE '$pesquisaderefencia%'
                                GROUP BY complemento.Nome
                                ORDER BY complemento.Nome;";
                            $con = $mysqli->query($consulta) or die($mysqli->error);
                            $c = 1;
                            while ($dado = $con->fetch_array()) {
                                for ($i = 0; $i < sizeof($array); $i++) {
                                    if ('"' . prepararaspas($dado['Nome']) . '"' == $array[$i][0]) {
                                        $array[$i][2] = $dado['COUNT(*)'];
                                        $c = 0;
                                    }
                                }
                            }
                            echo deporarray($array);
                            ?>
                        ]);

                        var chart = new google.visualization.AreaChart(document.getElementById('complementoarea'));
                        chart.draw(data, null);
                    }
                </script>
                <div class="grafico" id="complementoarea"></div>
                <p>Total: <?= $soma ?> lanches</p>
            </div>
        </div>
        <button id="pdf">Baixar pdf</button>
    </main>
    <script>
        imageSaved = document.querySelector('#pdf');
        imageSaved.addEventListener('click', function(){
            window.print();
        })
    </script>
    <?php mysqli_close($mysqli); ?>
</body>

</html>