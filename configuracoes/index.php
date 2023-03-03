<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    include_once('head.php');
    ?>

</head>

<body>
    <nav>
        <?php
        include_once('menu.php');
        ?>
    </nav>
    <main>
        <p class="h1">Configurações</p>
        <div class="corpo">
            <?php
            function preparamensagem($t)
            {
                $j = explode('\'', $t);
                $te = '\\\'';
                $je = '';
                for ($h = 0; $h < sizeof($j); $h++) {
                    if ($h == 0) {
                        $je = $j[$h];
                    } else {
                        $je = $je . $te . $j[$h];
                    }
                }
            
                $j = explode("\"", $je);
                $te = "\\\"";
                $je = '';
                for ($h = 0; $h < sizeof($j); $h++) {
                    if ($h == 0) {
                        $je = $j[$h];
                    } else {
                        $je = $je . $te . $j[$h];
                    }
                }
            
                return $je;
            }

            include_once('../config.php');
            if (isset($_POST['entrega'])) {
                $entrega = prepararaspas($_POST['entrega']);
                $mensagempedido = preparamensagem($_POST['mensagempedido']);
                $mensagem = preparamensagem($_POST['mensagem']);
                $pedido = prepararaspas($_POST['pedido']);
                $taxa = $_POST['taxa'];
                $pais = $_POST['pais'];
                $ddd = $_POST['ddd'];
                $telefone = $_POST['telefone'];
                $chavepix = $_POST['chavepix'];
                $localdebusca = preparamensagem($_POST['localdebusca']);
                $result = mysqli_query($mysqli, "UPDATE config SET entrega = $entrega");
                $result = mysqli_query($mysqli, "UPDATE config SET mensagemerro = '$mensagem'");
                $result = mysqli_query($mysqli, "UPDATE config SET aceitandopedido = $pedido");
                $result = mysqli_query($mysqli, "UPDATE config SET mensagempedido = '$mensagempedido'");
                $result = mysqli_query($mysqli, "UPDATE config SET taxa = $taxa");
                $result = mysqli_query($mysqli, "UPDATE config SET pais = $pais");
                $result = mysqli_query($mysqli, "UPDATE config SET ddd = $ddd");
                $result = mysqli_query($mysqli, "UPDATE config SET localdebusca = '$localdebusca'");
                $result = mysqli_query($mysqli, "UPDATE config SET telefone = $telefone");
                $result = mysqli_query($mysqli, "UPDATE config SET chavepix = '$chavepix'");
            ?>
                <div class="sucesso">Alterações salvas com sucesso!</div>
            <?php } ?>
            <form action="index.php" method="POST" id="edit">

                <p>Para pular linha use a tag: &ltbr&gt</p>
                <div class="blocos">
                    <div class="entrega">
                        <?php
                        $consulta = "SELECT * FROM config";
                        $con = $mysqli->query($consulta) or die($mysqli->error);
                        while ($dado = $con->fetch_array()) {
                            if ($dado['aceitandopedido'] == 1) {
                        ?>
                                <input class="sumiu" type="radio" name="pedido" id="pedidoativada" value="1" checked='checked'>
                                <label id="lpedidoativada" for="pedidoativada">Receber pedidos</label>
                                <input class="sumiu" type="radio" name="pedido" id="pedidodesativada" value="0">
                                <label id="lpedidodesativada" for="pedidodesativada">Não receber pedidos</label>
                            <?php
                            }
                            if ($dado['aceitandopedido'] == 0) {
                            ?>
                                <input class="sumiu" type="radio" name="pedido" id="pedidoativada" value="1">
                                <label id="lpedidoativada" for="pedidoativada">Receber pedidos</label>
                                <input class="sumiu" type="radio" name="pedido" id="pedidodesativada" value="0" checked='checked'>
                                <label id="lpedidodesativada" for="pedidodesativada">Não receber pedidos</label>
                        <?php }
                        }
                        ?>
                    </div>
                    <?php
                    $consulta = "SELECT * FROM config";
                    $con = $mysqli->query($consulta) or die($mysqli->error);
                    while ($dado = $con->fetch_array()) {
                        if ($dado['aceitandopedido'] == 1) {
                    ?>
                            <div id="informa_telefone" style="height: 80px;">
                                <p>Número o qual será enviado os pedidos:</p>
                                <div class="informa_telefone">
                                    <input name="pais" type="number" value="<?php echo $dado['pais'] ?>">
                                    <input name="ddd" type="number" value="<?php echo $dado['ddd'] ?>">
                                    <input name="telefone" type="number" value="<?php echo $dado['telefone'] ?>">
                                </div>
                            </div>
                            <div id="textpedido" style="height: 0;">
                                <div class="card">Escreva uma mensagem para o cliente esclarecendo:</div>
                                <textarea name="mensagempedido" id="textpedidoarea" cols="30" rows="10"><?= $dado['mensagempedido'] ?></textarea>
                            </div>
                        <?php
                        }
                        if ($dado['aceitandopedido'] == 0) {
                        ?><div id="informa_telefone" style="height: 0;">
                                <p>Número o qual será enviado os pedidos:</p>
                                <div class="informa_telefone">
                                    <input name="pais" type="number" value="<?php echo $dado['pais'] ?>">
                                    <input name="ddd" type="number" value="<?php echo $dado['ddd'] ?>">
                                    <input name="telefone" type="number" value="<?php echo $dado['telefone'] ?>">
                                </div>
                            </div>
                            <div id="textpedido" style="height: 300px;">
                                <div class="card">Escreva uma mensagem para o cliente esclarecendo:</div>
                                <textarea name="mensagempedido" id="textpedidoarea" cols="30" rows="10"><?= $dado['mensagempedido'] ?></textarea>
                            </div>
                    <?php }
                    }
                    ?>
                </div>
                <script>
                    textareap = document.querySelector('#textpedido');
                    eativada = document.querySelector('#pedidoativada');
                    edesativada = document.querySelector('#pedidodesativada');
                    telefone = document.querySelector('#informa_telefone');

                    eativada.addEventListener('click', function() {
                        textareap.style.height = 0;
                        telefone.style.height = '80px';
                    })
                    edesativada.addEventListener('click', function() {
                        textareap.style.height = '300px';
                        telefone.style.height = 0;
                    })
                </script>
                <div class="blocos">
                    <div class="entrega">
                        <?php
                        $consulta = "SELECT * FROM config";
                        $con = $mysqli->query($consulta) or die($mysqli->error);
                        while ($dado = $con->fetch_array()) {
                            if ($dado['entrega'] == 1) {
                        ?>
                                <input class="sumiu" type="radio" name="entrega" id="entregaativada" value="1" checked='checked'>
                                <label id="lentregaativada" for="entregaativada">Entrega ativada</label>
                                <input class="sumiu" type="radio" name="entrega" id="entregadesativada" value="0">
                                <label id="lentregadesativada" for="entregadesativada">Entrega desativada</label>
                            <?php
                            }
                            if ($dado['entrega'] == 0) {
                            ?>

                                <input class="sumiu" type="radio" name="entrega" id="entregaativada" value="1">
                                <label id="lentregaativada" for="entregaativada">Entrega ativada</label>
                                <input class="sumiu" type="radio" name="entrega" id="entregadesativada" value="0" checked='checked'>
                                <label id="lentregadesativada" for="entregadesativada">Entrega desativada</label>
                        <?php }
                        }
                        ?>
                    </div>
                    <?php
                    $consulta = "SELECT * FROM config";
                    $con = $mysqli->query($consulta) or die($mysqli->error);
                    while ($dado = $con->fetch_array()) {
                        if ($dado['entrega'] == 1) {
                    ?>
                            <div id="taxa" style="height: 290px;">
                                <div class="informa_preco" style="width: 100%;">
                                    <p>Taxa de entrega:</p>
                                    <div class="valor">
                                        <p>R$</p>
                                        <input name="taxa" type="number" value="<?php echo $dado['taxa'] ?>">
                                    </div>

                                </div>
                                <textarea name="localdebusca" cols="30" rows="10"><?php echo $dado['localdebusca'] ?></textarea>
                            </div>
                            <div id="textentrega" style="height: 0;">
                                <div class="card">Escreva uma mensagem para o cliente esclarecendo a falta de entrega:</div>
                                <textarea name="mensagem" id="textentregaarea" cols="30" rows="10" pattern="[a-z\s]+ã+â+ê+î+ô+û+á+é+í+ó+ú"><?= $dado['mensagemerro'] ?></textarea>
                            </div>
                        <?php
                        }
                        if ($dado['entrega'] == 0) {
                        ?>
                            <div id="taxa" style="height: 0px;">
                                <div class="informa_preco" style="width: 100%;">
                                    <p>Taxa de entrega:</p>
                                    <div class="valor">
                                        <p>R$</p>
                                        <input name="taxa" type="number" value="<?php echo $dado['taxa'] ?>">
                                    </div>

                                </div>
                                <textarea name="localdebusca" cols="30" rows="10"><?php echo $dado['localdebusca'] ?></textarea>
                            </div>
                            <div id="textentrega" style="height: 290px;">
                                <div class="card">Escreva uma mensagem para o cliente esclarecendo a falta de entrega:</div>
                                <textarea name="mensagem" id="textentregaarea" cols="30" rows="10"><?= $dado['mensagemerro'] ?></textarea>
                            </div>
                    <?php }
                    }
                    ?>
                </div>

                <?php
                $consulta = "SELECT * FROM config";
                $con = $mysqli->query($consulta) or die($mysqli->error);
                while ($dado = $con->fetch_array()) { ?>
                    <div class="blocos">
                        <label for="chavepix">Chave PIX:</label>
                        <input class="input" type="text" name="chavepix" id="chavepix" value="<?= $dado['chavepix'] ?>">
                    </div>
                <?php } ?>
                <script>
                    textarea = document.querySelector('#textentrega');
                    eativada = document.querySelector('#entregaativada');
                    edesativada = document.querySelector('#entregadesativada');
                    taxa = document.querySelector('#taxa');

                    eativada.addEventListener('click', function() {
                        textarea.style.height = 0;
                        taxa.style.height = '290px';
                    })
                    edesativada.addEventListener('click', function() {
                        textarea.style.height = '290px';
                        taxa.style.height = 0;
                    })
                </script>
                <div class="submit" onclick="enviar('#edit')">Salvar Alterações</div>
                <?php mysqli_close($mysqli); ?>
        </div>
        </form>
        </div>

    </main>
</body>

</html>