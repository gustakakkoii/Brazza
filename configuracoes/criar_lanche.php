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
        <div class="corpo">
            <form action="criar_lanche.php" method="POST" id="criar" enctype="multipart/form-data">
                <?php
                include_once('../config.php');
                if (isset($_POST['Nome'])) :
                    $Nome = prepararaspas($_POST['Nome']);
                    $cons = "SELECT COUNT(*) From lanches WHERE Nome = '$Nome' AND ativo = 1";
                    $consulta = mysqli_query($mysqli, $cons);
                    while ($dado = $consulta->fetch_array()) {
                        if ($dado["COUNT(*)"] == 0) :
                            if (isset($_FILES['Imagem'])) :
                                $extencao = strtolower(substr($_FILES['Imagem']['name'], -4));
                                $novo_nome = (md5(time()) . $extencao);
                                $diretorio = "lanches/";

                                move_uploaded_file($_FILES['Imagem']['tmp_name'], "../" . $diretorio . $novo_nome);
                            endif;
                            $Preco = $_POST['Preco'];

                            $result = mysqli_query($mysqli, "INSERT INTO lanches(Nome, Preco, Imagem, ativo) VALUES('$Nome', '$Preco', '$novo_nome', 1)");

                            $consulta2 = "SELECT * FROM lanches WHERE Nome = '$Nome' AND ativo = 1";
                            $con2 = $mysqli->query($consulta2) or die($mysqli->error);
                            while ($dado2 = $con2->fetch_array()) {
                                $idlanche = $dado2['idLanches'];
                            }

                            $consulta2 = "SELECT * FROM complemento WHERE ativo = 1";
                            $con2 = $mysqli->query($consulta2) or die($mysqli->error);
                            while ($dado2 = $con2->fetch_array()) {
                                if ($_POST['quantidadeL' . $dado2['idComplemento']] != 0) {
                                    $quantidade = $_POST['quantidadeL' . $dado2['idComplemento']];
                                    $complemento = $dado2['idComplemento'];
                                    $con3 = $mysqli->query("INSERT INTO lanches_com_complemento(idLanches, idComplemento, Quantidade) VALUES('$idlanche', '$complemento', '$quantidade')") or die($mysqli->error);
                                }
                            }
                ?>
                            <div class="sucesso">Lanche criado com sucesso!</div>
                        <?php
                        endif;
                        if ($dado["COUNT(*)"] != 0) :
                        ?>
                            <div class="atencao">Já existe um lanche com este nome!!</div>
                <?php
                        endif;
                    }
                endif;
                ?>
                <div class="blocos">
                    <label for="Nome">Nome:</label>
                    <input name="Nome" class="input" type="text" placeholder="Nome do lanche" required>
                </div>
                <div class="blocos">
                    <div class="adicionar">
                        <label>Ingredientes:</label>
                        <div class="card">É necessário criar os ingredientes antes de criar o lanche</div>
                        <div class="card">informe a quantidade de cada Ingrediente (zero caso não vá tal ingrediete)</div>
                        <?php

                        $consulta = "SELECT * FROM complemento WHERE ativo = 1";
                        $con = $mysqli->query($consulta) or die($mysqli->error);

                        while ($dado = $con->fetch_array()) { ?>
                            <div class="informa_quantidade">
                                <p><?php echo $dado['Nome']; ?></p>
                                <input class="sumiu" name="nomeL<?php echo $dado['idComplemento'] ?>" type="number" value="<?php echo $dado['idComplemento'] ?>">
                                <div class="valor">
                                    <input name="quantidadeL<?php echo $dado['idComplemento'] ?>" type="number" value="0">
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
                <div class="blocos">
                    <label for="Preco">Preço:</label>
                    <input type="number" class="input" name="Preco" id="" placeholder="Preço do lanche" required>
                </div>
                <div class="blocos">
                    <label>Foto:</label>
                    <div class="selecionar_imagem">
                        <label id="form" for="Imagem">Selecione uma imagem do lanche</label>
                        <input name="Imagem" id="Imagem" type="file" accept="image/*" required />
                    </div>
                </div>
                <div class="submit" onclick="enviar('#criar')">Criar Lanche</button>


            </form>
        </div>
    </main>
    <script>
        var file = document.getElementsByClassName('selecionar_imagem')[0];
        file.addEventListener('change', function() {
            var form = document.querySelector('#form');
            file.style = 'background-color: rgba(32, 34, 39, 1);';
            form.innerHTML = 'Imagem selecionada';
            form.style = 'color: #fff;';
        })
    </script>
</body>

</html>