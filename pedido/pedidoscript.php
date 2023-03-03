<?php
include_once('../config.php');

$consulta = "SELECT * FROM lanches";
$con = $mysqli->query($consulta) or die($mysqli->error);
$x = 1;
$count = 0;
$consulta4 = "SELECT * FROM complemento WHERE ativo = 1";
$con4 = $mysqli->query($consulta4) or die($mysqli->error);
while ($dado4 = $con4->fetch_array()) {
    $count++;
}

$consulta2 = "SELECT COUNT(*) FROM bebidas where ativo = 1";
$con2 = $mysqli->query($consulta2) or die($mysqli->error);
while ($dado2 = $con2->fetch_array()) {
    $quantidadeA = $dado2['COUNT(*)'];
}
$x = 1;

?>
<script>
    bebidas = document.querySelector('#adicionar_pedido2');
    combo = document.querySelector('#adicionar_pedido3');
    somar1 = document.querySelector('#somar1');
    somar2 = document.querySelector('#somar2');
    somar3 = document.querySelector('#somar3');
    adicionar_bebida = document.querySelector('#adicionar_bebida');
    adicionar_combo = document.querySelector('#adicionar_combo');
    quantBebida = document.querySelector('#quantBebida2');
    quantcombo = document.querySelector('#quantCombo');
    var u = 0;

    k = 0;
    b = 1;
    j = 1;
    quantidadeA = <?= $quantidadeA ?>;
    adicionar_bebida.addEventListener('click', function() {
        if (b == 1) {
            somar2.style.height = quantidadeA * 67 + 'px';
            b = 0;
        } else {
            somar2.style.height = 0;
            b = 1;
        }

    });

    function closed(name) {
        input = document.querySelectorAll('input');
        for (i = 0; i < input.length; i++) {
            if (input[i].name == name) {
                pai = input[i].parentNode;
                pai = pai.parentNode;
                pai = pai.parentNode;
                pai = pai.parentNode;
                pai = pai.parentNode;
                pai.parentNode.removeChild(pai);
            }
        }
    }

    function devolverC(name, id) {
        input = document.querySelectorAll('input');
        for (i = 0; i < input.length; i++) {
            if (input[i].name == name) {
                console.log(input[i])
                pai = input[i].parentNode;
                pai2 = pai.parentNode;
                pai3 = pai2.parentNode;
                pai3.removeChild(pai2);
                pai4 = pai3.parentNode;
                pai4 = pai4.parentNode;
                fechar = document.querySelector('#' + id);
                pai5 = fechar.parentNode;
                pai5.removeChild(fechar);
                somar3.appendChild(pai4);
            }
        }
    }

    <?php
    $consulta3 = "SELECT * FROM bebidas";
    $con3 = $mysqli->query($consulta3) or die($mysqli->error);
    while ($dado3 = $con3->fetch_array()) { ?>
        b<?= $dado3['idBebidas'] ?> = 0;
        pb<?= $dado3['idBebidas'] ?> = document.querySelector('#B<?= $dado3['idBebidas'] ?>');
        div5b<?= $dado3['idBebidas'] ?> = document.createElement('div');
        div5b<?= $dado3['idBebidas'] ?>.setAttribute('class', 'informa_quantidade');
        p2b<?= $dado3['idBebidas'] ?> = document.createElement('p');
        p2b<?= $dado3['idBebidas'] ?>.innerHTML += "Quantidade";
        div5b<?= $dado3['idBebidas'] ?>.appendChild(p2b<?= $dado3['idBebidas'] ?>);
        div6b<?= $dado3['idBebidas'] ?> = document.createElement('div');
        div6b<?= $dado3['idBebidas'] ?>.setAttribute('class', 'valor');
        div6b<?= $dado3['idBebidas'] ?>.innerHTML = '<input name="QuantidadeB<?= $dado3['idBebidas'] ?>" type="number" value="1">';
        div5b<?= $dado3['idBebidas'] ?>.appendChild(div6b<?= $dado3['idBebidas'] ?>);

        bebida<?= $dado3['idBebidas'] ?> = document.querySelector('#B<?= $dado3['idBebidas'] ?>');

        pb<?= $dado3['idBebidas'] ?>.addEventListener('click', function() {
            if (pb<?= $dado3['idBebidas'] ?>.parentNode == somar2) {
                bebidas.appendChild(bebida<?= $dado3['idBebidas'] ?>);
                bebida<?= $dado3['idBebidas'] ?>.appendChild(div5b<?= $dado3['idBebidas'] ?>);
                somar2.style.height = 0;
                quantidadeA--;
                k++;
                quantBebida.value = k;
                b<?= $dado3['idBebidas'] ?>++;
            }
        });

    <?php
    } ?>
    y = 0;

    <?php
    $consulta3 = "SELECT * FROM combo WHERE ativo = 1";
    $con3 = $mysqli->query($consulta3) or die($mysqli->error);

    while ($dado3 = $con3->fetch_array()) { ?>
        c<?= $dado3['idCombo'] ?> = 0;
        pc<?= $dado3['idCombo'] ?> = document.querySelector('#C<?= $dado3['idCombo'] ?>');
        div5c<?= $dado3['idCombo'] ?> = document.createElement('div');
        div5c<?= $dado3['idCombo'] ?>.setAttribute('class', 'informa_quantidade');
        p2c<?= $dado3['idCombo'] ?> = document.createElement('p');
        p2c<?= $dado3['idCombo'] ?>.innerHTML += "Quantidade";
        div5c<?= $dado3['idCombo'] ?>.appendChild(p2c<?= $dado3['idCombo'] ?>);
        div6c<?= $dado3['idCombo'] ?> = document.createElement('div');
        div6c<?= $dado3['idCombo'] ?>.setAttribute('class', 'valor');
        div6c<?= $dado3['idCombo'] ?>.innerHTML = '<input name="quantidadeC<?= $dado3['idCombo'] ?>" type="number" value="1">';
        div5c<?= $dado3['idCombo'] ?>.appendChild(div6c<?= $dado3['idCombo'] ?>);
        combo<?= $dado3['idCombo'] ?> = document.querySelector('#combo<?= $dado3['idCombo'] ?>');
        combo2<?= $dado3['idCombo'] ?> = document.querySelector('#combo2<?= $dado3['idCombo'] ?>');

        pc<?= $dado3['idCombo'] ?>.addEventListener("click", function() {

            if (pc<?= $dado3['idCombo'] ?>.parentNode.parentNode == somar3) {
                combo.appendChild(combo<?= $dado3['idCombo'] ?>);
                combo2<?= $dado3['idCombo'] ?>.appendChild(div5c<?= $dado3['idCombo'] ?>);
                y++;
                quantcombo.value = y;
                c<?= $dado3['idCombo'] ?>++;
                fechar = document.createElement('div');
                fechar.setAttribute('class', 'fechar');
                fechar.setAttribute('onclick', 'devolverC(\'quantidadeC<?= $dado3['idCombo'] ?>\', \'fecharC<?= $dado3['idCombo'] ?>\')');
                fechar.setAttribute('id', 'fecharC<?= $dado3['idCombo'] ?>');
                primeirofilho = combo2<?= $dado3['idCombo'] ?>.parentNode;
                combo<?= $dado3['idCombo'] ?>.insertBefore(fechar, primeirofilho)
            }
        });




    <?php
    } ?>
    l = 0;

    function enviar(id) {
        form = document.querySelector(id);
        form.submit();
    }
</script>