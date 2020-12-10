
<?php
    session_start();
    require_once'../controller/usuario.php';
    require_once'../controller/provider.php';
    // require_once'../controller/controlador5.php';
      if(!isset ($_SESSION['logado']))
      {
        session_destroy();
        header("location: index.php");
      }
      if(isset ($_SESSION['logado']) && isset($_SESSION['id_provider'])) {
        session_destroy();
        header("location: index.php");
      }
      if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 0){
        $nav = "<li>
                    <a href='#' class='nodecore1 navlinks1'>Tickets e Pontos</a>
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

    @$id_usuario = $_SESSION['id_usuario'];
    // @$id_usuario = $_POST['id_usuario_adm'];
    $usuario_retorno = $usuario->select($id_usuario);
  
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
        <title>Perfil</title>
    </head>
    <body>
    <header id="main1-header">
    <div class="content2">
        <nav>
        <ul>
            <li>
            <a href="eventos.php" class="nodecore1 navlinks1">Eventos</a>
            </li>
            <?php if (isset($nav)) { echo $nav; }; ?>
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
            <?php if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1000) { ?>
                <a href="perfilAdm.php">
                    <img class="avatarlogo1" src="<?php echo $_SESSION['foto']; ?>">
                </a>
            <?php } ?>
            <form style="margin: 0"; method="POST" action="pesquisa.php">
                <input type="text" name="pesquisar" onKeyPress="return goSearch(this, event)" placeholder="Procurar Evento" />
            </form>
        <a href="logout.php" class="nodecore1 navlinks1">Sair</a>
        </div>
    </div>
    </header>
       
    <section class="containerMaster py-5">
        <main class="heightFixo">
           <div class="container-fluid">
               <div class="row my-2">
                   <div class="col">
                       <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-4 px-2 py-2">
                                    <div class="container text-center">
                                        <h4 class="mx-5 text-center">Altere sua foto de perfil.</h4>
                                        <p><img src="<?php echo $_SESSION['foto']; ?>" alt="imagem de perfil"  class="img-fluid imagem-responsiva rounded-circle border border-dark mx-3 my-2" width="80%"></p>
                                        <br><br>
                                        <form class="formularioUpload form-group my-2 my-lg-0 ml-auto" enctype="multipart/form-data" method="POST" id="formularioUpload" name="formulario" action="perfil.php">
                                            <input class="form-control my-2" type="file" name="foto" required="required">
                                            <button id="upload" class="btn btn-secondary form-control btn-sm my-2 my-sm-0" name="upload" type="submit">Enviar</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-4 px-2 py-2">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <h4 class="mx-5 text-center">Alteração dos dados cadastrais</h4>
                                            </div>
                                        </div>
                                       <!-- <div class="row">
                                            <div class="col">
                                                <p>Nivel de usuário: <?php //echo $_SESSION['nivel']; ?> </p>
                                            </div>
                                        </div>-->
                                        <div class="row">
                                            <div class="col">
                                        <!-- < ?php //foreach ($usuario->select($id_usuario) as $key => $value) {  ?> -->
                                              <form class="form-group" method="POST" name="editarNomePerfil" action="perfil.php">
                                                <input class="form-control my-2" type="text" name="nome" value="<?php echo $usuario_retorno->nome; ?>">
                                                <input class="form-control my-2" type="text" name="sobrenome" id="sobrenome" maxlength="15" value="<?php echo $usuario_retorno->sobrenome; ?>">
                                                <input class="form-control mr-sm-2 my-1" type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>" />
                                                <button type="submit" class="btn btn-danger" name="alterarPerfil">Alterar</button>
                                             <!--   <button class="btn btn-danger open-modal  " data-target="#modalExcluir" data-toggle="modal" data-id="<?php echo $value->id_usuario; ?>" type="button" name="excluir">Excluir</button> -->
                                              </form>
                                              <hr>
                                              <button id="editarSenha" class="btn btn-warning">Editar Senha</button>
                                              <div id="formAlterarSenha" style="display: none;">
                                                <form class="form-group" method="POST" name="alterarSenha" action="perfil.php">
                                                <input class="form-control my-2" type="password" name="senhaAntiga" placeholder="Digite a senha antiga" required="required" autocomplete="current-password">
                                                <input class="form-control my-2" type="password" name="novaSenha" id="senha" placeholder="Digite a nova senha" required="required" minlength="6" onkeypress="validarTamanhoSenha()" autocomplete="new-password">
                                                <div id="divx"></div>
                                                <input class="form-control my-2" type="password" 
                                                name="confirmaNovaSenha" id="confirmaSenha" placeholder="Confirme a nova senha" required="required" minlength="6" oninput="validarSenha('senha','confirmaSenha')" autocomplete="new-password">
                                                <div id="divy"></div>
                                                <input class="form-control mr-sm-2 my-1" type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>" />
                                                <button type="submit" class="btn btn-danger" name="alterarSenha">Concluir Alteração da Senha</button>
                                                </form>
                                               </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row py-2">
                                            <div class="col">
                                                <form method="POST" action="perfil.php" class="form-group" name="emailRespo">
                                                    <p class="py-0"> Email do Responsável:</p>
                                                    <input type="email" name="emailResponsavel" class="form-control py-2" placeholder="Menor de 18? Insira o email do responsável." value="<?php echo $usuario_retorno->email_responsavel; ?>" >
                                                    <input type="hidden" name="id_usuario" class="form-control" value="<?php echo $id_usuario; ?>">
                                                    <button type="submit" class="btn btn-warning my-2" name="emailRespo">Alterar</button>
                                                </form>
                                            </div>
                                        </div>  
                                        <!-- <div class="container">
                                            <input value="< ?= echo $usuario_retorno->qtd_comp; ?>">
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                       </div>
                   </div>
               </div>
           </div>
        </main>
    </section>

    <script>
        $(document).ready(function(){
          $("#editarSenha").click(function(){
            $("#formAlterarSenha").fadeToggle("slow");
            $("#editarSenha").fadeToggle("slow");
        
          });
        });
    </script>
    <script type="text/javascript">
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Erros', 'Acertos'],
                datasets: [{
                    label: '',
                    data: [<?php echo json_encode($erros); ?>,
                           <?php echo json_encode($acertos); ?>],

                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)' 
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script type="text/javascript">
        /*########################################################*/
    $('#formularioUpload').submit(function(event){
        event.preventDefault();   
        var formData = new FormData(this);
        //formData = $(this).serialize();   
        $.ajax({
            method: 'post',
            url : '../controller/usuario.php?flag=upload',
            data : formData,
            cache: false,
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            success: function(data) {
                    console.log(data);
                    swal({
                        type: 'sucess',
                        title: 'Sucesso',
                        text: 'Imagem alterada!',
                        footer: ''
                    });
                    document.location.reload(true);
                    }, 
            error: function(data){
                    alert("Formato inválido! Use PNG ou JPG");
                    console.log(formData);
                }
        });
        // Carrega a imagem selecionada no elemento <img>
        $("input[type=file]").on("change", function(){
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return;
     
            if (/^image/.test( files[0].type)){
                var reader = new FileReader();
                reader.readAsDataURL(files[0]);
     
                reader.onload = function(){
                    $("#imagem").attr('src', this.result);
                }
            }
        });
    });
    /* ####################### */
    </script>

    <?php
        if (isset($_SESSION['senhaErradaMsg']) && $_SESSION['senhaErradaMsg'] === 1) {
            unset($_SESSION['senhaErradaMsg']);
        ?>
            <script type="text/javascript">
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Senha errada!',
                    footer: ''
                });
            </script>
        <?php
        }
        if (isset($_SESSION['senhasNaoIguaisErroMsg']) && $_SESSION['senhasNaoIguaisErroMsg'] === 1) {
            unset($_SESSION['senhasNaoIguaisErroMsg']);
        ?>
            <script type="text/javascript">
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'As novas senhas não correspondem!',
                    footer: 'Tente outra vez'
                });
            </script>
        <?php
        }
        if (isset($_SESSION['sucessoSenhaAlterada']) && $_SESSION['sucessoSenhaAlterada'] === 1) {
            unset($_SESSION['sucessoSenhaAlterada']);
        ?>
            <script type="text/javascript">
                swal({
                    type: 'sucess',
                    title: 'Sucesso',
                    text: 'Senha alterada!',
                    footer: ''
                });
            </script>
        <?php
        }
        ?>
    
<!-- |||||||||||||||||||||  fooooooooooter   ||||||||||||||||||||||||       -->

    <?php include"footer.php"; ?>
</html>