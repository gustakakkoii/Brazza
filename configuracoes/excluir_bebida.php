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
        <div class="card">Atenção! ao excluir uma bebida, caso houver um combo com esta bebida incluida, tal combo não será removido e deverá ser excluido manualmente na aba excluir combo</div>
        <form action="excluir_bebida.php" method="POST" id="exclui">
            <div class="blocos">
                <label for="codigo">Nome:</label>
                <input name="nome" class="input" type="text" id="nome" placeholder="Nome da bebida" required>
                <div class="submit" onclick="enviar('#exclui')">Excluir bebida</div>
            </div>
        </form>
        <?php
        include_once('../config.php');
        if (isset($_POST['nome'])) {

            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $pesquisa = prepararaspas($dados["nome"]);

            $cons = "SELECT COUNT(*) From bebidas WHERE Nome = '$pesquisa' AND ativo = 1";
            $consulta = mysqli_query($mysqli, $cons);

            while ($dado = $consulta->fetch_array()) {
                if ($dado["COUNT(*)"] == 1) :

                    $cons2 = "SELECT * From bebidas WHERE Nome = '$pesquisa' AND ativo = 1";
                    $consulta2 = mysqli_query($mysqli, $cons2);
                    while ($dado2 = $consulta2->fetch_array()) {
                        $idbebida = $dado2['idBebidas'];
                        $resul = mysqli_query($mysqli, "UPDATE bebidas SET ativo = 0 WHERE Nome = '$pesquisa'");
                    }
        ?>
                    <div class="sucesso">Bebida excluida com sucesso!</div>
                <?php
                endif;
                if ($dado["COUNT(*)"] != 1) :
                ?>
                    <div class="atencao">Não existe bebida com este nome!</div>
        <?php
                endif;
            }
        }
        mysqli_close($mysqli);
        ?>
    </main>
</body>

</html>