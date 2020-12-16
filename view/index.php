<?php
if (!isset($_SESSION['logado'])) {
  session_start();
}
require_once "../model/Evento.php";
require_once '../controller/evento.php';
require_once '../controller/usuario.php';
require_once '../controller/provider.php';
require_once '../controller/adm.php';

$todosEventos = $eventos->selectAllLimited();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php
  require_once "head.php"; //tirei deu ruim em alguns lugares
  ?>
</head>

<body>

  <!-- HEADER -->
  <header id="main-header">
    <div class="content1">
      <nav class="navlink">
        <ul>
          <li>
            <a href="eventos.php" class="nodecore navlinks">Eventos</a>
          </li>
          <li>
            <a href="#somos" class="nodecore navlinks">Quem Somos</a>
          </li>
          <li>
            <a href="#faleconosco" class="nodecore navlinks">Fale Conosco</a>
          </li>
        </ul>
      </nav>

      <!-- <img class="navicons" src="images/logo.svg" alt="" /> -->
      <h1><a class="dirole" href="index.php">DiRolê<br>
          <h5 style="float: right;">Na Galaxya <img src="images/irmao.png" alt=""></h5>
        </a></h1>
      <div class="side">
        <div class="dropdown">
          <button class="btn dropdown-toggle dropbtnmod" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Criar Conta
          </button>
          <div class="dropdown-menu mydropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item mydrop-item" href="#" onclick="signUPB()">Baladeiro</a>
            <a class="dropdown-item mydrop-item" href="#" onclick="signUPP()">Produtora</a>
          </div>
        </div>

        <!-- @@@@@@@@@@@@@@@@@ FUNCIONANDO A PESQUISA PELA SEMANA @@@@@@@@@@@@@ -->
        <!-- SÓ PRECISA VERIFICAR COMO FAZER PRA CONSEGUIR ENVIAR A PESQUISA E OS GETS OU FAZER COM POST -->

        <!-- <div class="dropdown"> -->
        <!-- <form> -->
        <!-- <input autocomplete="off" class="btn dropdown-toggle dropbtnmod" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="categorias" onKeyPress="return goSearch(this, event)" placeholder="Procurar Evento" /> -->
        <!-- <input type="hidden" name="categorias"> -->

        <!-- <div class="dropdown-menu mydropdown-menu" aria-labelledby="dropdownMenuButton"> -->
        <!-- <a class="dropdown-item mydrop-item" name="estaSemana" href="pesquisa.php?estaSemana=semana" onclick="">Esta Semana</a> -->
        <!-- <a class="dropdown-item mydrop-item" name="categorias" href="pesquisa.php?categorias=1" onclick="">Por Categoria</a> -->
        <!-- </div> -->
        <!-- </form> -->
        <!-- </div> -->

        <!-- @@@@@@@@@@@@@@@@@ FUNCIONANDO A PESQUISA PELA SEMANA @@@@@@@@@@@@@ -->
        <!-- SÓ PRECISA VERIFICAR COMO FAZER PRA CONSEGUIR ENVIAR A PESQUISA E OS GETS OU FAZER COM POST -->

        <form method="GET" action="pesquisa.php?pesquisa">
          <input type="text" name="pesquisar" onKeyPress="return goSearch(this, event)" placeholder="Procurar Evento" />
          <input type="hidden" name="id">
        </form>
        <?php if (!isset($_SESSION['logado'])) { ?>
          <div class="dropdown">
            <button class="btn dropdown-toggle dropbtnmod" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Entrar
            </button>
            <div class="dropdown-menu mydropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item mydrop-item" href="#" onclick="modalLogin()">Baladeira</a>
              <a class="dropdown-item mydrop-item" href="#" onclick="modalLoginP()">Produtor</a>
              <a class="dropdown-item mydrop-item" href="#" onclick="modalLoginAdm()">Adm</a>
            </div>
          <?php } ?>
          </div>
          <?php if (isset($_SESSION['id_usuario']) || isset($_SESSION['id_provider']) || isset($_SESSION['id_adm'])) { ?>
            <a href="logout.php" class="nodecore1 navlinks1" id="sair" style="display: inline">Sair</a>
          <?php } ?>
      </div>
    </div>
  </header>
  <!-- HEADER FIM -->

  <!-- COMEÇO DO SLIDER -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <?php require_once 'signUPB.php' ?>
    <?php require_once 'signUPP.php' ?>
    <?php require_once 'modalLogin.php' ?>
    <?php require_once 'modalLoginP.php' ?>
    <?php require_once 'modalLoginAdm.php' ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/functions.js"></script>

    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      <!-- <li data-target="#carouselExampleIndicators" data-slide-to=""></li> -->
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="images/bgblack6.png" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="images/03.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="images/04.jpg" alt="Third slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="images/022.jpg" alt="Third slide">
      </div>

      <!-- <div class="carousel-item">
      <img class="d-block w-100" src="images/dentedepelao.jpg" alt="Forth slide">
    </div> -->
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
  <section class="eventcards">
    <span class="indexontherise">Em Alta</span>
    <div class="eventcardscontent">
      <?php foreach ($todosEventos as $evento) :
        // $registra_eventocategoria = $evento->listaEventoCategoria($evento->id);
        // $registra_eventoestrutura = $evento->listaEventoEstrutura($evento->id);
      ?>
        <div class="cards">
          <form action="evento.php" method="post">
            <input type="hidden" name="id" value="<?= $evento->id ?>">
            <button class="" type="hidden" name="ver">
              <a href="#">
                <ul>
                  <div class="cardimage">
                    <!-- <li><img src="/images/< ?= $evento->arquivo ?>"></li> // mais ou menos certo -->
                    <li><img src="images/<?= $evento->arquivo ?>" width="200px" height="200px" alt=""></li>
                  </div>
                  <div class="cardinfo">
                    <li>
                      <span class="eventname"> <?= $evento->nome ?> </span>
                    </li>
                    <li>
                      <?php $dataOK = date_create($evento->data) ?>
                      <span class="eventdate"> <?= date_format($dataOK, "d/m/Y") ?></span>
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
  <!-- CARDS EVENTS FIM -->

  <section id="somos" class="second-content">
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
          <a href="pesquisa.php?categoria=3">
            <li><img src="images/felicidades.svg" alt="icon"></li>
            <li><a>Cervejeiro</a></li>
          </a>
        </ul>
      </div>

      <div class="d3">
        <ul>
          <a href="pesquisa.php?categoria=11">
            <li><img src="images/garfo.svg" alt="icon"></li>
            <li><a>Gastronômico</a></li>
          </a>
        </ul>
      </div>

      <div class="d3">
        <ul>
          <a href="pesquisa.php?estrutura=10">
            <li><img src="images/fogos-de-artificio.svg" alt="icon"></li>
            <li><a>Shows</a></li>
          </a>
        </ul>
      </div>

      <div class="d3">
        <ul>
          <a href="pesquisa.php?estrutura=4">
            <li><img src="images/fogos-de-artificio.svg" alt="icon"></li>
            <li><a>Pubs e Baladas</a></li>
          </a>
        </ul>
      </div>
    </div>

    <div class="d3">
      <ul>
        <a href="#">
          <li><img class="clientpresent" src="images/presente.svg" alt="present"></li>
          <li><a>Bônus Clientes Ativos</a></li>
        </a>
      </ul>
    </div>
  </section>

  <!-- CONTATO -->
  <section id="faleconosco" class="third-content">
    <div class="divcontact-content">
      <div class="d4">
        <h2>FALE CONOSCO</h2>
      </div>
      <div class="contact-form">
        <form class="form1" method="POST" action="contato.php" name="form">
          <fieldset>
            <label for="name"></label>
            <input type="text" name="name" pattern=".{3,}" placeholder="DIGITE SEU NOME" required>

            <label for="email"></label>
            <input type="text" name="email" placeholder="DIGITE SEU E-MAIL" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>

            <label for="subject"></label>
            <input type="text" name="subject" pattern=".{3,}" placeholder="DIGITE O ASSUNTO" required>

            <textarea name="msg" id="mesage" placeholder="ESCREVA UMA MENSAGEM" required></textarea>
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
      <span>Sempre DiRolê</span>
    </div>
    <div class="divrank-content">
      <div class="d3rank">
        <ul>
          <li><img src="images/avatar.png" alt="icon"></li>
          <li>
            <span>Garça</span>
          </li>
        </ul>
      </div>
      <div class="d3rank">
        <ul>
          <li><img src="images/avatar.png" alt="icon"></li>
          <li>
            <span>Manoel</span>
          </li>
        </ul>
      </div>
      <div class="d3rank">
        <ul>
          <li><img src="images/avatar.png" alt="icon"></li>
          <li>
            <span>João</span>
          </li>
        </ul>
      </div>
      <div class="d3rank">
        <ul>
          <li><img src="images/avatar.png" alt="icon"></li>
          <li>
            <span>Deadpool</span>
          </li>
        </ul>
      </div>
      <div class="d3rank">
        <ul>
          <li><img src="images/avatar.png" alt="icon"></li>
          <li>
            <span>Usuário1</span>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- RANK CONTENT FIM -->


  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.5/sweetalert2.all.min.js"></script>

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