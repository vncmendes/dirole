<?php
  session_start();
  require_once "../model/Evento.php";
  require_once "../model/EventoDAO.php";
  require_once '../controller/evento.php';
  require_once '../controller/usuario.php';
  require_once '../controller/provider.php';

  if(!isset($_SESSION['logado'])) {
        session_destroy();
        @header("location: index.php");
  } 

  if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 0){
    $nav = "<li>
                <a href='#' class='nodecore1 navlinks1'>Tickets e Pontos</a>
            </li>
            <li>
                <a href='perfil.php' class='nodecore1 navlinks1'>Perfil</a>
            </li>
            ";
  }

  if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1) {
    $nav = "<li>
                <a href='adiciona-evento.php' class='nodecore1 navlinks1'>Add Evento</a>
            </li>
            <li>
                <a href='lista-evento.php' class='nodecore1 navlinks1'>Meus Evento</a>
            </li>
            <li>
                <a href='perfilP.php' class='nodecore1 navlinks1'>Perfil</a>
            </li>
            ";
  }

  if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1000) {
    $nav = "<li>
                <a href='adiciona-evento.php' class='nodecore1 navlinks1'>Add Evento</a>
            </li>
            <li>
                <a href='lista-evento.php' class='nodecore1 navlinks1'>Todos Eventos</a>
            </li>
            <li> 
                <a href='lista-usuario.php' class='nodecore1 navlinks1'>Lista Usuários</a>
            </li>
            <li>
                <a href='perfilAdm.php' class='nodecore1 navlinks1'>Perfil</a>
            </li>
            ";
  }

    $todosEventos = $eventos->selectAll();
    
  ?>
  <!-- < ?php var_dump($eventos) ?> -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.css" />
  <script src="js/bootstrap.js"></script>
  <link rel="stylesheet" href="css/styles.css" />
  <script src="js/functions.js"></script>

  <title>DiRolê Eventos</title>
</head>

<body>
<header id="main1-header">
  <div class="content2">
    <nav>
      <ul>
        <!-- <li>
          <a href="eventos.php" class="nodecore1 navlinks1">Eventos</a>
        </li> -->
        <?php if(isset($nav)) { echo $nav; }; ?>
      </ul>
    </nav>

    <!-- <img class="navicons" src="images/logo.svg" alt="" /> -->
    <div>
      <h1><a class="dirole1" href="index.php">DiRolê</a></h1>
    </div>

    <div class="side1">
      
      <?php if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 0) { ?>
        <a href="perfil.php">
          <img class="avatarlogo1" src="<?php echo $_SESSION['foto']; ?>">
        </a>
      <?php } ?>
        
      <?php if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1) { ?>
        <a href="perfilP.php">
          <img class="avatarlogo1" src="<?php echo $_SESSION['foto']; ?>">
        </a>
      <?php } ?>
      
      <?php if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1000) { ?>
        <a href="perfilAdm.php">
          <img class="avatarlogo1" src="<?php echo $_SESSION['foto']; ?>">
        </a>
      <?php } ?>
      
      <form style="margin: 0"; method="POST" action="pesquisa.php">
        <input type="text" name="pesquisar" onKeyPress="return goSearch(this, event)" placeholder="Procurar Evento" />
      </form>
      <?php if(isset($_SESSION['logado'])) { ?>
        <a href="logout.php" class="nodecore1 navlinks1">Sair</a>
      <?php } ?>
    </div>
  </div>
</header>

 <section class="eventcards">
  <div class="eventcardscontent">
    <?php foreach ($todosEventos as $evento) :
      $registra_eventocategoria = $eventos->listaEventoCategoria($evento->id);
      $registra_eventoestrutura = $eventos->listaEventoEstrutura($evento->id);
    ?>
  
    <div class="cards">
      <form action="evento.php" method="post">
        <input type="hidden" name="id" value="<?= $evento->id ?>">
        <button id="cardSingle" type="hidden" name="ver">
          <a href="#">
            <ul>
              <div class="cardimage">
                <!-- <li><img src="/images/< ?= $evento->arquivo ?>"></li> // mais ou menos certo -->
                <li><img src="images/01.jpg" alt=""></li>
              </div>
              <div class="cardinfo">
                <li>
                  <span class="eventname"> <?= $evento->nome ?> </span>
                </li>
                <li>
                  <span class="eventdate"> <?= $evento->data ?> </span>
                </li>
                <li>
                  <span class="eventlocation"> <?= $evento->localizacao ?> </span>
                </li>
              </div>
            </ul>
          </a>
      </button>
      </form>
    </div>
    <?php endforeach ?>
  </section>

  <?php
    require_once 'eventsecond-content.php';
  ?>

<script src="js/functions.js"></script>

  <?php
  require_once '../controller/usuario.php'; ?>
  <?php require_once 'footer.php'; ?>
</body>

</html>