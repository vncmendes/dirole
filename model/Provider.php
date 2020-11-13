<?php
include_once 'Crud.php';

class Provider extends Crud {

    protected $table = "provider";
    private $id_provider;
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;
    private $foto;
    private $nivel;
    private $rank;
    private $cpf;
	  private $email_responsavel;

    public function updateEmailRes($id_provider) {

      $sql = "UPDATE $this->table
      SET email_responsavel = :email_responsavel  
      WHERE id_provider = :id_provider";
      $stmt = Banco::prepare($sql);
      $stmt->bindParam(':email_responsavel', $this->email_responsavel);
      $stmt->bindParam(':id_provider', $id_provider);
      return $stmt->execute();
    }

    public function insert() {

        $sql = "INSERT INTO $this->table (nome, sobrenome, email, senha, foto, nivel, cpf) VALUES (:nome, :sobrenome, :email, :senha, :foto, :nivel, :cpf)";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':sobrenome', $this->sobrenome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':foto', $this->foto);
        $stmt->bindParam(':nivel', $this->nivel);
        $stmt->bindParam(':cpf', $this->cpf);
        
        return $stmt->execute();
    }
    public function alteraSenha($id_provider){
        $sql = "UPDATE $this->table 
        SET senha=:senha 
        WHERE id_provider = :id_provider";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':id_provider', $id_provider);
        return $stmt->execute();
    }

    public function update($id_provider) {

        $sql = "UPDATE $this->table SET nome=:nome, sobrenome=:sobrenome, email=:email, senha=:senha, nivel=:nivel, cpf=:cpf  WHERE id_provider = :id_provider";
        $stmt = Banco::prepare($sql);
        
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':sobrenome', $this->sobrenome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':nivel', $this->nivel);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':id_provider', $id_provider);
        return $stmt->execute();
    }

    public function updatePerfil($id_provider) {

        $sql = "UPDATE $this->table SET nome=:nome, sobrenome=:sobrenome WHERE id_provider = :id_provider";
        $stmt = Banco::prepare($sql);

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':sobrenome', $this->sobrenome);
        $stmt->bindParam(':id_provider', $id_provider);
        return $stmt->execute();
    }

    public function uploadImagem($id_provider) {

        $sql = "UPDATE $this->table SET  foto=:foto WHERE id_provider = :id_provider";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':foto', $this->foto);
        $stmt->bindParam(':id_provider', $id_provider);
        return $stmt->execute();
    }
    /**
    *   
    *   @return boolean
    */
    public function logar($email, $senha){
        // monta o sql
        $sql= "SELECT * FROM $this->table WHERE email = :email AND senha = :senha ";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        $teste = $stmt->execute();
        $response = $stmt->rowCount();
        if($response > 0){
            return $stmt->fetch();
        }
        else{
            return false;
        }
    }
    public function buscaFoto($id_provider){
        $sql= "SELECT * FROM $this->table WHERE id_provider = :id_provider";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':id_provider', $id_provider);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function verificaSenha($id_provider){
        $sql= "SELECT * FROM $this->table WHERE id_provider = :id_provider";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':id_provider', $id_provider);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function mostrarRank(){

        $sql  = "SELECT nome, sum(acerto) as qtd, foto
        FROM dados
        JOIN $this->table 
        USING (id_provider)
        GROUP BY nome
        ORDER BY qtd DESC limit 3";

        $stmt = Banco::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } 
    public function recuperarSenha($email, $senha){
        $sql = "UPDATE $this->table 
        SET senha = :senha 
        WHERE email = :email";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

  public function getTable() {
      return $this->table;

  }

  /**
   * @param mixed $table
   *
   * @return self
   */
  public function setTable($table) {
      $this->table = $table;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getId_Provider() {
      return $this->id_provider;
  }

  /**
   * @param mixed $id_provider
   *
   * @return self
   */
  public function setId_Provider($id_provider) {
      $this->id_provider = $id_provider;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getNome() {
      return $this->nome;
  }

  /**
   * @param mixed $nome
   *
   * @return self
   */
  public function setNome($nome) {
      $this->nome = $nome;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getEmail() {
      return $this->email;
  }

  /**
   * @param mixed $email
   *
   * @return self
   */
  public function setEmail($email) {
      $this->email = $email;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getSenha() {
      return $this->senha;
  }

  /**
   * @param mixed $senha
   *
   * @return self
   */
  public function setSenha($senha) {
      $this->senha = $senha;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getSobrenome() {
      return $this->sobrenome;
  }

  /**
   * @param mixed $sobrenome
   *
   * @return self
   */
  public function setSobrenome($sobrenome) {
      $this->sobrenome = $sobrenome;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getFoto() {
      return $this->foto;
  }

  /**
   * @param mixed $foto
   *
   * @return self
   */
  public function setFoto($foto) {
      $this->foto = $foto;
      return $this;
  }
  /**
   * @return mixed
   */
  public function getNivel() {
      return $this->nivel;
  }

  /**
   * @param mixed $nivel
   *
   * @return self
   */
  public function setNivel($nivel) {
      $this->nivel = $nivel;
      return $this;
  }
  /**
   * @return mixed
   */
  public function getRank() {
      return $this->rank;
  }

  /**
   * @param mixed $rank
   *
   * @return self
   */
  public function setRank($rank) {
      $this->rank = $rank;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getEmailResponsavel() {
      return $this->email_responsavel;
  }

  /**
   * @param mixed $email_responsavel
   *
   * @return self
   */
  public function setEmailResponsavel($email_responsavel)
  {
      $this->email_responsavel = $email_responsavel;

      return $this;
  }
  
  public function getCpf()
  {
    return $this->cpf;
  }

  public function setCpf($cpf)
  {
    $this->cpf = $cpf;
  }

}
