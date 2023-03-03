<?php
$x = 0;
include_once('../config.php');
if (isset($_POST['text'])) :
    $cons2 = "SELECT * FROM bebidas";
    $consulta2 = mysqli_query($mysqli, $cons2);
    while ($dado2 = $consulta2->fetch_array()) {
        $idBebidas = 'Preco' . $dado2['idBebidas'];
        if (isset($_POST[$idBebidas])) {
            if ($dado2["Preco"] != $_POST[$idBebidas]) {
                if ($_POST[$idBebidas] != 0) {
                    $novopreco = $_POST[$idBebidas];
                    $Bebidas = $dado2['idBebidas'];
                    $result = mysqli_query($mysqli, "UPDATE bebidas SET Preco = '$novopreco' WHERE idBebidas = '$Bebidas'");
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
        <p class="h1">Bebidas</p>
        <?php
        if ($x == 1) { ?>
            <div class="sucesso">Preços alterados</div>
        <?php }
        ?>
        <div class="corpo">
            <form action="bebidas.php" id="alterar" method="POST">
                <input type="text" class="sumiu" name="text" value="text">
                <?php
                $consulta = "SELECT * FROM bebidas WHERE ativo = 1";
                $con = $mysqli->query($consulta) or die($mysqli->error);
                while ($dado = $con->fetch_array()) { ?>
                    <div class="informa_preco">
                        <p><?php echo $dado['Nome']; ?></p>
                        <input class="sumiu" name="nome<?php echo $dado['idBebidas'] ?>" type="number" value="<?php echo $dado['idBebidas'] ?>">
                        <div class="valor">
                            <p>R$</p>
                            <input name="Preco<?php echo $dado['idBebidas'] ?>" type="number" value="<?php echo $dado['Preco'] ?>">
                        </div>
                    </div>
                <?php
                }
                mysqli_close($mysqli); ?>
                <div class="submit" onclick="enviar('#alterar')">Alterar Preços</button>
            </form>
        </div>
    </main>

</body>

</html>