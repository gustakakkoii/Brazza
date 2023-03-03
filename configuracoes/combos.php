<?php

?>

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
        <p class="h1">Combos</p>
        <div class="corpo">
            <?php

            include_once('../config.php');

            $consulta = "SELECT * FROM combo WHERE ativo = 1";
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
                                        $consulta2 = $mysqli->query($cons2) or die($mysqli->error);
                                        $x = '';
                                        while ($dado2 = $consulta2->fetch_array()) {
                                            $idCombo = $dado2['idCombo'];
                                            $consulta3 = "SELECT * FROM combo_com_lanche WHERE idCombo = '$idCombo'";
                                            $consulta3 = $mysqli->query($consulta3) or die($mysqli->error);
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
                        </div>

                    </div>
                </div>
            <?php }
            mysqli_close($mysqli); ?>
        </div>

    </main>
</body>

</html>