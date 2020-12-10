<?php
    session_start();
    require_once "../model/Evento.php";
    require_once '../model/Categoria.php';
    require_once '../model/Estrutura.php';
    require_once '../controller/evento.php';
    
    //controler de evento está instanciando os DAO's !
    $id = $_POST['id'];
    $evento = $eventos->find($id);
    $categorias = $categoria->selectAll($id);
    $estruturas = $estrutura->selectAll($id); 

    $vetEventoCategoria = $eventos->listaEventoCategoria($id);
    foreach ($vetEventoCategoria as $key => $value) {
      $vetUsadas[] = $value->idcategoria;
    }

    $vetEventoEstrutura = $eventos->listaEventoEstrutura($id);
    foreach ($vetEventoEstrutura as $key => $value) {
      $vetEstUsadas[] = $value->idestrutura;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
     require_once 'head.php'; 
    ?>
</head>

<body>
   <?php require_once 'navbar2.php' ?>
    
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
                            <li><b>Data</b>: <?=$evento->data?></li>
                            <li><b>Hora Inicial</b>: <?=$evento->horainicial?></li>
                            <li><b>Hora Final</b>: <?=$evento->horafinal?></li>
                            <li><b>Localização</b>: <?=$evento->localizacao?></li>
                            <li><b>Descrição</b>: <?=$evento->descricao?></li>
                            <li><b>Valor</b>: <?=$evento->ingresso . " Reais"?></li>
                            <?php   
                                if($evento->gv == 0)  {       
                                    $sim="";
                                    $nao="checked";
                                    }
                                else {
                                    $sim="checked";
                                    $nao="";
                                    } 
                                ?>
                                    <li><b>Guarda-Volumes</b></li>
                                    <li><input  type="radio" value="1"  name="gv"<?=$sim?>>Sim <input type="radio" value="0"  name="gv"<?=$nao?>>Não</li>
                                
                                    <div class="singleEstCat">
                                        <li><b>Categorias</b><br>
                                            <?php foreach ($categorias as $categoria) :
                                                if (in_array($categoria->id, $vetUsadas)) {
                                                    $checked = $categoria->nome . "<br>";
                                                }
                                                else {
                                                    $checked = "";
                                                } ?>
                                                <?=$checked?>
                                            <?php endforeach; ?>
                                        </li> 
                                        <li><b>Estrutura</b><br>
                                                <?php foreach ($estruturas as $estrutura) :
                                                if (in_array($estrutura->id, $vetEstUsadas)) {
                                                    $checked = $estrutura->nome . "<br>";
                                                }
                                                else {
                                                    $checked = "";
                                                } ?> 
                                                <?=$checked?>
                                            <?php endforeach; ?>
                                        </li>
                                    </div>  
                        </div>
                                    <div style="display: flex; justify-content: center; padding-top: 5%;">
                                        <form action="compra.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $evento->id?>">
                                            <button type="submit" name="comprar" style="float: center;" class="btn btn-danger">Comprar</button>
                                        </form>
                                    </div>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
  </body>
<?php require_once 'footer.php' ?>
</html>