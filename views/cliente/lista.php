<?php
// views/clientes/lista.php
require_once 'models/cliente.php';
require_once 'models/clienteDAO.php';

$clienteDAO = new ClienteDAO($conn);
$clientes = $clienteDAO->buscarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { max-width: 1200px; margin: auto; background: white; padding: 20px; border-radius: 5px; }
        h1 { color: #667eea; }
        .topo { display: flex; justify-content: space-between; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #667eea; color: white; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; margin: 2px; display: inline-block; }
        .btn-add { background: #28a745; color: white; }
        .btn-edit { background: #ffc107; color: #333; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-back { background: #6c757d; color: white; }
        .vazio { text-align: center; padding: 20px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <h1>👥 Lista de Clientes</h1>
        
        <div class="topo">
            <a href="?pagina=clientes&acao=form" class="btn btn-add">➕ Novo Cliente</a>
            <a href="index.php" class="btn btn-back">🏠 Voltar ao Menu</a>
        </div>
        
        <?php if(count($clientes) > 0): ?>
        <table>
            <thead>
                <tr><th>ID</th><th>Nome</th><th>CPF</th><th>Email</th><th>Telefone</th><th>Endereço</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach($clientes as $c): ?>
                <tr>
                    <td><?php echo $c->getId(); ?></td>
                    <td><strong><?php echo $c->getNome(); ?></strong></td>
                    <td><?php echo $c->getCpf(); ?></td>
                    <td><?php echo $c->getEmail(); ?></td>
                    <td><?php echo $c->getTelefone(); ?></td>
                    <td><?php echo $c->getEndereco(); ?></td>
                    <td>
                        <a href="?pagina=clientes&acao=form&id=<?php echo $c->getId(); ?>" class="btn btn-edit">✏️ Editar</a>
                        <a href="?pagina=clientes&acao=deletar&id=<?php echo $c->getId(); ?>" class="btn btn-delete" onclick="return confirm('Deletar este cliente?')">🗑️ Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="vazio">Nenhum cliente cadastrado</div>
        <?php endif; ?>
    </div>
</body>
</html>