<?php


class Provider
{

  private $id;
  private $email;
  private $senha;
  private $nome;
  private $sobrenome;
  private $cpf;
  private $foto;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function getSobrenome()
  {
    return $this->sobrenome;
  }

  public function setSobrenome($sobrenome)
  {
    $this->sobrenome = $sobrenome;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getSenha()
  {
    return $this->senha;
  }

  public function setSenha($senha)
  {
    $this->senha = $senha;
  }
  public function getCpf()
  {
    return $this->cpf;
  }

  public function setCpf($cpf)
  {
    $this->cpf = $cpf;
  }

  public function getFoto()
  {
    return $this->foto;
  }

  public function setFoto($foto)
  {
    $this->foto = $foto;
  }
}
