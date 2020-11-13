<?php
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
    $vetEventoEstrutura = $eventos->listaEventoEstrutura($id); 
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
                                    <li class="">Ingresso: <?=$evento->ingresso?></li>
                                    <li class="">Guarda-Volumes</li>
                                    <li class=""><input  type="radio" value="1"  name="gv"<?=$sim?>>Sim</li>
                                    <li class=""><input type="radio" value="0"  name="gv"<?=$nao?>>Não</li>
                                
                                    <div class="singleEstCat">
                                        <li>Categoria<br>
                                            <?php foreach ($categorias as $categoria) :
                                                if (in_array($categoria->id, $vetEventoCategoria)) {
                                                    $checked = "checked";
                                                }
                                                else {
                                                    $checked = "";
                                                } ?>
                                                <?=$checked?> <?=$categoria->nome?><br>
                                            <?php endforeach; ?>
                                        </li> 
                                        <li>Estrutura<br>
                                                <?php foreach ($estruturas as $estrutura) :
                                                if (in_array($estrutura->id, $vetEventoEstrutura)) {
                                                    $checked = "checked";
                                                }
                                                else {
                                                    $checked = "";
                                                } ?> 
                                                <?=$checked?> <?=$estrutura->nome?><br>
                                            <?php endforeach; ?>
                                        </li>
                                    </div>  
                        </div>
                    </ul>
             </div>
            </div>
        </div>
    </section>
    


      <!-- <div class="principal">
        <div class="container my-5">
          <div class="row">
              <div class="col-12 border bg-light">
              <font face="DancingScript" class="py-5 display-4">Evento Escolhido</font>
                <div class="conteudo flex-container bg-light">
                
                  <form action="../controller/evento.php" method="POST" name="formReg" id="formId" enctype="multipart/form-data">
                  <table class="table mx-5 py-5">
                  <tr>
                    <td class="byeBorder">Nome do Evento:</td>
                    <td class="byeBorder"><input class="form-control " type="text" name="nome" value="<?=$evento->nome?>"></td>
                  </tr>
                  <tr>
                    <td class="byeBorder">Data:</td>
                    <td class="byeBorder"><input class="form-control" type="date" name="data" value="<?=$evento->data?>"></td>
                  </tr>
                  <tr>
                    <td class="byeBorder">Hora Inicial:</td>
                    <td class="byeBorder"><input class="form-control" type="time" name="horai" value="<?=$evento->horainicial?>"></td>
                  </tr>
                  <tr>
                    <td class="byeBorder">Hora Final:</td>
                    <td class="byeBorder"><input class="form-control" type="time" name="horaf" value="<?=$evento->horafinal?>"></td>
                  </tr>
                  <tr>
                    <td class="byeBorder">Localização:</td>
                    <td class="byeBorder"><input class="form-control" type="text" name="localizacao" value="<?=$evento->localizacao?>"></td>
                  </tr>
                  <tr>
                    <td class="byeBorder">Descrição:</td>
                    <td class="byeBorder"><textarea class="form-control" name="descricao"><?=$evento->descricao?></textarea></td>
                  </tr>
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
                  <tr>
                    <td class="byeBorder">Guarda-Volumes</td>
                    <td class="byeBorder"><input  type="radio" value="1"  name="gv"<?=$sim?>>Sim</td>
                    <td class="byeBorder"><input type="radio" value="0"  name="gv"<?=$nao?>>Não</td>
                  </tr>
                  <tr>
                    <td class="byeBorder">Ingresso:</td>
                    <td class="byeBorder"><input class="form-control" type="number" name="ingresso" value="<?=$evento->ingresso?>"></td>
                  </tr>
                    <tr>
                      <td class="byeBorder" id="ce">Categoria<br>
                        <?php foreach ($categorias as $categoria) :
                          if (in_array($categoria->id, $vetEventoCategoria)) {
                            $checked = "checked";
                          }
                          else {
                            $checked = "";
                          } ?>

                        <input type="checkbox" name="categoria[]" value="<?=$categoria->id?>" <?=$checked?>> <?=$categoria->nome?><br>
                        <?php endforeach; ?>
                      </td> 
                      <td class="byeBorder"></td>

                      <td class="byeBorder">Estrutura<br>
                        <?php foreach ($estruturas as $estrutura) :
                        if (in_array($estrutura->id, $vetEventoEstrutura)) {
                            $checked = "checked";
                          }
                          else {
                            $checked = "";
                          } ?> 

                          <input type="checkbox" name="estrutura[]" value="<?=$estrutura->id?>" <?=$checked?>> <?=$estrutura->nome?><br>
                          
                        <?php endforeach; ?>
                      </td>
                    </tr>
                      <td class="byeBorder"><a class="btn btn-primary" href="eventos.php">Voltar</a></td>
                    </table>
                  </form>
              </div>
          </div>     
        </div>
      </div> -->

<!-- 
    <div class="break">
        <li style="padding: 3% 5% 0 0">
            <form action="evento.php" method="post">
                <input type="hidden" name="id" value="<?= $evento->id ?>">
                <button class="btn btn-primary" type="submit" name="alterar">Alterar</button>
            </form>
        </li>
    </div> 
-->
  </body>
<?php require_once 'footer.php' ?>
</html>