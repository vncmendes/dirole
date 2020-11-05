<?php

require_once "../model/Provider.php";
require_once "../model/ProviderDAO.php";
require_once '../config-upload.php';

$providerDAO = new ProviderDAO();
$provider = new Provider();

//<-- CONTROADOR ONDE É RECEBIDOA AS INFORMAÇÕES DE CADASTRO -->

if (array_key_exists("cadastrarP", $_POST)) {

  $validate = false;

  $nome = $_POST['nameP'];
  $sobrenome = $_POST['snameP'];
  $email = $_POST['emailP'];
  $cpf = $_POST['cpf'];
  $senha = $_POST['passwordP'];
  $senha2 = $_POST['password2P'];


  if ($nome == "" or $sobrenome == "" or $email == "" or $cpf == "" or $senha == "" or $senha2 == "") {
    echo "Preencha todos os campos";
  }
  if ($senha != $senha2) {
    echo "As senhas divergem !";
  } else {
    $validate = true;
  }

  // $provider = new provider(); está no escopo global de provider.
  $provider->setNome($nome);
  $provider->setSobrenome($sobrenome);
  $provider->setCpf($cpf);
  $provider->setEmail($email);
  $provider->setSenha($senha);

  $providerDAO->insert($provider);


  if ($validate == true) {
    $msg = "Usuário adicionado com sucesso"; ?>
    <p class="text-success text-center"><?= $msg ?></p>
  <?php } else {
    echo "Usuário não adicionado";
  }
  //header("Location: ../view/index.php");
  ?>

<?php }

//<-- CONTROADOR ONDE É RECEBIDOA AS INFORMAÇÕES DE CADASTRO --FIM-->



//<-- CONTROLADOR ONDE É RECEBIDA AS INFORMAÇÕES PARA SEREM REALMENTE ALTERADAS -->

if (array_key_exists("enviar", $_POST)) {

  $validate = false;

  //$providerDAO = new providerDAO();

  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  if ($nome and $sobrenome and $email and $senha) {
    $validate = true;
  }

  //$provider = new provider();
  $provider->setId($id);
  $provider->setNome($nome);
  $provider->setSobrenome($sobrenome);
  $provider->setEmail($email);
  $provider->setSenha($senha);

  $providerDAO->update($provider);

  if ($validate == true) {
    echo "Usuário adicionado com sucesso";
    header("Location: ../view/lista-provider.php");
  } else {
    echo "Usuário não adicionado";
  }
?>
  <tr>
    <td>
      <a href="../view/lista-provider.php" class="btn btn-dark">Voltar</a>
    </td>
  </tr>
  <?php }

//<-- CONTROLADOR ONDE É RECEBIDA AS INFORMAÇÕES PARA SEREM REALMENTE ALTERADAS --FIM-->

//<-- CONTROLADOR ONDE É RECEBIDA AS INFORMAÇÕES PARA SEREM REMOVIDAS -->

if (array_key_exists("remover", $_POST)) {

  $id = $_POST['idR'];
  //$providerDAO = new providerDAO();

  $providerDAO->delete($id);

  header("Location: ../view/lista-provider.php");
  die();
}

if (array_key_exists("removerPerfil", $_POST)) {

  $id = $_POST['id'];
  //$providerDAO = new providerDAO();

  $providerDAO->delete($id);
  unset($_SESSION['id']);
  unset($_SESSION['autentica_provider']);

  header("Location: ../view/index.php");
  die();
}


// ESTA CHAMANDO NO LOGIN O USUARIO NORMAL EO PROVIDER
if (array_key_exists("logarP", $_POST)) {

  $autentica = false;

  $email = $_POST['email'];
  $senha = md5($_POST['password']);

  //$providerDAO = new providerDAO();
  //$provider = new provider();

  $provider->setEmail($email);
  $provider->setSenha($senha);

  if ($email == "" or $senha == "") {
    echo "Preencha todos os campos";
  } else {
    $autentica = true;
  }

  if ($autentica == true) {
    if ($providerDAO->getLogin($provider)) { ?>
      <p class="text-success text-center">Você está logado como <?= $providerDAO->estaLogado(); ?></p>
  <?php } else {
      echo "Acesso Negadoooooooooooo !";
    }
  }
  ?>


<?php }

//<-- CONTROLADOR ONDE É RECEBIDA AS INFORMAÇÕES PARA SEREM REMOVIDAS --FIM-->

if (array_key_exists("uploadArc", $_POST)) {

  $nomeArc = $_FILES['foto']['name'];
  $tipoArc = $_FILES['foto']['type'];
  $tamanhoArc = $_FILES['foto']['size'];
  $nomeArcTemp = $_FILES['foto']['tmp_name'];
  $errorArc = $_FILES['foto']['error'];
  $id = $_SESSION['id'];

  $providerDAO->updateFoto($id);


  if ($sobrescrever == "não" and file_exists("$caminho/$id.jpg")) {
    die("Arquivo já existe");
  }
  if ($limitar_tamanho == "sim" and ($tamanhoArc > $tamanho_bytes)) {
    die("Arquivo deve ter no máximo $tamanho_bytes bytes");
  }

  $ext = strrchr($nomeArc, '.');

  if (($limitar_ext == "sim") and !in_array($ext, $extensoes_validas)) {
    die("Extensão de arquivo inválida para upload");
  }

  if (!empty($nomeArc)) {
    if (move_uploaded_file($nomeArcTemp, "../imagens/$id.jpg")) {
      header("Location: ../view/perfil.php");
    } else {
      die("Falha no erro");
    }
  } else {
    die("Selecione o arquivo a ser enviado !");
  }
}

?>