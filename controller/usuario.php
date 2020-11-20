<?php
      include_once '../model/Usuario.php';
      include_once '../model/Adm.php';
      require_once '../PHPMailer-master/src/PHPMailer.php';
      require_once '../PHPMailer-master/src/SMTP.php';
      require_once '../PHPMailer-master/src/Exception.php';
     //require'../controller/recaptchalib.php';
      $usuario = new Usuario();
      $adm = new Adm();
    
      ###################################################################################     
      ########################################################################################
      ######### inserir email responsável  ###################################################
      ########################################################################################
        // if (isset($_POST['emailRespo'])) {
      if (array_key_exists("emailRespo", $_POST)) {
          $email_responsavel = $_POST['emailResponsavel'];
          $id_usuario = $_POST['id_usuario'];
          $usuario->setId_Usuario($id_usuario);
          $usuario->setEmailResponsavel($email_responsavel);
          $usuario->updateEmailRes($id_usuario);          
        }
      //######################################################################################
      // Alterar Senha ===============================================================
      //######################################################################################
      // if (isset($_POST['alterarSenha'])) {
      if (array_key_exists("alterarSenha", $_POST)) {
        if (!empty($_POST['senhaAntiga']) && !empty($_POST['novaSenha']) && !empty($_POST['confirmaNovaSenha'])) {
          if (isset($_POST['novaSenha']) >= 6 && isset($_POST['confirmaNovaSenha']) >= 6) {
 
            $senha = $_POST['senhaAntiga'];
            $id_usuario = $_POST['id_usuario'];
            $novaSenha = $_POST['novaSenha'];
            $confirmaNovaSenha = $_POST['confirmaNovaSenha'];
            $obj_senhaAntiga = $usuario->verificaSenha($id_usuario);
            $senhaOk = $obj_senhaAntiga->senha;
            if (isset($senha) && $senha == $senhaOk) {
              if ($novaSenha == $confirmaNovaSenha) {
                $senha = $novaSenha;
                $usuario->setSenha($senha);
                $usuario->alteraSenha($id_usuario);
                unset($_SESSION['senhasNaoIguaisErroMsg']);
                unset($_SESSION['senhaErradaMsg']);
                $senhasNaoIguaisErroMsg = 0;
                $_SESSION['senhasNaoIguaisErroMsg'] = $senhasNaoIguaisErroMsg;
                $senhaErradaMsg = 0;
                $_SESSION['senhaErradaMsg'] = $senhaErradaMsg;
                $sucessoSenhaAlterada = 1;
                $_SESSION['sucessoSenhaAlterada'] = $sucessoSenhaAlterada;
              }else{
                $senhasNaoIguaisErroMsg = 1;
                $_SESSION['senhasNaoIguaisErroMsg'] = $senhasNaoIguaisErroMsg;
                   }
            }else{
              if (isset($senha)) {
                $senhaErradaMsg = 1;
                $_SESSION['senhaErradaMsg'] = $senhaErradaMsg; 
              }
            }
          }else{
            echo "Você pode ter alterado o HTML para tentar enviar senha com menos de 6 caracteres";die();
        }
        }else{
            echo "Você pode ter alterado o HTML para tentar enviar campos vazio";die();
        }
      } 
        //######################################################################################
        // cadastrar usuario ===============================================================
        //######################################################################################
        // if (isset($_POST['cadastrar'])) {
      if (array_key_exists("cadastrar", $_POST)) {
          $nome = trim(strtoupper($_POST['nome']));
          $email = trim($_POST['email']);
          $senha = trim($_POST['senha']);
          $confirmaSenha = trim($_POST['confirmaSenha']);
          $sobrenome = $_POST['sobrenome'];
          $foto = "images/user.jpg";
          $nivel = 0;
          if ($confirmaSenha == $senha) {
              
            $obj_retorno = $usuario->verificaEmail($email);
            if (!$obj_retorno) { 
      
              $usuario->setNome($nome);
              $usuario->setSobrenome($sobrenome);
              $usuario->setEmail($email);
              $usuario->setSenha($senha);
              $usuario->setFoto($foto);
              $usuario->setNivel($nivel);
              $usuario->insert();
              $cadastroSucesso = 1;
              $_SESSION['cadastroSucesso'] = $cadastroSucesso;

            }else{
                session_start();
                $emailErroMsg = 1;
                $_SESSION['emailErroMsg'] = $emailErroMsg;
            }
          }else{ // senhas diferentes
            $cadastroErroMsg = 1;
            $_SESSION['cadastroErroMsg'] = $cadastroErroMsg;
          }         
        }

        //######################################################################################
        // editar usuario ===================================================================
        //######################################################################################
         if (isset($_GET['flag']) && $_GET['flag'] == 'editar')  {
          //echo $_POST['sobrenome'];die;
        	$id_usuario = $_POST['id_usuario'];
        	$nome = $_POST['nome'];
        	$email = $_POST['email'];
        	$senha = $_POST['senha'];
        	$sobrenome = $_POST['sobrenome'];
          $nivel = $_POST['nivel'];
          $usuario->setNome($nome);
          $usuario->setEmail($email);
          $usuario->setSenha($senha);
          $usuario->setSobrenome($sobrenome);
          $usuario->setNivel($nivel);

          $usuario->update($id_usuario);
        }else{
            
            $editarSucessoMsg = 1;
            $_SESSION['editarSucessoMsg'] = $editarSucessoMsg;
        }
        //######################################################################################
        // alterar perfil usuário
        //######################################################################################
        // antes era assim: if(isset($_POST['alterarPerfil'])) {}
        if (array_key_exists("alterarPerfil", $_POST)) {
           $nome = trim(strtoupper($_POST['nome']));
           $sobrenome = $_POST['sobrenome'];
           $id_usuario = $_POST['id_usuario'];
           $usuario->setNome($nome);
           $usuario->setSobrenome($sobrenome);

           $usuario->updatePerfil($id_usuario);
           unset($_SESSION['nome']);
           $_SESSION['nome'] = $nome;

        }

        if (array_key_exists("remover", $_POST)) {

          $id = $_POST['id'];
        
          $adm->deleteUser($id);
          header("Location: ../view/lista-usuario.php");
          die();
        }
       
        //######################################################################################
        // excluir usuario ====================================================================
        //######################################################################################
        if (isset($_POST['flag']) && $_POST['flag'] == 'excluir') {
        	$id_usuario = $_POST['id'];
        	$usuario->delete($id_usuario);
        	
        }
        //######################################################################################
        // logar usuario ======================================================================
        //######################################################################################
        if(array_key_exists("logar", $_POST)) {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $obj_retorno = $usuario->logar($email, $senha);
           
            if(!$obj_retorno){
                //session_start();
                $loginErroMsg = 1;
                $_SESSION['loginErroMsg'] = $loginErroMsg;
                //header("location: index.php");

            }else{
                session_start();
                $_SESSION['logado'] = 1;
                $_SESSION['nome'] = $obj_retorno->nome;
                $_SESSION['id_usuario'] = $obj_retorno->id_usuario;
                $_SESSION['foto'] = $obj_retorno->foto;
                $_SESSION['nivel'] = $obj_retorno->nivel;
                $_SESSION['sobrenome'] = $obj_retorno->sobrenome;
                header("location: perfil.php");
            }   
        }

        // mostrar rank usuario geral =========================================
        //$obj_retorno  = $usuario->mostrarRank();
       // $foto = $obj_retorno->foto;
     //   $rank = $obj_retorno->rank;
        //######################################################################################
        // sair usuario ========================================================================
        //######################################################################################
        // if (isset($_POST['sair'])) {
        if(array_key_exists("sair", $_POST)) {
           
            header("location: logout.php");
        } 
        //######################################################################################  
        ///// UPLOAD DE IMAGEM DE PERFIL =======================================================
        //######################################################################################
        $msg = false;
        if (isset($_GET['flag']) && $_GET['flag'] == 'upload') {
           session_start();
           $id_usuario = $_SESSION['id_usuario']; 
           $extensao = strtolower(substr($_FILES['foto']['name'], -4));
          // var_dump($_FILES['foto']['name']);die;
          if ($extensao == ".jpg" || $extensao == ".png" || $extensao == ".jpeg") {
             $novo_nome = md5(time()) . $extensao;
             $diretorio = "../view/images/";
             move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$novo_nome);
             $foto = $diretorio.$novo_nome;
             $usuario->setFoto($foto);
             $usuario->uploadImagem($id_usuario);
             unset($_SESSION['foto']);
             $obj_retorno = $usuario->buscaFoto($id_usuario);
             $foto = $obj_retorno->foto;
             $_SESSION['foto'] = $foto;
             
           }
           
        }      
        
        //######################################################################################
        // Recuperar senha usuário ============================================
        //######################################################################################
          if (array_key_exists("recuperarsenha", $_POST)) {
          $email = $_POST['email'];
          $obj_retorno = $usuario->verificaEmail($email);
          $senha = substr(md5(time()), 0, 6);
          $para = $email;

          if ($obj_retorno) {
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->IsSMTP(); // enable SMTP

            $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // or 587
            $mail->IsHTML(true);
            $mail->Username = "viniciussmendes@gmail.com";
            $mail->Password = "";
            $mail->SetFrom($para);
            $mail->Subject = "Recuperação de Senha";
            $mail->Body = "A sua nova senha é ". $senha;
            $mail->AddAddress($para);

            if (!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
              $usuario->setSenha($senha);
              $usuario->setEmail($email);
              $usuario->recuperarSenha($email, $senha);
              echo "<script>alert('Sucesso, agora verifique usa caixa do email');</script>";
              }
          } else {
            echo "<script>alert('Email inválido');</script>";
            header("location: recuperarsenha.php");
          }
        }

        //######################################################################################
        // Email Responsável  para enviar desempenho ===========================================
        //######################################################################################
        if (1===2) {
    
          $email = $_POST['email'];
          $obj_retorno = $usuario->verificaEmail($email);
          $senha = substr(md5(time()), 0, 6);
          $para = $email;

          if ($obj_retorno) {
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->IsSMTP(); // enable SMTP

            $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // or 587
            $mail->IsHTML(true);
            $mail->Username = "gustavotodentro@gmail.com";
            $mail->Password = "caganeiraespacial1993";
            $mail->SetFrom($para);
            $mail->Subject = "Recuperação de Senha ToDentro";
            $mail->Body = "A sua nova senha é ". $senha ." <p>Qualquer dúvida ou problema, envie para gustavotodentro@gmail.com</p>";
            $mail->AddAddress($para);

            if (!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
              $usuario->setSenha($senha);
              $usuario->setEmail($email);
              $usuario->recuperarSenha($email, $senha);
              echo "<script>alert('Sucesso, agora verifique usa caixa do email');</script>";
              }
          } else {
            echo "<script>alert('Email inválido');</script>";
            header("location: recuperarsenha.php");
          }
        }
