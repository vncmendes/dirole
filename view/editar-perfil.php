<!-- < ?
require_once "../model/Usuario.php";
require_once "../model/UsuarioDAO.php";
require_once '../view/header.php';
require_once '../controler/usuario.php';

$id = $_POST['id'];
//$usuarioDAO = new UsuarioDAO(); está em usuario.php
$usuario = $usuarioDAO->find($id);

?>
<h1>Alterar Usuário</h1>
<form action="../controler/usuario.php" method="post">
<input type="hidden" name="id" value="< ?=$usuario->id?>">

    <table>
      <tr>
        <td><label>Nome:</label></td>
        <td><input type="text" name="nome" value="< ?=$usuario->nome?>"></td>
      </tr>

      <tr>
        <td><label>Sobrenome:</label></td>
        <td><input type="text" name="sobrenome" value="< ?=$usuario->sobrenome?>"></td>
      </tr>

      <tr>  
        <td><label>E-mail:</label></td>
        <td><input type="email" name="email" value="< ?=$usuario->email?>"></td>
      </tr>

      <tr>
        <td><label>Senha:</label></td>
        <td><input type="password" name="senha" value="< ?=$usuario->senha?>"></td>
      </tr>

      <tr>
        <td><button class="btn btn-primary" type="submit" name="enviar">Alterar</td>
      </tr>
   </table>
  </form>
< ?php  -->