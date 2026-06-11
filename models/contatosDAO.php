<?php
require_once 'contatos.php';

class ContatosDAO {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function buscarTodos() {
        try {
            $contatos = [];
            $sql = "SELECT * FROM contatos ORDER BY nome";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // ORDEM: id, nome, email, telefone
                $contato = new ObterContato(
                    $row['id'],
                    $row['nome'],
                    $row['email'],
                    $row['telefone']
                );
                $contatos[] = $contato;
            }
            return $contatos;
        } catch(PDOException $e) {
            return [];
        }
    }
    
    public function buscarPorId($id) {
        try {
            $sql = "SELECT * FROM contatos WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                // ORDEM: id, nome, email, telefone
                return new ObterContato(
                    $row['id'],
                    $row['nome'],
                    $row['email'],
                    $row['telefone']
                );
            }
            return null;
        } catch(PDOException $e) {
            return null;
        }
    }
    
    public function criar($contato) {
        try {
            $sql = "INSERT INTO contatos (nome, email, telefone) VALUES (:nome, :email, :telefone)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':nome', $contato->getNome());
            $stmt->bindValue(':email', $contato->getEmail());
            $stmt->bindValue(':telefone', $contato->getTelefone());
            return $stmt->execute();
        } catch(PDOException $e) {
            return false;
        }
    }
    
    public function atualizar($contato) {
        try {
            $sql = "UPDATE contatos SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':nome', $contato->getNome());
            $stmt->bindValue(':email', $contato->getEmail());
            $stmt->bindValue(':telefone', $contato->getTelefone());
            $stmt->bindValue(':id', $contato->getId());
            return $stmt->execute();
        } catch(PDOException $e) {
            return false;
        }
    }
    
    public function deletar($id) {
        try {
            $sql = "DELETE FROM contatos WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch(PDOException $e) {
            return false;
        }
    }
}
?>