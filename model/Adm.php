<?php


class Adm
{

	private $id;
	private $nome;
	private $sobrenome;
	private $email;
	private $senha;
	private $cpf;

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setNome($nome)
	{
		$this->nome = $nome;
	}

	public function getNome()
	{
		return $this->nome;
	}

	public function setSobrenome($sobrenome)
	{
		$this->sobrenome = $sobrenome;
	}

	public function getSobrenome()
	{
		return $this->sobrenome;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setSenha($senha)
	{
		$this->senha = $senha;
	}

	public function getSenha()
	{
		return $this->senha;
	}
	public function setCpf($cpf)
	{
		$this->id = $id;
	}

	public function getCpf()
	{
		return $this->cpf;
	}
}
