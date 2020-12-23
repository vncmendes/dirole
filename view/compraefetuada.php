<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once "head.php"; ?>

</head>
<body>

    <?php require_once "navbar2.php"; ?>

    <div class="container" style="width: 100%; padding: 5% 0 5% 0;">
        <div class="container">
            <div class="compraOK" style="display: flex; justify-content: center; width: 100%">
                <h2 style="margin: 5%;">Parabéns sua compra foi ralizada com sucesso !</h2>
            </div>
            <div class="container" style="padding: 0 10% 0 10%;">
                <a href="gerarticket.php" style="display:flex; justify-content:center; margin-bottom: 2%;" class="btn btn-danger">Gerar Ticket</a>
            </div>
        </div>
        <a href="gerarticket.php"><img src="images/ticket1.jpg" style="width: 15%; padding: 2%; display:block; margin-left: auto; margin-right: auto;" alt="Sua entrada da festa !"></a>
    </div>
</body>

<?php require_once "footer.php" ?>
</html>