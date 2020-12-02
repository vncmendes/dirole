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

            if(isset($_GET['pesquisar'])) {
                $search = $_GET['pesquisar'];
                $sqlEvento = "SELECT * FROM eventos WHERE nome LIKE '%$search%' LIMIT 6";
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

    <?php
        if(isset($_GET['categoria'])) {
                $search = $_GET['categoria'];
                $sqlEvento = "select * from eventos e, registra_eventocategoria rec where e.id = rec.idevento and rec.idcategoria = '$search'";
                $result = mysqli_query($conn, $sqlEvento); ?>
            
                <section class="eventcards">
                    <div class="eventcardscontent">
                   <?php while($resultEventos = mysqli_fetch_array($result)) { ?>
                        <div class="cards">
                            <form action="evento.php" method="post">
                                <input type="hidden" name="id" value="<?= $resultEventos['id']?>">
                                <button class="" type="hidden" name="ver">
                                <a href="#">
                                    <ul>
                                        <div class="cardimage">
                                            <!-- <li><img src="/images/< ?= $evento->arquivo ?>"></li> // mais ou menos certo -->
                                            <li><img src="images/<?=$resultEventos['arquivo']?>" alt=""></li>
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

        <?php
        if(isset($_GET['estrutura'])) {
                $search = $_GET['estrutura'];
                $sqlEvento = "select * from eventos e, registra_eventoestrutura ree where e.id = ree.idevento and ree.idestrutura = '$search'";
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
                                            <li><img src="images/<?=$resultEventos['arquivo']?>" alt=""></li>
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

        <?php if(array_key_exists("semana", $_GET)) {
            $searchS = $_GET['semana'];
            if($searchS == 1) {
                $sqlEventoS = "SELECT * FROM eventos WHERE data BETWEEN CURDATE() and CURDATE() + 7";
            }
            elseif ($searchS == 2) {
                $sqlEventoS = "SELECT * FROM eventos WHERE data BETWEEN CURDATE() and CURDATE() + 14";
            }
            elseif ($searchS == 3) {
                $sqlEventoS = "SELECT * FROM eventos WHERE data BETWEEN CURDATE() and CURDATE() + 21";
            }
            elseif ($searchS == 4) {
                $sqlEventoS = "SELECT * FROM eventos WHERE data BETWEEN CURDATE() and CURDATE() + 28";
            }
                $resultS = mysqli_query($conn, $sqlEventoS); ?>
        
                <section class="eventcards">
                    <div class="eventcardscontent">
                   <?php while($resultEventosS = mysqli_fetch_array($resultS)) { ?>
                        <div class="cards">
                            <form action="evento.php" method="post">
                                <input type="hidden" name="id" value="<?= $resultEventosS['id'] ?>">
                                <button class="" type="hidden" name="ver">
                                <a href="#">
                                    <ul>
                                        <div class="cardimage">
                                            <li><img src="images/<?= $resultEventosS['arquivo'] ?>"></li>
                                            <!-- <li><img src="images/01.jpg" alt=""></li> -->
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
        <?php require_once 'footer.php'; ?>
    </body>
</html>







      
