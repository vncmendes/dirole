<!-- < ?php
    require_once "../model/Usuario.php";
    // require_once "../model/UsuarioDAO.php";
    require_once '../controller/usuario.php';
?>

<html>
  <head>
    < ?php
    require_once 'head.php';
    ?>
  </head>
  < ?php 

  $id = $_POST['id'];
  //$usuarioDAO = new UsuarioDAO(); está em usuario.php
  $usuario = $usuario->find($id);

  ?>
  <div class="principal">
    <div class="container mt-3">
      <div class="row">
        <div class="col-4"></div>
            <div class="col-4 mb-5" style="border: 1px solid black">
                <h1 class="mt-3">Alterar Usuário</h1>
                <form action="../controler/usuario.php" method="post">
                <input type="hidden" name="id" value="< ?=$usuario->id?>">

                    <table class="table">
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
                        <td><button class="btn btn-primary" type="submit" name="enviar">Alterar</button></td>
                      </tr>
                  </table>
                  </form>
          </div>
        </div>    
    </div>      
  </div>
  < ?php
  require_once 'footer.php';
  ?>
</html> -->