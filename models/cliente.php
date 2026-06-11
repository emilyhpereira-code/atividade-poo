<?php
class Cliente{
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $telefone;  
    private $endereco;

    public function __construct($id,$nome, $cpf, $email, $telefone, $endereco){
        $this->setId($id);
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setEmail($email);
        $this->setTelefone($telefone);
        $this->setEndereco($endereco);
    }

    public function getId(){ return $this->id; }
    public function getNome(){ return $this->nome; }
    public function getCpf(){ return $this->cpf; }
    public function getEmail(){ return $this->email; }
    public function getTelefone(){ return $this->telefone; }
    public function getEndereco(){ return $this->endereco; }

    public function setId($id){ $this->id = $id; }
    public function setNome($nome){ $this->nome = $nome; }
    public function setCpf($cpf){ $this->cpf = $cpf; }
    public function setEmail($email){ $this->email = $email; }
    public function setTelefone($telefone){ $this->telefone = $telefone; }
    public function setEndereco($endereco){ $this->endereco = $endereco; }
}
?>