
<?php
    session_start();
    require_once'../controller/provider.php';
    // require_once'../controller/controlador5.php';
      if(!isset ($_SESSION['logado']))
      {
        session_destroy();
        header("location: index.php");
      } 
      if(isset ($_SESSION['logado']) && isset($_SESSION['id_usuario'])) {
        session_destroy();
        header("location: index.php");
      }
      if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1){
        $nav = "<li> 
                    <a href='adiciona-evento.php' class='nodecore1 navlinks1'>Add Evento</a>
                </li>
                <li> 
                    <a href='lista-evento.php' class='nodecore1 navlinks1'>Meus Eventos</a>
                </li>
                ";
      }
      
    //   if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 0){
    //     $nav = "<li class='nav-item'>
    //                     <a class='text-white mx-1' href='dashboard1.php'><button class='btn btn-danger'>Dashboard</button></a>
    //             </li>";
    //   }

    $id_provider = $_SESSION['id_provider'];
    $provider_retorno = $provider->selectP($id_provider);
  
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
                    <li><a href="eventos.php" class="nodecore1 navlinks1">Eventos</a></li>
                    <?php if (isset($nav)) { echo $nav; }; ?>
                    <!-- <li><a href="#" class="nodecore1 navlinks1">Tickets e Pontos</a></li> -->
                    <!-- <li><a href="perfilP.php" class="nodecore1 navlinks1">Perfil</a> se já estou no perfil não precisa.</li> -->
                </ul>
            </nav>

            <!-- <img class="navicons" src="images/logo.svg" alt="" /> -->
            <div>
                <h1><a class="dirole1" href="index.php">DiRolê</a></h1>
            </div>

            <div class="side1">
                <?php if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1) { ?>
                    <a href="perfilP.php">
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

    <section class="containerMaster py-3">
        <main class="heightFixo">
           <div class="container-fluid">
               <div class="row my-2">
                   <div class="col">
                       <div class="container-fluid">
                            <div class="row perfildiv2">
                                <div class="perfil">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <h4 class="mx-5 text-center py-3">Alteração dos dados cadastrais</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <form class="form-group" method="POST" name="editarNomePerfil" action="perfilP.php">
                                                    <input class="form-control my-2" type="text" name="nome" value="<?php echo $provider_retorno->nome; ?>">
                                                    <input class="form-control my-2" type="text" name="sobrenome" id="sobrenome" maxlength="15" value="<?php echo $provider_retorno->sobrenome; ?>">
                                                    <input class="form-control mr-sm-2 my-1" type="hidden" name="id_provider" value="<?php echo $id_provider; ?>" />
                                                    <button type="submit" class="btn btn-danger" name="alterarPerfilP">Alterar</button>
                                                </form>
                                                <hr>
                                                <button id="editarSenha" class="btn btn-warning">Editar Senha</button>
                                                <div id="formAlterarSenhaP" style="display: none;">
                                                    <form class="form-group" method="POST" name="alterarSenhaP" action="perfilP.php">
                                                    <input class="form-control my-2" type="password" name="senhaAntiga" placeholder="Digite a senha antiga" required="required" autocomplete="current-password">
                                                    <input class="form-control my-2" type="password" name="novaSenha" id="senha" placeholder="Digite a nova senha" required="required" minlength="6" onkeypress="validarTamanhoSenha()" autocomplete="new-password">
                                                    <div id="divx"></div>
                                                    <input class="form-control my-2" type="password" 
                                                    name="confirmaNovaSenha" id="confirmaSenha" placeholder="Confirme a nova senha" required="required" minlength="6" oninput="validarSenha('senha','confirmaSenha')" autocomplete="new-password">
                                                    <div id="divy"></div>
                                                    <input class="form-control mr-sm-2 my-1" type="hidden" name="id_provider" value="<?php echo $id_provider; ?>" />
                                                    <button type="submit" class="btn btn-danger" name="alterarSenhaP">Concluir Alteração da Senha</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> 
                                        <hr>
                                        <div class="row py-2">
                                            <div class="col">
                                                <form method="POST" action="perfilP.php" class="form-group" name="emailRespo">
                                                    <p class="py-0"> Email Alternativo:</p>
                                                    <input type="email" name="emailResponsavel" class="form-control py-2" placeholder="Email alternativo para contato." value="<?php echo $provider_retorno->email_responsavel; ?>" >
                                                    <input type="hidden" name="id_provider" class="form-control" value="<?php echo $id_provider; ?>">
                                                    <button type="submit" class="btn btn-warning my-2" name="emailRespo">Alterar</button>
                                                </form>
                                            </div>
                                        </div>      
                                    </div>
                                    <div class="container">
                                        <a href="relatorio-provider.php" style="display:flex; justify-content:center; margin-bottom: 2%;" class="btn btn-danger">Gerar Relatório</a>
                                    </div>
                                    <div class="container">
                                        <div class="container text-center" style="margin-bottom: 2%;>
                                            <h4 class="mx-5 text-center">Altere sua foto de perfil.</h4>
                                            <p><img src="<?php echo $_SESSION['foto']; ?>" alt="imagem de perfil"  class="img-fluid imagem-responsiva rounded-circle border border-dark mx-3 my-2" width="25%"></p>
                                            <br><br>
                                            <form class="formularioUpload form-group my-2 my-lg-0 ml-auto" enctype="multipart/form-data" method="POST" id="formularioUploadP" name="formulario" action="perfilP.php">
                                                <input class="form-control my-2" type="file" name="foto" required="required">
                                                <button id="upload" style="margin-bottom: 2%" class="btn btn-secondary form-control btn-sm my-2 my-sm-0" name="upload" type="submit">Enviar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="reminderJS">
                                    <div class="jumbotron jumbotron-fluid">
                                        <div class="container">
                                            <h1 class="display-3">Agendamento de Tarefas</h1>
                                            <p class="lead">Não esqueça suas atividades.</p>
                                        </div>	
	                                </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div id="titular-new-reminder">
                                                    <h3><i class="fa fa-plus-square"></i>Novo Lembrete</h3>
                                                </div>
                                                <br>
                                                <div class="form-group text-center">
                                                    <textarea class="form-control" rows="5" id="texto"></textarea>	
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-success form-control" id="buttonSave"><i class="fa fa-save" aria-hidden="true"></i>Save</button>	
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-danger form-control" id="buttonDelete"><i class="fa fa-times" aria-hidden="true"></i>Delete</button>	
                                                        </div>
                                                    </div>
                                                        
                                                </div>
                                                <div id="error"></div>
                                            </div>
                                                <div class="col-md-6">
                                                    <div id="titular-tarefas">
                                                        <h3><i class="fa fa-exclamation-circle"></i>Pendentes</h3>
                                                    </div>
                                                    <div id="lembretes"></div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                   </div>
               </div>
           </div>
        </main>
    </section>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.5/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function(){
          $("#editarSenha").click(function(){
            $("#formAlterarSenhaP").fadeToggle("slow");
            $("#editarSenha").fadeToggle("slow");
        
          });
        });
    </script>
    <script type="text/javascript">
        /*########################################################*/
    $('#formularioUploadP').submit(function(event) {
        event.preventDefault();   
        var formData = new FormData(this);
        //formData = $(this).serialize();
        $.ajax({
            method: 'post',
            url : '../controller/provider.php?flag=upload',
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
        <?php } ?>

        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/functions.js"></script> -->
	<!-- end -->

<?php require_once 'footer.php'; ?>