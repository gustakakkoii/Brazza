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
            <form action="criar_combo.php" method="POST" id="criar" enctype="multipart/form-data">
                <div class="blocos">
                    <label for="Nome">Nome:</label>
                    <input name="Nome" class="input" type="text" placeholder="Nome do combo" required>
                </div>
                <div id="textarea" class="blocos">
                    <label for="Especialidades">Especialidades:</label>
                    <div class="card">Informe uma especialidade do combo, deixe vazio cazo não haja (ex: brinde)</div>
                    <textarea name="Especialidades" cols="30" rows="10" required></textarea>
                </div>
                <div class="blocos">
                    <div class="adicionar">
                        <label for="">Lanches:</label>
                        <div class="card">Informe a quantidade de lanches contidos no combo (zero cazo não haja tal lanche no combo)</div>
                        <?php
                        include_once('../config.php');

                        $consulta = "SELECT * FROM lanches WHERE ativo = 1";
                        $con = $mysqli->query($consulta) or die($mysqli->error);

                        $x = 1;
                        while ($dado = $con->fetch_array()) { ?>
                            <div class="informa_quantidade">
                                <p><?php echo $dado['Nome']; ?></p>
                                <input class="sumiu" name="nomeL<?= $x ?>" type="number" value="<?php echo $dado['idLanches']; ?>">
                                <div class="valor">
                                    <input name="quantidadeL<?= $x ?>" type="number" value="0">
                                </div>
                            </div>

                        <?php
                            $x++;
                        } ?>
                    </div>
                </div>
                <div class="blocos">
                    <div class="adicionar">
                        <label for="">Bebidas:</label>
                        <div class="card">Informe a quantidade de bebidas contidas no combo (zero cazo não haja tal bebida no combo)</div>
                        <?php

                        $consulta = "SELECT * FROM bebidas WHERE ativo = 1";
                        $con = $mysqli->query($consulta) or die($mysqli->error);

                        $y = 1;
                        while ($dado = $con->fetch_array()) { ?>
                            <div class="informa_quantidade">
                                <p><?php echo $dado['Nome']; ?></p>
                                <input class="sumiu" name="nomeB<?= $y ?>" type="number" value="<?php echo $dado['idBebidas']; ?>">
                                <div class="valor">
                                    <input name="quantidadeB<?= $y ?>" type="number" value="0">
                                </div>
                            </div>

                        <?php
                            $y++;
                        } ?>
                    </div>
                </div>
                <div class="blocos">
                    <label for="Preco">Preço:</label>
                    <input type="number" class="input" name="Preco" placeholder="Preço do combo" required>
                </div>
                <div class="blocos">
                    <label>Foto:</label>
                    <div class="selecionar_imagem">
                        <label id="form" for="Imagem">Selecione uma imagem do combo</label>
                        <input name="Imagem" id="Imagem" type="file" accept="image/*" />
                    </div>
                </div>
                <div class="submit" onclick="enviar('#criar')">Criar Combo</button>
            </form>
        </div>
        <?php
        if (isset($_POST['Nome'])) :
            $Nome = prepararaspas($_POST['Nome']);
            $cons = "SELECT COUNT(*) From combo WHERE Nome = '$Nome' AND ativo = 1";
            $consulta = mysqli_query($mysqli, $cons);
            while ($dado = $consulta->fetch_array()) {
                if ($dado["COUNT(*)"] == 0) :
                    if (isset($_FILES['Imagem'])) :
                        $extencao = strtolower(substr($_FILES['Imagem']['name'], -4));
                        $novo_nome = (md5(time()) . $extencao);
                        $diretorio = "combos/";

                        move_uploaded_file($_FILES['Imagem']['tmp_name'], "../" . $diretorio . $novo_nome);
                    endif;
                    $Especialidades = prepararaspas($_POST['Especialidades']);
                    $Preco = $_POST['Preco'];
                    $result = mysqli_query($mysqli, "INSERT INTO combo(Nome, Especialidades, Preco, Imagem, ativo) VALUES('$Nome', '$Especialidades', '$Preco', '$novo_nome', 1)");

                    $cons2 = "SELECT idCombo From combo WHERE Nome = '$Nome' AND ativo = 1";
                    $consulta2 = mysqli_query($mysqli, $cons2);
                    while ($dado2 = $consulta2->fetch_array()) {
                        $combo = $dado2['idCombo'];

                        $quantidade = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                        for ($i = 0; $i < $x - 1; $i++) {
                            $lanche = 'quantidadeL' . strval($i + 1);
                            $idlanche = 'nomeL' . strval($i + 1);
                            $lanchex = $quantidade[$lanche];
                            $idlanchex = $quantidade[$idlanche];
                            if ($lanchex > 0) {
                                $cons3 = "INSERT INTO combo_com_lanche(idCombo, idLanches, Quantidade) VALUES('$combo', '$idlanchex', '$lanchex')";
                                $consulta3 = mysqli_query($mysqli, $cons3);
                            }
                        }
                        for ($i = 0; $i < $y - 1; $i++) {
                            $bebida = 'quantidadeB' . strval($i + 1);
                            $idbebida = 'nomeB' . strval($i + 1);
                            $bebidax = $quantidade[$bebida];
                            $idbebidax = $quantidade[$idbebida];
                            if ($bebidax > 0) {
                                $cons4 = "INSERT INTO combo_com_bebida(idCombo, idBebidas, Quantidade) VALUES('$combo', '$idbebidax', '$bebidax')";
                                $consulta4 = mysqli_query($mysqli, $cons4);
                            }
                        }
                    }
        ?>
                    <div class="sucesso">Combo criado com sucesso!</div>
                <?php
                endif;
                if ($dado["COUNT(*)"] != 0) :
                ?>
                    <div class="atencao">Já existe um combo com este nome!</div>
        <?php
                endif;
            }
        endif;
        ?>

    </main>
    <script>
        var file = document.getElementsByClassName('selecionar_imagem')[0];
        file.addEventListener('change', function() {
            var form = document.querySelector('#form');
            file.style = 'background-color: rgba(255, 153, 133, 1);';
            form.innerHTML = 'Imagem selecionada';
            form.style = 'color: black;';
        })
    </script>
</body>

</html>