<?php
    require_once '../controller/usuario.php';
    require_once '../controller/provider.php';
?>

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
    <title>Recuperação de senha</title>
    </script>
</head>
<body>
<header id="main1-header">
  <div class="content2">
    <nav>
      <ul>
        <li>
          <a href="eventos.php" class="nodecore1 navlinks1">Eventos</a>
        </li>
      </ul>
    </nav>

    <!-- <img class="navicons" src="images/logo.svg" alt="" /> -->
    <div>
      <h1><a class="dirole1" href="index.php">DiRolê</a></h1>
    </div>

    <div class="side1">
      <form style="margin: 0"; method="POST" action="pesquisa.php">
        <input type="text" name="pesquisar" onKeyPress="return goSearch(this, event)" placeholder="Procurar Evento" />
      </form>
      <?php if(isset($_SESSION['logado'])) { ?>
        <a href="logout.php" class="nodecore1 navlinks1">Sair</a>
      <?php } ?>
    </div>
  </div>
</header>
    
<section class="containerMaster py-5">
    <div class="container-fluid">          
        <div class="row my-2 d-flex justify-content-center">                           
            <div class="col-sm-8 px-2 py-2">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-sm-12 mx-1 my-2">
                            <h3 class="text-center">Recuperação de senha.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mx-0 my-2">
                            <h5 class="text-center">Para você receber sua nova senha, insira o seu email cadastrado.</h5>
                        </div>
                    </div>
                    <div class="row my-2 mx-1">
                        <div class="col-sm-12 text-center">
                            <form method="POST" class="form-group" action="recuperarsenha.php">
                                <input class="form-control " type="email" name="email" placeholder="Insira seu email para a recuperação de senha">
                              <button class="text-center form-control btn btn-success my-2" id="enviar" name="recuperarsenha" type="submit">Enviar</button>          
                                <div class="g-recaptcha" data-theme="dark" data-sitekey="<?php echo $siteKey;?>"></div>
                            </form>
                        </div>
                    </div>
                    <div class="row my-2 mx-2">
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mx-1 my-2">
                            <h5 class="alert alert-warning text-center">Depois de enviar, verifique sua caixa de mensagens ou sua caixa de spam no seu email.</h5>
                        </div>
                    </div>   
                </div>
            </div>
        </div> <!-- Fim row -->
    </div>     
</section>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.5/sweetalert2.all.min.js"></script>
<!---========================= FOOTER ============================================== -->
<?php require_once 'footer.php'; ?>