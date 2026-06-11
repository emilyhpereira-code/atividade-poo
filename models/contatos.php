<?php
class ObterContato{
    private $id;
    private $nome;
    private $email;
    private $telefone; 


    public function __construct( $id, $nome, $email, $telefone){
        $this->setId($id);
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setTelefone($telefone);
    }

    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getTelefone(){
        return $this->telefone;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }
}
?>