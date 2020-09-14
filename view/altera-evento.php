<html>
  <head>
    <?php
    require_once "header.php";
    require_once "../model/Evento.php";
    require_once "../model/EventoDAO.php";
    require_once '../model/CategoriaDAO.php';
    require_once '../model/EstruturaDAO.php';
    require_once '../controler/evento.php';
    ?>
  </head>

<?php 


//controler de evento está instanciando os DAO's !
$id = $_POST['id'];
$evento = $eventoDAO->find($id);
$categorias = $categoriaDAO->getAll($id);
$estruturas = $estruturaDAO->getAll($id);
$vetEventoCategoria = $eventoDAO->listaEventoCategoria($id);
$vetEventoEstrutura = $eventoDAO->listaEventoEstrutura($id);
// var_dump($vetEventoCategoria);

?>

  <div class="principal">
    <div class="container my-5">
      <div class="row">
          <div class="col-12 border bg-light">
           <font face="DancingScript" class="py-5 display-4">Alterar Evento</font>
            <div class="conteudo flex-container bg-light">
             
                <form action="../controler/evento.php" method="POST" name="formReg" id="formId" enctype="multipart/form-data">
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
                          echo "alo";
                          $checked = "checked";
                        }
                        else {
                          $checked = "";
                        } ?>

                      <input type="checkbox" name="categoria[]" value="<?=$categoria->id?>"<?=$checked?> ><?=$categoria->nome?><br>
                      <?php endforeach; ?>
                    </td> 
                    <td class="byeBorder">
                      
                    </td>

                    <td class="byeBorder">Estrutura<br>
                    
                      <?php foreach ($estruturas as $estrutura) : 

                      if (in_array($estrutura->id, $vetEventoEstrutura)) {
                          $checked = "checked";
                        }
                        else {
                          $checked = "";
                        } ?> 
                    
                        <input type="checkbox" name="estrutura[]" value="<?=$estrutura->id?>"<?=$checked?> ><?=$estrutura->nome?><br>
                      <?php endforeach; ?>
                    </td>

                  
                  </tr>
                    <td class="byeBorder">Foto:</td>
                    <td class="byeBorder"><input type="file" name="arquivo"></td>
                  
                    <input type="hidden" name="max_file_size" value="200000">
                    <td class="byeBorder"><input class="btn btn-success" type="submit" name="cadastrar" onsubmit="return validate();" value="Alterar"></td>
                    <td class="byeBorder"><a class="btn btn-primary" href="index.php">Voltar</a></td>
                  
                    
                  </table>
                </form>
              </div>  
      </div>          
    </div>
  </div>
</div>
<?php require_once 'footer.php' ?>
</html>

<?php 