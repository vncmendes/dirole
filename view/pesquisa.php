<?php
    session_start();
    require_once "../model/Evento.php";
    require_once '../model/Categoria.php';
    require_once '../model/Estrutura.php';
    require_once '../controller/evento.php';
    //controler de evento está instanciando os DAO's !
    $categorias = $categoria->selectAll();
    $estruturas = $estrutura->selectAll();
    // $vetEventoCategoria = $eventos->listaEventoCategoria($id);
    // $vetEventoEstrutura = $eventos->listaEventoEstrutura($id);
  // var_dump($vetEventoCategoria);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once 'head.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        <?php
            require_once 'navbar2.php';
            require_once '../model/Conexao.php';

            if(isset($_POST['pesquisar'])) {
                $search = $_POST['pesquisar'];
                $sqlEvento = "SELECT * FROM EVENTOS WHERE nome LIKE '%$search%' LIMIT 6";
                $result = mysqli_query($conn, $sqlEvento); ?>
            
                <section class="eventcards">
                    <div class="eventcardscontent">
                   <?php while($resultEventos = mysqli_fetch_array($result)) { ?>
                        <div class="cards">
                            <form action="evento.php" method="post">
                                <input type="hidden" name="id" value="<?= $resultEventos['id'] ?>">
                                <button class="" type="hidden" name="ver">
                                <a href="#">
                                    <ul>
                                        <div class="cardimage">
                                            <!-- <li><img src="/images/< ?= $evento->arquivo ?>"></li> // mais ou menos certo -->
                                            <li><img src="images/01.jpg" alt=""></li>
                                        </div>
                                        <div class="cardinfo">
                                            <li>
                                                <span class="eventname"> <?= $resultEventos['nome'] ?> </span>
                                            </li>
                                            <li>
                                                <span class="eventdate"> <?= $resultEventos['data'] ?> </span>
                                            </li>
                                            <li>
                                                <span class="eventlocation"> <?= $resultEventos['localizacao'] ?> </span>
                                            </li>
                                        </div>
                                    </ul>
                                </a>
                            </button>
                            </form>
                        </div>
                    <?php } ?>
                </section> 
        <?php } ?>

        <?php if(array_key_exists("estaSemana", $_GET)) {
            $searchS = $_GET['estaSemana'];
            if($searchS == 'semana') {
                $sqlEventoS = "SELECT * FROM eventos WHERE data BETWEEN CURDATE() and CURDATE() + 7";
                $resultS = mysqli_query($conn, $sqlEventoS); ?>
        
                <section class="eventcards">
                    <div class="eventcardscontent">
                   <?php while($resultEventosS = mysqli_fetch_array($resultS)) { ?>
                        <div class="cards">
                            <form action="evento.php" method="post">
                                <input type="hidden" name="id" value="< ?= $resultEventosS['id'] ?>">
                                <button class="" type="hidden" name="ver">
                                <a href="#">
                                    <ul>
                                        <div class="cardimage">
                                            <li><img src="/images/< ?= $evento->arquivo ?>"></li>
                                            <li><img src="images/01.jpg" alt=""></li>
                                        </div>
                                        <div class="cardinfo">
                                            <li>
                                                <span class="eventname"> <?= $resultEventosS['nome'] ?> </span>
                                            </li>
                                            <li>
                                                <span class="eventdate"> <?= $resultEventosS['data'] ?> </span>
                                            </li>
                                            <li>
                                                <span class="eventlocation"> <?= $resultEventosS['localizacao'] ?> </span>
                                            </li>
                                        </div>
                                    </ul>
                                </a>
                            </button>
                            </form>
                        </div>
                    <?php } ?>
                </section> 
            <?php } ?>
        <?php } ?>

         <!-- < ?php if(array_key_exists("categorias", $_GET)) {
            $searchC = $_GET['categorias'];
            if($searchC == 1) {
                $sqlEventoC = "SELECT EVENTOS.NOME FROM EVENTOS, registra_eventocategoria rec, CATEGORIA c where EVENTOS.id = rec.idevento and c.nome like '%$searchC%'";
                $resultC = mysqli_query($conn, $sqlEventoC); ?>
        
                <section class="eventcards">
                    <div class="eventcardscontent">
                    colocar as divs com os nomes das categorias e as imagens para linkar lá -->
                <!-- < /section> 
            < ?php } ?>
        < ?php } ?> -->
        
        <?php require_once 'footer.php'; ?>
        
    </body>
</html>







      
