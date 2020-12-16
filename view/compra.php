<?php 
    session_start();
    require_once "../model/Evento.php";
    require_once "../model/Usuario.php";
    require_once '../controller/evento.php';
    require_once '../controller/usuario.php';

    $idevento = $_POST['id'];
    $evento = $eventos->find($idevento);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once 'head.php';
        require_once 'navbar2.php';
    ?>
</head>
<body>
<section class="">
        <div class="eventcardscontent">
            <div class="singleMainBox">
                <div class="cardimage">
                            <!-- <li><img src="/images/< ?= $evento->arquivo ?>"></li> // mais ou menos certo -->
                            <li style="list-style: none;"><img src="images/<?= $evento->arquivo?>" alt=""></li>
                </div>
                <div class="singleCard">
                    <ul>
                        <div class="singleInfos"> 
                            <li><b>Nome</b>: <?=$evento->nome?></li>
                            <?php $dataOK = date_create($evento->data) ?>
                            <li><b>Data</b>: <?=date_format($dataOK, "d/m/Y")?></li>
                            <li><b>Localização</b>: <?=$evento->localizacao?></li>
                            <li><b>Descrição</b>: <?=$evento->descricao?></li>
                            <li><b>Valor</b>: <?=$evento->ingresso . " R$";?></li><br>
                            <li class="text-center"><b>Quantidade</b>: <?=$evento->qtd ?></li>
                        </div>

                        <form action="../controller/compra.php" method="POST">
                            <div style="display: flex; justify-content: center; padding-top: 5%;">
                                <?php
                                    $qtd_evento = $evento->qtd;
                                    if($qtd_evento <= 0) { ?>
                                    <button  style="float: center;" class="btn btn-warning" disabled>Ingressos Insuficientes</button>
                               <?php } 
                               if ($evento->qtd > 0) { ?>
                                    <input type="hidden" name="id" value="<?= $evento->id?>">
                                    <button type="submit" name="finalizarCompra" style="float: center;" class="btn btn-danger">Finalizar Compra</button>
                              <?php } ?>
                            </div>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </section>


</body>
<?php 
    require_once 'footer.php';
?>
</html>