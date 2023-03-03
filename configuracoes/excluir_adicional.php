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
        <div class="card">Atenção! ao excluir um ingrediente, caso houver um lanche com este ingrediente incluido, tal lanche não será removido e deverá ser excluido manualmente na aba excluir lanche</div>
        <form action="excluir_adicional.php" id="exclui" method="POST">
            <div class="blocos">
                <label for="codigo">Nome:</label>
                <input name="nome" class="input" type="text" id="nome" placeholder="Nome do ingrediente" required>
                <div class="submit" onclick="enviar('#exclui')">Excluir ingrediente</div>
            </div>
        </form>
        <?php
        include_once('../config.php');
        if (isset($_POST['nome'])) {

            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $pesquisa = prepararaspas($dados["nome"]);

            $cons = "SELECT COUNT(*) From complemento WHERE Nome = '$pesquisa' AND ativo = 1";
            $consulta = mysqli_query($mysqli, $cons);

            while ($dado = $consulta->fetch_array()) {
                if ($dado["COUNT(*)"] >= 1) :
                    $cons2 = "SELECT * From complemento WHERE Nome = '$pesquisa' AND ativo = 1";
                    $consulta2 = mysqli_query($mysqli, $cons2);
                    while ($dado2 = $consulta2->fetch_array()) {
                        $idComplemento = $dado2['idComplemento'];
                        $resul = mysqli_query($mysqli, "UPDATE complemento SET ativo = 0 WHERE Nome = '$pesquisa'");
                    }
        ?>
                    <div class="sucesso">ingrediente excluido com sucesso!</div>
                <?php
                endif;
                if ($dado["COUNT(*)"] == 0) :
                ?>
                    <div class="atencao">Não existe ingrediente com este nome!</div>
        <?php
                endif;
            }
        }
        mysqli_close($mysqli);
        ?>
    </main>
</body>

</html>