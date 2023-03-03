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
        <div class="card">Atenção! ao excluir um lanche, caso houver um combo com este lanche incluido, tal combo não será removido e deverá ser excluido manualmente na aba excluir combo</div>
        <form action="excluir_lanche.php" method="POST" id="exclui">
            <div class="blocos">
                <label for="nome">Nome:</label>
                <input name="nome" class="input" type="text" id="nome" placeholder="Nome do lanche" required>
                <div class="submit" onclick="enviar('#exclui')">Excluir lanche</div>
            </div>
        </form>
        <?php
        include_once('../config.php');
        if (isset($_POST['nome'])) {

            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $pesquisa = prepararaspas($dados["nome"]);

            $cons = "SELECT COUNT(*) From lanches WHERE Nome = '$pesquisa' AND ativo = 1";
            $consulta = mysqli_query($mysqli, $cons);

            while ($dado = $consulta->fetch_array()) {
                if ($dado["COUNT(*)"] > 0) :

                    $cons2 = "SELECT * From lanches WHERE Nome = '$pesquisa' AND ativo = 1";
                    $consulta2 = mysqli_query($mysqli, $cons2);
                    while ($dado2 = $consulta2->fetch_array()) {
                        $idlanche = intval($dado2['idLanches']);
                        $resul = mysqli_query($mysqli, "UPDATE lanches SET ativo = 0 WHERE Nome = '$pesquisa'");
                    }
        ?>
                    <div class="sucesso">Lanche excluido com sucesso!</div>
                <?php
                endif;
                if ($dado["COUNT(*)"] == 0) :
                ?>
                    <div class="atencao">Não existe lanche com este nome!</div>
        <?php
                endif;
            }
        }
        mysqli_close($mysqli);
        ?>
    </main>

</body>

</html>