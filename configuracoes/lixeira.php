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
        <div class="card">Atenção! ao restaurar um elemento, caso houver um complemento desse elemento excluido, tal complemento não será restaurado, ou seja, deverá ser restaurado manualmente</div>

        <?php
        include_once('../config.php');
        if (isset($_POST['text'])) {
            $x = 0;
            $consulta = "SELECT * FROM lanches WHERE ativo = 0";
            $con = $mysqli->query($consulta) or die($mysqli->error);
            while ($dado = $con->fetch_array()) {
                $resteuralanche = 'L' . $dado['idLanches'];
                if (isset($_POST[$resteuralanche])) {
                    $idlanche = $dado['idLanches'];
                    $result = mysqli_query($mysqli, "UPDATE lanches SET ativo = 1 WHERE idLanches = $idlanche");
                    $x++;
                }
            }
            $consulta = "SELECT * FROM complemento WHERE ativo = 0";
            $con = $mysqli->query($consulta) or die($mysqli->error);
            while ($dado = $con->fetch_array()) {
                $resteuralanche = 'c' . $dado['idComplemento'];
                if (isset($_POST[$resteuralanche])) {
                    $idcomplemento = $dado['idComplemento'];
                    $result = mysqli_query($mysqli, "UPDATE complemento SET ativo = 1 WHERE idComplemento = '$idcomplemento'");
                    $x++;
                }
            }
            $consulta = "SELECT * FROM bebidas WHERE ativo = 0";
            $con = $mysqli->query($consulta) or die($mysqli->error);
            while ($dado = $con->fetch_array()) {
                $resteuralanche = 'B' . $dado['idBebidas'];
                if (isset($_POST[$resteuralanche])) {
                    $idbebidas = $dado['idBebidas'];
                    $result = mysqli_query($mysqli, "UPDATE bebidas SET ativo = 1 WHERE idBebidas = '$idbebidas'");
                    $x++;
                }
            }
            $consulta = "SELECT * FROM combo WHERE ativo = 0";
            $con = $mysqli->query($consulta) or die($mysqli->error);
            while ($dado = $con->fetch_array()) {
                $resteuralanche = 'C' . $dado['idCombo'];
                if (isset($_POST[$resteuralanche])) {
                    $idCombo = $dado['idCombo'];
                    $result = mysqli_query($mysqli, "UPDATE combo SET ativo = 1 WHERE idCombo = '$idCombo'");
                    $x++;
                }
            }
            if ($x > 0) { ?>
                <div class="sucesso">Atualização feita com sucesso!</div>
        <?php
            }
        }
        ?>
        <div class="corpo">
            <form action="" method="post" id="exclui">
                <?php
                $consulta = "SELECT * FROM lanches WHERE ativo = 0";
                $con = $mysqli->query($consulta) or die($mysqli->error);
                $quantidadedelanchesinativos = 0;
                while ($dado = $con->fetch_array()) {
                    $quantidadedelanchesinativos++;
                }
                if ($quantidadedelanchesinativos != 0) { ?>
                    <p class="h1">Hamburguers</p>
                <?php }
                $consulta = "SELECT * FROM lanches WHERE ativo = 0";
                $con = $mysqli->query($consulta) or die($mysqli->error);
                while ($dado = $con->fetch_array()) { ?>
                    <div class="blocos">
                        <div class="lanches">
                            <div class="card-img-top" style="background-image: url('..//lanches//<?= $dado['Imagem'] ?>');"></div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <p class="title"><?php echo $dado['Nome'] ?></p>
                                        <?php
                                        $lanche = $dado['idLanches'];
                                        $x = '';
                                        $consulta2 = "SELECT * FROM lanches_com_complemento WHERE idLanches = $lanche";
                                        $con2 = $mysqli->query($consulta2) or die($mysqli->error);
                                        while ($dado2 = $con2->fetch_array()) {
                                            $idcomplemento = $dado2['idComplemento'];
                                            $consulta3 = "SELECT Nome FROM complemento WHERE idComplemento = $idcomplemento";
                                            $con3 = $mysqli->query($consulta3) or die($mysqli->error);
                                            while ($dado3 = $con3->fetch_array()) {
                                                if ($dado2['Quantidade'] > 1) {
                                                    if ($x == '') {
                                                        $x = $dado2['Quantidade'] . ' ' . $dado3['Nome'];
                                                    } else {
                                                        $x =  $x . ', ' . $dado2['Quantidade'] . ' ' . $dado3['Nome'];
                                                    }
                                                } else {
                                                    if ($x == '') {
                                                        $x = $dado3['Nome'];
                                                    } else {
                                                        $x =  $x . ', ' . $dado3['Nome'];
                                                    }
                                                }
                                            }
                                        } ?>
                                        <p class="card-text"><?= $x ?></p>
                                    </div>
                                    <div class="direita">
                                        <div class="btn">
                                            <sup>R$</sup>
                                            <p><?php echo $dado['Preco'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="restaurar">
                                    <input type="checkbox" name="L<?php echo $dado['idLanches'] ?>" id="L<?php echo $dado['idLanches'] ?>">
                                    <label for="L<?php echo $dado['idLanches'] ?>">Restaurar este lanche</label>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php }
                $consulta = "SELECT * FROM complemento WHERE ativo = 0";
                $con = $mysqli->query($consulta) or die($mysqli->error);
                $quantidadedelanchesinativos = 0;
                while ($dado = $con->fetch_array()) {
                    $quantidadedelanchesinativos++;
                }
                if ($quantidadedelanchesinativos != 0) { ?>
                    <p class="h1">Adicionais</p>
                <?php }

                $consulta = "SELECT * FROM complemento WHERE ativo = 0";
                $con = $mysqli->query($consulta) or die($mysqli->error);
                while ($dado = $con->fetch_array()) { ?>
                    <div class="cardlista">
                        <div class="informa_preco">
                            <p><?php echo $dado['Nome']; ?></p>
                            <div class="valor">
                                <p>R$<?php echo $dado['Preco'] ?></p>
                            </div>
                        </div>
                        <div class="restaurar">
                            <input type="checkbox" name="c<?php echo $dado['idComplemento'] ?>" id="c<?php echo $dado['idComplemento'] ?>">
                            <label for="c<?php echo $dado['idComplemento'] ?>">Restaurar este adicional</label>
                        </div>
                    </div>

                <?php }
                $consulta = "SELECT * FROM bebidas WHERE ativo = 0";
                $con = $mysqli->query($consulta) or die($mysqli->error);
                $quantidadedelanchesinativos = 0;
                while ($dado = $con->fetch_array()) {
                    $quantidadedelanchesinativos++;
                }
                if ($quantidadedelanchesinativos != 0) { ?>
                    <p class="h1">Bebidas</p>
                <?php }

                $consulta = "SELECT * FROM bebidas WHERE ativo = 0";
                $con = $mysqli->query($consulta) or die($mysqli->error);
                while ($dado = $con->fetch_array()) { ?>
                    <div class="cardlista">
                        <div class="informa_preco">
                            <p><?php echo $dado['Nome']; ?></p>
                            <div class="valor">
                                <p>R$<?php echo $dado['Preco'] ?></p>
                            </div>
                        </div>
                        <div class="restaurar">
                            <input type="checkbox" name="B<?php echo $dado['idBebidas'] ?>" id="B<?php echo $dado['idBebidas'] ?>">
                            <label for="B<?php echo $dado['idBebidas'] ?>">Restaurar esta bebida</label>
                        </div>
                    </div>


                <?php }
                $consulta = "SELECT * FROM combo WHERE ativo = 0";
                $con = $mysqli->query($consulta) or die($mysqli->error);
                $quantidadedelanchesinativos = 0;
                while ($dado = $con->fetch_array()) {
                    $quantidadedelanchesinativos++;
                }
                if ($quantidadedelanchesinativos != 0) { ?>
                    <p class="h1">Combos</p>
                <?php }
                $consulta = "SELECT * FROM combo WHERE ativo = 0";
                $con = $mysqli->query($consulta) or die($mysqli->error);
                while ($dado = $con->fetch_array()) { ?>
                    <div class="blocos">
                        <div class="lanches">
                            <div class="card-img-top" style="background-image: url('../combos/<?= $dado['Imagem'] ?>');"></div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <p class="title"><?php echo $dado['Nome']; ?></p>
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
                                            <p><?php echo $dado['Preco'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="restaurar">
                                    <input type="checkbox" name="C<?php echo $dado['idCombo'] ?>" id="C<?php echo $dado['idCombo'] ?>">
                                    <label for="C<?php echo $dado['idCombo'] ?>">Restaurar este combo</label>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php }
                ?>
                <input class="sumiu" type="text" name="text" value="text">
                <div class="submit" onclick="enviar('#exclui')">Salvar Alterações</div>
            </form>
        </div>
    </main>
</body>

</html>