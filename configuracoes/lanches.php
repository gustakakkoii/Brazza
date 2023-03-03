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
        <p class="h1">Hamburguers</p>
        <div class="corpo">
            <?php
            include_once('../config.php');
            $consulta = "SELECT * FROM lanches WHERE ativo = 1";
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
                                        $consulta3 = "SELECT Nome FROM complemento WHERE idComplemento = $idcomplemento AND ativo = 1";
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
                        </div>
                    </div>
                </div>
            <?php }
            mysqli_close($mysqli); ?>
        </div>

    </main>
</body>

</html>