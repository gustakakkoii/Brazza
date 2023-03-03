<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=j initial-scale=1.0">
    <title>Brazza - cadastro</title>
    <link rel="shortcut icon" href="../fontes/logo.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>

<body>
    <?php
    include_once('../config.php');
    $comandos = explode(';', $_POST['textinsertpedido']);
    $confirma = false;

    for ($i = 0; $i < sizeof($comandos) - 1; $i++) {
        if ($i == 0) {
            $consulta2 = $comandos[$i];
            $con2 = $mysqli->query($consulta2) or die($mysqli->error);
            while ($dado2 = $con2->fetch_array()) {
                if ($dado2['COUNT(*)'] > 0) {
                    $i = sizeof($comandos) + 2;
                    $confirma = true;
                }
            }
        } else {
            $consulta2 = $comandos[$i];
            $con2 = $mysqli->query($consulta2) or die($mysqli->error);
        }
    }
    if ($confirma == true) { ?>
        <script>
            alert('Seu pedido já foi enviado ;), se deseja fazer um novo aperte OK');
            window.location.href = "index.php";
        </script>
    <?php
    } else { ?>
        <script>
            window.location.href = "<?= $_POST['textlink'] ?>";
        </script>
    <?php
    }
    ?>

</body>

</html>