<?php 
      include_once '../model/Provider.php';
      // require'../PHPMailer-master/src/PHPMailer.php';
      // require'../PHPMailer-master/src/SMTP.php';
      // require'../PHPMailer-master/src/Exception.php';
     //require'../controller/recaptchalib.php';
      $provider = new Provider();

        //######################################################################################
        // cadastrar provider ==================================================================
        //######################################################################################

        if (isset($_POST['emailRespoP'])) {
          $email_responsavel = $_POST['emailResponsavel'];
          $id_provider = $_POST['id_provider'];
          $provider->setId_Provider($id_provider);
          $provider->setEmailResponsavel($email_responsavel);
          $provider->updateEmailRes($id_provider);          
        }
      //######################################################################################
      // Alterar Senha Provider ===============================================================
      //######################################################################################
      if (isset($_POST['alterarSenhaP'])) {
        if (!empty($_POST['senhaAntiga']) && !empty($_POST['novaSenha']) && !empty($_POST['confirmaNovaSenha'])) {
          if (isset($_POST['novaSenha']) >= 6 && isset($_POST['confirmaNovaSenha']) >= 6) {
 
            $senha = $_POST['senhaAntiga'];
            $id_provider = $_POST['id_provider'];
            $novaSenha = $_POST['novaSenha'];
            $confirmaNovaSenha = $_POST['confirmaNovaSenha'];
            $obj_senhaAntiga = $provider->verificaSenha($id_provider);
            $senhaOk = $obj_senhaAntiga->senha;
            if (isset($senha) && $senha == $senhaOk) {
              if ($novaSenha == $confirmaNovaSenha) {
                $senha = $novaSenha;
                $provider->setSenha($senha);
                $provider->alteraSenha($id_provider);
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
        // cadastrar provider ===============================================================
        //######################################################################################

        if (isset($_POST['cadastrarP'])) {
          $nome = trim(strtoupper($_POST['nome']));
          $email = trim($_POST['email']);
          $senha = trim($_POST['senha']);
          $cpf = trim($_POST['cpf']);
          $confirmaSenha = trim($_POST['confirmaSenha']);
          $sobrenome = $_POST['sobrenome'];
          $foto = "images/user.jpg";
          $nivel = 1;
          if ($confirmaSenha == $senha) {
              
            $obj_retorno = $provider->verificaEmail($email);
            if (!$obj_retorno) { 
      
              $provider->setNome($nome);
              $provider->setSobrenome($sobrenome);
              $provider->setEmail($email);
              $provider->setSenha($senha);
              $provider->setCpf($cpf);
              $provider->setFoto($foto);
              $provider->setNivel($nivel);
              $provider->insert();
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
        // editar provider ===================================================================
        //######################################################################################
         if (isset($_GET['flag']) && $_GET['flag'] == 'editar')  {
          //echo $_POST['sobrenome'];die;
        	$id_provider = $_POST['id_provider'];
        	$nome = $_POST['nome'];
        	$sobrenome = $_POST['sobrenome'];
        	$email = $_POST['email'];
          $senha = $_POST['senha'];
          $cpf = trim($_POST['cpf']);
          $nivel = $_POST['nivel'];
          $provider->setNome($nome);
          $provider->setSobrenome($sobrenome);
          $provider->setEmail($email);
          $provider->setSenha($senha);
          $provider->setCpf($cpf);
          $provider->setNivel($nivel);

          $provider->update($id_provider);
        }else{
            
            $editarSucessoMsg = 1;
            $_SESSION['editarSucessoMsg'] = $editarSucessoMsg;
        }
        //######################################################################################
        // alterar perfil Provider
        //######################################################################################
        if (isset($_POST['alterarPerfilP'])) {
           $nome = trim(strtoupper($_POST['nome']));
           $sobrenome = $_POST['sobrenome'];
           $id_provider = $_POST['id_provider'];
           $provider->setNome($nome);
           $provider->setSobrenome($sobrenome);

           $provider->updatePerfil($id_provider);
           unset($_SESSION['nome']);
           $_SESSION['nome'] = $nome;

        }
       
        //######################################################################################
        // excluir provider ====================================================================
        //######################################################################################
        if (isset($_POST['flag']) && $_POST['flag'] == 'excluir') {
        	$id_provider = $_POST['id'];
        	$provider->delete($id_provider);
        	
        }
        //######################################################################################
        // logar provider ======================================================================
        //######################################################################################
        if(isset($_POST['logarP'])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $obj_retorno = $provider->logar($email, $senha);
           
            if(!$obj_retorno){
                //session_start();
                $loginErroMsg = 1;
                $_SESSION['loginErroMsg'] = $loginErroMsg;
                //header("location: index.php");

            }else{
                session_start();
                $_SESSION['logado'] = 1;
                $_SESSION['nome'] = $obj_retorno->nome;
                $_SESSION['id_provider'] = $obj_retorno->id_provider;
                $_SESSION['foto'] = $obj_retorno->foto;
                $_SESSION['nivel'] = $obj_retorno->nivel;
                $_SESSION['sobrenome'] = $obj_retorno->sobrenome;
                header("location: perfilP.php");
            }   
        }

        // mostrar rank provider geral =========================================
        //$obj_retorno  = $provider->mostrarRank();
       // $foto = $obj_retorno->foto;
     //   $rank = $obj_retorno->rank;
        //######################################################################################
        // sair provider ========================================================================
        //######################################################################################
        if (isset($_POST['sair'])) {
           
            header("location: logout.php");
        } 
        //######################################################################################  
        ///// UPLOAD DE IMAGEM DE PERFIL =======================================================
        //######################################################################################
        $msg = false;
        if (isset($_GET['flag']) && $_GET['flag'] == 'upload') {
           session_start();
           $id_provider = $_SESSION['id_provider']; 
           $extensao = strtolower(substr($_FILES['foto']['name'], -4));
          // var_dump($_FILES['foto']['name']);die;
          if ($extensao == ".jpg" || $extensao == ".png" || $extensao == ".jpeg") {
             $novo_nome = md5(time()) . $extensao;
             $diretorio = "../view/images/";
             move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$novo_nome);
             $foto = $diretorio.$novo_nome;
             $provider->setFoto($foto);
             $provider->uploadImagem($id_provider);
             unset($_SESSION['foto']);
             $obj_retorno = $provider->buscaFoto($id_provider);
             $foto = $obj_retorno->foto;
             $_SESSION['foto'] = $foto;
             
           }
           
        }      
        
        //######################################################################################
        // Recuperar senha Provider ============================================
        //######################################################################################
        if (isset($_POST['recuperarsenhaP'])) {
    
          $email = $_POST['email'];
          $obj_retorno = $provider->verificaEmail($email);
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
            $mail->Password = "caganeiraespacial1993";
            $mail->SetFrom($para);
            $mail->Subject = "Recuperação de Senha";
            $mail->Body = "A sua nova senha é ". $senha;
            $mail->AddAddress($para);

            if (!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
              $provider->setSenha($senha);
              $provider->setEmail($email);
              $provider->recuperarSenha($email, $senha);
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
          $obj_retorno = $provider->verificaEmail($email);
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
              $provider->setSenha($senha);
              $provider->setEmail($email);
              $provider->recuperarSenha($email, $senha);
              echo "<script>alert('Sucesso, agora verifique usa caixa do email');</script>";
              }
          } else {
            echo "<script>alert('Email inválido');</script>";
            header("location: recuperarsenha.php");
          }
        }

        if (isset($_POST['cadastrarP'])) {
          $nome = trim(strtoupper($_POST['nome']));
          $sobrenome = $_POST['sobrenome'];
          $email = trim($_POST['email']);
          $senha = trim($_POST['senha']);
          $confirmaSenha = trim($_POST['confirmaSenha']);
          $cpf = trim($_POST['cpf']);
          $foto = "images/user.jpg";
          $nivel = 1;
          if ($confirmaSenha == $senha) {
              
            $obj_retorno = $provider->verificaEmail($email);
            if (!$obj_retorno) { 
      
              $provider->setNome($nome);
              $provider->setSobrenome($sobrenome);
              $provider->setEmail($email);
              $provider->setSenha($senha);
              $provider->setCpf($cpf);
              $provider->setFoto($foto);
              $provider->setNivel($nivel);
              $provider->insert();
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


      // FIM PROVIDER
      // ~~~~~~~~~~~~
?>