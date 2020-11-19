<?php 
      include_once '../model/Adm.php';
      $adm = new Adm();

    //######################################################################################
    // Alterar Senha adm ===============================================================
    //######################################################################################

      if(array_key_exists("alterarSenhaAdm", $_POST)) {
        if (!empty($_POST['senhaAntiga']) && !empty($_POST['novaSenha']) && !empty($_POST['confirmaNovaSenha'])) {
          if (isset($_POST['novaSenha']) >= 6 && isset($_POST['confirmaNovaSenha']) >= 6) {
 
            $senha = $_POST['senhaAntiga'];
            $id_adm = $_POST['id_adm'];
            $novaSenha = $_POST['novaSenha'];
            $confirmaNovaSenha = $_POST['confirmaNovaSenha'];
            $obj_senhaAntiga = $adm->verificaSenha($id_adm);
            $senhaOk = $obj_senhaAntiga->senha;
            if (isset($senha) && $senha == $senhaOk) {
              if ($novaSenha == $confirmaNovaSenha) {
                $senha = $novaSenha;
                $adm->setSenha($senha);
                $adm->alteraSenha($id_adm);
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
        // editar adm ===================================================================
        //######################################################################################

         if (isset($_GET['flag']) && $_GET['flag'] == 'editar')  {
          //echo $_POST['sobrenome'];die;
        	$id_adm = $_POST['id_adm'];
        	$nome = $_POST['nome'];
        	$sobrenome = $_POST['sobrenome'];
        	$email = $_POST['email'];
            $senha = $_POST['senha'];
            $nivel = $_POST['nivel'];

            $adm->setNome($nome);
            $adm->setSobrenome($sobrenome);
            $adm->setEmail($email);
            $adm->setSenha($senha);
            $adm->setNivel($nivel);

          $adm->update($id_adm);
        }else{
            
            $editarSucessoMsg = 1;
            $_SESSION['editarSucessoMsg'] = $editarSucessoMsg;
        }
        //######################################################################################
        // alterar perfil adm
        //######################################################################################

        if(array_key_exists("alterarPerfilAdm", $_POST)) {
           $nome = trim(strtoupper($_POST['nome']));
           $sobrenome = $_POST['sobrenome'];
           $id_adm = $_POST['id_adm'];
           $adm->setNome($nome);
           $adm->setSobrenome($sobrenome);

           $adm->updatePerfil($id_adm);
           unset($_SESSION['nome']);
           $_SESSION['nome'] = $nome;

        }

        if (array_key_exists("remover", $_POST)) {

          $id = $_POST['id_usuario'];
        
          $adm->deleteUser($id);
          header("Location: ../view/lista-usuario.php");
          die();
        }
       
        //######################################################################################
        // excluir adm ====================================================================
        //######################################################################################
        if (isset($_POST['flag']) && $_POST['flag'] == 'excluir') {
        	$id_adm = $_POST['id_adm'];
        	$adm->delete($id_adm);
        	
        }
        //######################################################################################
        // logar adm ======================================================================
        //######################################################################################

        if(array_key_exists("logarAdm", $_POST)) {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $obj_retorno = $adm->logar($email, $senha);
           
            if(!$obj_retorno){
                //session_start();
                $loginErroMsg = 1;
                $_SESSION['loginErroMsg'] = $loginErroMsg;
                //header("location: index.php");

            }else{
                session_start();
                $_SESSION['logado'] = 1;
                $_SESSION['nome'] = $obj_retorno->nome;
                $_SESSION['id_adm'] = $obj_retorno->id_adm;
                $_SESSION['foto'] = $obj_retorno->foto;
                $_SESSION['nivel'] = $obj_retorno->nivel;
                $_SESSION['sobrenome'] = $obj_retorno->sobrenome;
                header("location: perfilAdm.php");
            }   
        }

        //######################################################################################
        // sair adm ========================================================================
        //######################################################################################
        if(array_key_exists("sair", $_POST)) {
           
            header("location: logout.php");
        }

        //######################################################################################  
        ///// UPLOAD DE IMAGEM DE PERFIL =======================================================
        //######################################################################################
        $msg = false;
        if (isset($_GET['flag']) && $_GET['flag'] == 'upload') {
           session_start();
           $id_adm = $_SESSION['id_adm']; 
           $extensao = strtolower(substr($_FILES['foto']['name'], -4));
          // var_dump($_FILES['foto']['name']);die;
          if ($extensao == ".jpg" || $extensao == ".png" || $extensao == ".jpeg") {
             $novo_nome = md5(time()) . $extensao;
             $diretorio = "../view/images/";
             move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$novo_nome);
             $foto = $diretorio.$novo_nome;
             $adm->setFoto($foto);
             $adm->uploadImagem($id_adm);
             unset($_SESSION['foto']);
             $obj_retorno = $adm->buscaFoto($id_adm);
             $foto = $obj_retorno->foto;
             $_SESSION['foto'] = $foto;
             
           }
           
        }      
        
        //######################################################################################
        // Recuperar senha adm ============================================
        //######################################################################################

        if(array_key_exists("recuperarsenhaAdm", $_POST)) {
    
          $email = $_POST['email'];
          $obj_retorno = $adm->verificaEmail($email);
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
            $mail->Password = "senhareal";
            $mail->SetFrom($para);
            $mail->Subject = "Recuperação de Senha";
            $mail->Body = "A sua nova senha é ". $senha;
            $mail->AddAddress($para);

            if (!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
              $adm->setSenha($senha);
              $adm->setEmail($email);
              $adm->recuperarSenha($email, $senha);
              echo "<script>alert('Sucesso, agora verifique usa caixa do email');</script>";
              }
          } else {
            echo "<script>alert('Email inválido');</script>";
            header("location: recuperarsenha.php");
          }
        }

      // FIM adm
      // ~~~~~~~~~~~~

      
?>