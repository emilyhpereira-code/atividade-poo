<?php
require_once 'produto.php';

class ProdutosDAO {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function buscarTodos() {
        try {
            $produtos = [];
            $sql = "SELECT * FROM produtos ORDER BY nome";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $produto = new Produtos(
                    $row['id'],
                    $row['nome'],
                    $row['decricao'],
                    $row['preco'],
                    $row['estoque'],
                    $row['imagem']
                );
                $produtos[] = $produto;
            }
            return $produtos;
        } catch(PDOException $e) {
            echo "Erro buscarTodos: " . $e->getMessage();
            return [];
        }
    }
    
    public function buscarPorId($id) {
        try {
            $sql = "SELECT * FROM produtos WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                return new Produtos(
                    $row['id'],
                    $row['nome'],
                    $row['decricao'],
                    $row['preco'],
                    $row['estoque'],
                    $row['imagem']
                );
            }
            return null;
        } catch(PDOException $e) {
            echo "Erro buscarPorId: " . $e->getMessage();
            return null;
        }
    }
    
    public function criar($produto) {
        try {
            $sql = "INSERT INTO produtos (nome, decricao, preco, estoque, imagem) 
                    VALUES (:nome, :descricao, :preco, :estoque, :imagem)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':nome', $produto->getNome());
            $stmt->bindValue(':descricao', $produto->getDescricao());
            $stmt->bindValue(':preco', $produto->getPreco());
            $stmt->bindValue(':estoque', $produto->getEstoque());
            $stmt->bindValue(':imagem', $produto->getImagem());
            
            if($stmt->execute()) {
                return true;
            }
            return false;
        } catch(PDOException $e) {
            echo "Erro criar: " . $e->getMessage();
            return false;
        }
    }
    
    public function atualizar($produto) {
        try {
            $sql = "UPDATE produtos SET 
                    nome = :nome, 
                    decricao = :descricao, 
                    preco = :preco, 
                    estoque = :estoque, 
                    imagem = :imagem 
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':nome', $produto->getNome());
            $stmt->bindValue(':descricao', $produto->getDescricao());
            $stmt->bindValue(':preco', $produto->getPreco());
            $stmt->bindValue(':estoque', $produto->getEstoque());
            $stmt->bindValue(':imagem', $produto->getImagem());
            $stmt->bindValue(':id', $produto->getId());
            return $stmt->execute();
        } catch(PDOException $e) {
            echo "Erro atualizar: " . $e->getMessage();
            return false;
        }
    }
    
    public function deletar($id) {
        try {
            $sql = "DELETE FROM produtos WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch(PDOException $e) {
            echo "Erro deletar: " . $e->getMessage();
            return false;
        }
    }
}
?>w 