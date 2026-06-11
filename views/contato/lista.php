<?php
require_once 'models/contatos.php';
require_once 'models/contatosDAO.php';

$contatoDAO = new ContatosDAO($conn);
$contatos = $contatoDAO->buscarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Contatos</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 5px; }
        h1 { color: #667eea; }
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
        <h1>📞 Lista de Contatos</h1>
        
        <a href="?pagina=contatos&acao=form" class="btn btn-add">➕ Novo Contato</a>
        <a href="index.php" class="btn btn-back">🏠 Voltar ao Menu</a>
        
        <?php if(count($contatos) > 0): ?>
        <table>
            <thead>
                <tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach($contatos as $c): ?>
                <tr>
                    <td><?php echo $c->getId(); ?></td>
                    <td><?php echo $c->getNome(); ?></td>
                    <td><?php echo $c->getEmail(); ?></td>
                    <td><?php echo $c->getTelefone(); ?></td>
                    <td>
                        <a href="?pagina=contatos&acao=form&id=<?php echo $c->getId(); ?>" class="btn btn-edit">Editar</a>
                        <a href="?pagina=contatos&acao=deletar&id=<?php echo $c->getId(); ?>" class="btn btn-delete" onclick="return confirm('Deletar?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="vazio">Nenhum contato cadastrado</div>
        <?php endif; ?>
    </div>
</body>
</html>