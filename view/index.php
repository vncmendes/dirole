<!DOCTYPE html>
<html lang="en">

<head>
<?php 
  require_once "head.php";
  require_once '../controller/usuario.php';
  // require_once "../model/Evento.php";
  // require_once "../model/EventoDAO.php";
  // require_once '../controler/evento.php';
  // $eventos = $eventoDAO->getAll();
?>
</head>

<body>

<!-- HEADER -->
<header id="main-header">
  <div class="content1">
    <nav>
      <ul>
        <li>
          <a href="eventos.php" class="nodecore navlinks">Eventos</a>
        </li>
        <li>
          <a href="#" class="nodecore navlinks">Quem Somos</a>
        </li>
        <li>
          <a href="#" class="nodecore navlinks">O que fazemos?</a>
        </li>
      </ul>
    </nav>

    <!-- <img class="navicons" src="images/logo.svg" alt="" /> -->
    <h1><a class="dirole" href="index.php">DiRolê</a></h1>
    <div class="side">
      <div class="dropdown">
        <button class="btn dropdown-toggle dropbtnmod" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Criar Conta
        </button>
        <div class="dropdown-menu mydropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item mydrop-item" href="#" onclick="signUPB()">Baladeiro</a>
          <a class="dropdown-item mydrop-item" href="#" onclick="signUPP()">Produtor</a>
        </div>
      </div>
      <input type="text" placeholder="Procurar evento" />
      <!-- <img class="avatarlogo" src="/images/avatar.png" alt=""/> -->
      <a href="#" class="nodecore navlinks" id="btnlogin" onclick="modalLogin()">Entrar</a>
    </div>
  </div>
</header>
<!-- HEADER FIM -->

<!-- COMEÇO DO SLIDER -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <?php require_once 'signUPB.php' ?>
  <?php require_once 'signUPP.php' ?>
  <?php require_once 'modalLogin.php' ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="../js/functions.js"></script>

  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="../images/01.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../images/03.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../images/04.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- FIM SLIDER -->

<!-- CARDS EVENTS -->
<!-- <section class="eventcards">
  <span class="indexontherise">Em Alta</span>
  <div class="eventcardscontent">
  < ?php foreach ($eventos as $evento) :
    $registra_eventocategoria = $eventoDAO->listaEventoCategoria($evento->id);
    $registra_eventoestrutura = $eventoDAO->listaEventoEstrutura($evento->id);
  ?>
    <div class="cards">
      <a href="#">
        <ul>
          <div class="cardimage">
            <li><img src="../images/01.jpg" alt=""></li>
          </div>

          <div class="cardinfo">
            <li>
              <span class="eventname">Nome: < ?= $evento->nome ?> </span>
            </li>
            <li>
              <span class="eventdate">Data: < ?= $evento->data ?> </span>
            </li>
            <li>
              <span class="eventlocation">Local: < ?= $evento->localizacao ?> </span>
            </li>
          </div>
        </ul>
      </a>
    </div>
    < ?php endforeach ?>
</section> -->
<!-- CARDS EVENTS FIM -->

<section class="second-content">
  <div class="box-content1">
    <div class="ourservices">
      <span></span>
    </div>
    <div class="title1">
      <span>Nosso objetivo é ajudar os promotores a divulgar e gerenciar seus eventos de forma gratuita; e deixar</span>
    </div>
    <div class="title2">
      <span> os baladeiros por dentro dos principais acontecimentos que estão rolando na sua cidade.
      </span>
    </div>
    <div class="title2">
      <span>Com informações mais detalhadas e a possibilidade da venda dos ingressos pela plataforma conseguimos maximizar o valor gerado para ambos;
      </span>
    </div>
  <div class="title2">
    <span>e com isso se cria uma melhor experiência aos usuários e colaboradores envolvidos.
    </span>
  </div>
</div>
<div class="divsecond-content">
  <div class="d3">
    <ul>
      <li><img src="../images/felicidades.svg" alt="icon"></li>
      <li>
        <span>Cervejeiro</span>
      </li>
    </ul>
  </div>
  <div class="d3">
    <ul>
      <li><img src="../images/fogos-de-artificio.svg" alt="icon"></li>
      <li>
        <span>Shows</span>
      </li>
    </ul>
  </div>
  <div class="d3">
    <ul>
      <li><img src="../images/garfo.svg" alt="icon"></li>
      <li>
        <span>Gastronômico</span>
      </li>
    </ul>
  </div>
  <div class="d3">
    <ul>
      <li><img src="../images/danca.svg" alt="dance"></li>
      <li>
        <span>Pubs e Baladas</span>
      </li>
    </ul>
  </div>
