<?php
require_once 'cliente.php';

class ClienteDAO {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Buscar todos
    public function buscarTodos() {
        try {
            $clientes = [];
            $sql = "SELECT * FROM clientes ORDER BY nome";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $cliente = new Cliente(
                    $row['id'],
                    $row['nome'],
                    $row['cpf'],
                    $row['email'],
                    $row['telefone'],
                    $row['endereco']
                );
                $clientes[] = $cliente;
            }
            return $clientes;
        } catch(PDOException $e) {
            return [];
        }
    }
    
    // Criar
    public function criar($cliente) {
        try {
            $sql = "INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES (:nome, :cpf, :email, :telefone, :endereco)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':nome', $cliente->getNome());
            $stmt->bindValue(':cpf', $cliente->getCpf());
            $stmt->bindValue(':email', $cliente->getEmail());
            $stmt->bindValue(':telefone', $cliente->getTelefone());
            $stmt->bindValue(':endereco', $cliente->getEndereco());
            return $stmt->execute();
        } catch(PDOException $e) {
            return false;
        }
    }
    
    // Atualizar
    public function atualizar($cliente) {
        try {
            $sql = "UPDATE clientes SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, endereco = :endereco WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':nome', $cliente->getNome());
            $stmt->bindValue(':cpf', $cliente->getCpf());
            $stmt->bindValue(':email', $cliente->getEmail());
            $stmt->bindValue(':telefone', $cliente->getTelefone());
            $stmt->bindValue(':endereco', $cliente->getEndereco());
            $stmt->bindValue(':id', $cliente->getId());
            return $stmt->execute();
        } catch(PDOException $e) {
            return false;
        }
    }
    
    // Deletar
    public function deletar($id) {
        try {
            $sql = "DELETE FROM clientes WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch(PDOException $e) {
            return false;
        }
    }
    
    // Buscar por ID
    public function buscarPorId($id) {
        try {
            $sql = "SELECT * FROM clientes WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Cliente($row['id'], $row['nome'], $row['cpf'], $row['email'], $row['telefone'], $row['endereco']);
            }
            return null;
        } catch(PDOException $e) {
            return null;
        }
    }
}
?>