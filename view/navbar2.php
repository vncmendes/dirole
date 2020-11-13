<header id="main1-header">
  <div class="content2">
    <nav>
      <ul>
        <li>
          <a href="eventos.php" class="nodecore1 navlinks1">Eventos</a>
        </li>
        <li>
            <a href="adiciona-evento.php" class="nodecore1 navlinks1">Add Evento</a>
        </li>
        <li>
            <a href="lista-evento.php" class="nodecore1 navlinks1">Meus Evento</a>
        </li>
        <?php if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 0) { ?>
          <li>
            <a href="perfil.php" class="nodecore1 navlinks1">Perfil</a>
          </li>
        <?php } 
              else { ?>
                <li>
                  <a href="perfilP.php" class="nodecore1 navlinks1">Perfil</a>
                </li>
        <?php } ?>
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
      <input type="text" placeholder="Procurar evento" />
      <?php if(isset($_SESSION['logado'])) { ?>
        <a href="logout.php" class="nodecore1 navlinks1">Sair</a>
      <?php } ?>
    </div>
  </div>
</header>