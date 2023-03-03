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
        <form action="excluir_combo.php" method="POST" id="exclui">
            <div class="blocos">
                <label for="nome">Nome:</label>
                <input name="nome" class="input" type="text" id="nome" placeholder="Nome do combo" required>
                <div class="submit" onclick="enviar('#exclui')">Excluir combo</div>
            </div>
        </form>
        <?php
        include_once('../config.php');
        if (isset($_POST['nome'])) {

            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $pesquisa = prepararaspas($dados["nome"]);

            $cons = "SELECT COUNT(*) From combo WHERE Nome = '$pesquisa' AND ativo = 1";
            $consulta = mysqli_query($mysqli, $cons);

            while ($dado = $consulta->fetch_array()) {
                if ($dado["COUNT(*)"] > 0) :
                    $resul = mysqli_query($mysqli, "UPDATE combo SET ativo = 0 WHERE Nome = '$pesquisa'");
        ?>
                    <div class="sucesso">Combo excluido com sucesso!</div>
                <?php
                endif;
                if ($dado["COUNT(*)"] == 0) :
                ?>
                    <div class="atencao">Não existe combo com este nome!</div>
        <?php
                endif;
            }
        }
        mysqli_close($mysqli);
        ?>
    </main>
</body>

</html>