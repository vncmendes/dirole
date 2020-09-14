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

<!-- Begin of slider -->
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