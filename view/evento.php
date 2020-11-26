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
                            <li style="list-style: none;"><img src="images/01.jpg" alt=""></li>
                </div>
                <div class="singleCard">
                    <ul>
                        <div class="singleInfos"> 
                            <li>Nome do Evento: <?=$evento->nome?></li>
                            <li>Data: <?=$evento->data?></li>
                            <li>Hora Inicial: <?=$evento->horainicial?></li>
                            <li>Hora Final: <?=$evento->horafinal?></li>
                            <li>Localização: <?=$evento->localizacao?></li>
                            <li>Descrição: <?=$evento->descricao?></li>
                            <li>Ingresso: <?=$evento->ingresso?></li>
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
                                    <li>Guarda-Volumes</li>
                                    <li><input  type="radio" value="1"  name="gv"<?=$sim?>>Sim</li>
                                    <li><input type="radio" value="0"  name="gv"<?=$nao?>>Não</li>
                                
                                    <div class="singleEstCat">
                                        <li>Categoria<br>
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
                                        <li>Estrutura<br>
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
                    </ul>
             </div>
            </div>
        </div>
    </section>
    
  </body>
<?php require_once 'footer.php' ?>
</html>