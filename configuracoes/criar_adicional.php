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

        <?php
        include_once('../config.php');
        if (isset($_POST['Nome'])) {
            $Nome = prepararaspas($_POST['Nome']);
            $cons = "SELECT COUNT(*) FROM complemento WHERE Nome = '$Nome' AND ativo = 1";
            $consulta = mysqli_query($mysqli, $cons);
            while ($dado = $consulta->fetch_array()) {
                if ($dado["COUNT(*)"] == 0) {
                    $Preco = $_POST['Preco'];

                    $result = mysqli_query($mysqli, "INSERT INTO complemento(Nome, Preco, ativo) VALUES('$Nome', '$Preco', 1)");
        ?>
                    <div class="sucesso">Adicional criado com sucesso!</div>
                <?php
                }
                if ($dado["COUNT(*)"] != 0) {
                ?>
                    <div class="atencao">Já existe um adicional com este nome!</div>
        <?php
                }
            }
            mysqli_close($mysqli);
        }
        ?>
        <form action="criar_adicional.php" method="POST" id="criar">

            <div class="blocos">
                <label for="Nome">Nome:</label>
                <input name="Nome" class="input" type="text" placeholder="Nome do adicional" required>
            </div>
            <div class="blocos">
                <label for="Preco">Preço:</label>
                <input type="number" class="input" name="Preco" id="" placeholder="Preço do adicional" required>
            </div>
            <div class="submit" onclick="enviar('#criar')">Criar Adicional</button>
        </form>
    </main>
</body>

</html>