<?php

@session_start();

require_once '../model/Crud.php';

class ProviderDAO extends Crud
{
  protected $table = "useradm";

  public function getLogin(Provider $provider)
  {
    try {
      @session_start();

      $email = $provider->getEmail();
      $senha = $provider->getSenha();

      $sql = "SELECT email, senha, id, nome FROM $this->table WHERE email = :email and senha = :senha";

      $stmt = Conexao::prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':senha', $senha);

      if ($stmt->execute()) {

        if ($stmt->rowCount() > 0) {

          $provider = $stmt->fetch();
          $_SESSION['id'] = $provider->id;
          // $_SESSION['foto'] = $provider->foto;
          $_SESSION['autentica_provider'] = $provider->nome;
          return true;
        } else {
          return false;
        }
      }
    } catch (Exception $e) {
      print $e->getMessage();
    }
  }

  public function setIdSessions()
  {
    $_SESSION['id'] = $provider->id;
    $_SESSION['autentica_provider'] = $provider->nome;
  }

  public function verificaLogin()
  {
    return isset($_SESSION['autentica_provider']);
  }

  public function estaLogado()
  {
    echo $_SESSION['autentica_provider'];
  }

  public function deslogar()
  {
    unset($_SESSION['id']);
    unset($_SESSION['autentica_provider']);
    session_destroy();
    session_start();
  }

  public function insert(Provider $provider)
  {

    try {
      // recebe os valores em uma variável usando os métodos antes.
      $nome = $provider->getNome();
      $sobrenome = $provider->getSobrenome();
      $email = $provider->getEmail();
      $cpf = $provider->getCpf();
      $senha = $provider->getSenha();
      $foto = $provider->getFoto();

      $sql = "INSERT INTO $this->table (nome, sobrenome, email, cpf, senha, foto) VALUES (:nome, :sobrenome, :email, :cpf, :senha, :foto)";
      $stmt = Conexao::prepare($sql);
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam(':sobrenome', $sobrenome);
      $stmt->bindParam(':cpf', $cpf);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':senha', $senha);
      $stmt->bindParam(':foto', $foto);

      return $stmt->execute();
    } catch (Exception $e) {
      print $e->getMessage();
    }
  }

  public function update(Provider $provider)
  {

    try {

      $id = $provider->getId();
      $nome = $provider->getNome();
      $sobrenome = $provider->getSobrenome();
      $email = $provider->getEmail();
      $senha = $provider->getSenha();

      $sql = "UPDATE $this->table SET nome = :nome, sobrenome = :sobrenome, email = :email, senha = :senha WHERE id = :id";
      $stmt = Conexao::prepare($sql);
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam(':sobrenome', $sobrenome);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':senha', $senha);
      $stmt->bindParam(':id', $id);

      return $stmt->execute();
    } catch (Exception $e) {
      print $e->getMessage();
    }
  }

  public function updateFoto($id)
  {

    try {
      $foto = $id . ".jpg";
      $sql = "UPDATE $this->table SET foto = :foto WHERE id = :id";

      $stmt = Conexao::prepare($sql);
      $stmt->bindParam(':foto', $foto);
      $stmt->bindParam(':id', $id);

      return $stmt->execute();
    } catch (Exception $e) {
      print $e->getMessage();
    }
  }
}
