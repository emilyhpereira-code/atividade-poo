<?php
class Produtos{
    private $id;
    private $nome;
    private $decricao;
    private $preco;
    private $estoque;
    private $imagem;

    // CONSTRUTOR: id primeiro (opcional), depois os outros
    public function __construct($id, $nome, $decricao, $preco, $estoque, $imagem){
        $this->setId($id);
        $this->setNome($nome);
        $this->setDescricao($decricao);
        $this->setPreco($preco);
        $this->setEstoque($estoque);
        $this->setImagem($imagem);
    }

    public function getId(){ return $this->id; }
    public function getNome(){ return $this->nome; }
    public function getDescricao(){ return $this->decricao; }
    public function getPreco(){ return $this->preco; }
    public function getEstoque(){ return $this->estoque; }
    public function getImagem(){ return $this->imagem; }

    public function setId($id){ $this->id = $id; }
    public function setNome($nome){ $this->nome = $nome; }
    public function setDescricao($descricao){ $this->decricao = $descricao; }
    public function setPreco($preco){ $this->preco = $preco; }
    public function setEstoque($estoque){ $this->estoque = $estoque; }
    public function setImagem($imagem){ $this->imagem = $imagem; }
}
?>