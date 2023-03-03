<?php
$x = 0;
include_once('../config.php');
if (isset($_POST['text'])) :
    $cons = "SELECT * FROM complemento";
    $consulta = mysqli_query($mysqli, $cons);
    while ($dado = $consulta->fetch_array()) {
        $idcomplemento = 'Preco' . $dado['idComplemento'];
        if (isset($_POST[$idcomplemento])) {
            if ($dado["Preco"] != $_POST[$idcomplemento]) {
                if ($_POST[$idcomplemento] != 0) {
                    $novopreco = $_POST[$idcomplemento];
                    $complemento = $dado['idComplemento'];
                    $result = mysqli_query($mysqli, "UPDATE complemento SET Preco = '$novopreco' WHERE idComplemento = '$complemento'");
                    $x = 1;
                }
            }
        }
    }
endif;
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
        <p class="h1">Complementos</p>
        <?php
        if ($x == 1) { ?>
            <div class="sucesso">Preços alterados</div>
        <?php }
        ?>
        <div class="corpo">
            <form action="adicionais.php" id="alterar" method="POST">
                <input type="text" class="sumiu" name="text" value="text">
                <?php

                $consulta = "SELECT * FROM complemento WHERE ativo = 1";
                $con = $mysqli->query($consulta) or die($mysqli->error);

                while ($dado = $con->fetch_array()) { ?>
                    <div class="informa_preco">
                        <p><?php echo $dado['Nome']; ?></p>
                        <input class="sumiu" name="nome<?php echo $dado['idComplemento'] ?>" type="number" value="<?php echo $dado['idComplemento'] ?>">
                        <div class="valor">
                            <p>R$</p>
                            <input name="Preco<?php echo $dado['idComplemento'] ?>" type="number" value="<?php echo $dado['Preco'] ?>">
                        </div>
                    </div>
                <?php
                }
                mysqli_close($mysqli);
                ?>
                <div class="submit" onclick="enviar('#alterar')">Alterar Preços</button>
            </form>
        </div>
    </main>

</body>

</html>