</div>
<div class="d3">
  <ul>
    <li><img class="clientpresent" src="../images/presente.svg" alt="present"></li>
    <li>
      <span>Bônus Clientes Ativos</span>
    </li>
  </ul>
</div>
</section>

<!-- CONTATO -->
<section class="third-content">
  <div class="divcontact-content">
    <div class="d4">
      <h2>FALE CONOSCO</h2>
    </div>
    <div class="contact-form">
      <form class="form1" action="#" name="form">
        <fieldset>
          <label for="name"></label>
          <input type="text" name="name" pattern="" placeholder="DIGITE SEU NOME" required>
          <label for="email"></label>
          <input type="text" name="email" placeholder="DIGITE SEU E-MAIL" pattern="" required>
          <label for="name"></label>
          <textarea name="mesage" id="mesage" placeholder="ESCREVE UMA MENSAGEM" required></textarea>
          <label for="button"></label>
          <button name="btn" type="submit">Enviar</button>
        </fieldset>
      </form>
    </div>
  </div>
</section>
<!-- CONTATO FIM -->

<!-- RANK CONTENT -->
  <section class="rank-content">
    <div class="ourservicesrank">
      <span>SENHORES DA BALADA</span>
    </div>
    <div class="divrank-content">
      <div class="d3rank">
        <ul>
          <li><img src="../images/avatar.png" alt="icon"></li>
          <li>
            <span>Garça</span>
          </li>
        </ul>
      </div>
      <div class="d3rank">
        <ul>
          <li><img src="../images/avatar.png" alt="icon"></li>
          <li>
            <span>Manoel</span>
          </li>
        </ul>
      </div>
      <div class="d3rank">
        <ul>
          <li><img src="../images/avatar.png" alt="icon"></li>
          <li>
            <span>João</span>
          </li>
        </ul>
      </div>
      <div class="d3rank">
        <ul>
          <li><img src="../images/avatar.png" alt="icon"></li>
          <li>
            <span>Deadpool</span>
          </li>
        </ul>
      </div>
      <div class="d3rank">
        <ul>
          <li><img src="../images/avatar.png" alt="icon"></li>
          <li>
            <span>Usuário1</span>
          </li>
        </ul>
      </div>
    </div>
</section>
<!-- RANK CONTENT FIM -->

<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.5/sweetalert2.all.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
	<?php
//   	session_start();
    if (isset($_SESSION['emailErroMsg']) && $_SESSION['emailErroMsg'] == 1) {
    ?>
    	<script type="text/javascript">
            swal({
                type: 'error',
                title: 'Oops...',
                text: 'Este email já está em uso!',
                footer: 'Insira um email válido'
            });
        </script>
    <?php
    }
    if (isset($_SESSION['cadastroSucesso']) && $_SESSION['cadastroSucesso'] == 1) {
    ?>
       <script type="text/javascript">
            swal({
                type: 'sucess',
                title: 'Sucesso no cadastro.',
                text: 'Agora só falta iniciar a sessão!',
                footer: ''
            });
        </script> 
    <?php
    }
    if (isset($_SESSION['loginErroMsg']) && $_SESSION['loginErroMsg'] == 1) {
    ?>
    	<script type="text/javascript">
            swal({
                type: 'error',
                title: 'Oops...',
                text: 'Login ou senha errados!',
                footer: 'Tente outra vez'
            });
        </script>
    <?php
    }
    if (isset($_SESSION['cadastroErroMsg']) && $_SESSION['cadastroErroMsg'] == 1) {
    ?>
    	<script type="text/javascript">
            swal({
                type: 'error',
                title: 'Oops...',
                text: 'As senhas não correspondem!',
                footer: 'Tente outra vez'
            });
        </script>
    <?php
    }
    ?>
    </script>

  <!-- < ?php require_once  '../controller/usuario.php' ?>
  < ?php require_once  '../controller/provider.php' ?> -->

  <?php require_once 'footer.php' ?>

</body>

</html>