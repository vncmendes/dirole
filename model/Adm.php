 <?php
 include_once 'Crud.php';

class Adm extends Crud {

    protected $table = 'adm';
	private $id_adm;
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;
    private $foto;
    private $nivel;

    public function insert() {}

    public function selectAll(){
		$sql  = "SELECT * FROM $this->table";
		$stmt = Banco::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }
    
    public function selectAllEvent(){
		$sql  = "SELECT * FROM EVENTOS";
		$stmt = Banco::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }

	public function delete($id_adm){
		$sql  = "DELETE FROM $this->table WHERE id_adm = :id_adm";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':id_adm', $id_adm, PDO::PARAM_INT);
		return $stmt->execute(); 
    }
    
    public function deleteUser($id){
		$sql  = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
		return $stmt->execute(); 
	}

    public function alteraSenha($id_adm) {
        $sql = "UPDATE $this->table 
        SET senha=:senha 
        WHERE id_adm = :id_adm";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':id_adm', $id_adm);
        return $stmt->execute();
    }

    public function update($id_adm) {

        $sql = "UPDATE $this->table SET nome=:nome, sobrenome=:sobrenome, email=:email, senha=:senha, nivel=:nivel  WHERE id_adm = :id_adm";
        $stmt = Banco::prepare($sql);
        
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':sobrenome', $this->sobrenome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':nivel', $this->nivel);
        $stmt->bindParam(':id_adm', $id_adm);
        return $stmt->execute();
    }

    public function updatePerfil($id_adm) {

        $sql = "UPDATE $this->table SET nome=:nome, sobrenome=:sobrenome WHERE id_adm = :id_adm";
        $stmt = Banco::prepare($sql);
 
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':sobrenome', $this->sobrenome);
        $stmt->bindParam(':id_adm', $id_adm);
        return $stmt->execute();
    }

    public function uploadImagem($id_adm) {

        $sql = "UPDATE $this->table SET  foto=:foto WHERE id_adm = :id_adm";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':foto', $this->foto);
        $stmt->bindParam(':id_adm', $id_adm);
        return $stmt->execute();
    }

    public function logar($email, $senha) {
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
    public function buscaFoto($id_adm){
        $sql= "SELECT * FROM $this->table WHERE id_adm = :id_adm";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':id_adm', $id_adm);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function verificaSenha($id_adm){
        $sql= "SELECT * FROM $this->table WHERE id_adm = :id_adm";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':id_adm', $id_adm);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function recuperarSenha($email, $senha) {
        $sql = "UPDATE $this->table 
        SET senha = :senha 
        WHERE email = :email";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function setid_adm($id_adm) {
        $this->id_adm = $id_adm;
    }

    public function getid_adm() {
        return $this->id_adm;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }

    public function getNivel()
    {
        return $this->nivel;
    }

    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
        return $this;
    }

    public function getTable()
    {
        return $this->table;

    }

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

}