<?php
// views/produtos/lista.php
require_once 'models/produto.php';
require_once 'models/produtoDAO.php';

$produtoDAO = new ProdutosDAO($conn);
$produtos = $produtoDAO->buscarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .container { max-width: 1200px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #667eea; margin-bottom: 20px; }
        .topo { display: flex; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 10px; }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 5px; display: inline-block; }
        .btn-add { background: #28a745; color: white; }
        .btn-back { background: #6c757d; color: white; }
        .btn-edit { background: #ffc107; color: #333; padding: 5px 10px; font-size: 12px; }
        .btn-delete { background: #dc3545; color: white; padding: 5px 10px; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #667eea; color: white; padding: 12px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        tr:hover { background: #f5f5f5; }
        .vazio { text-align: center; padding: 40px; color: #999; }
        .estoque-baixo { color: orange; font-weight: bold; }
        .estoque-zerado { color: red; font-weight: bold; }
        .preco { color: #28a745; font-weight: bold; }
        img { width: 50px; height: 50px; object-fit: cover; border-radius: 5px; }
        .sem-imagem { color: #999; font-style: italic; }
        @media (max-width: 768px) {
            .container { padding: 10px; }
            th, td { font-size: 12px; padding: 5px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🛒 Lista de Produtos</h1>
        
        <div class="topo">
            <a href="?pagina=produtos&acao=form" class="btn btn-add">➕ Novo Produto</a>
            <a href="index.php" class="btn btn-back">🏠 Voltar ao Menu</a>
        </div>
        
        <?php if(count($produtos) > 0): ?>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produtos as $p): ?>
                    <tr>
                        <td><?php echo $p->getId(); ?></td>
                        <td>
                            <?php if($p->getImagem()): ?>
                                <img src="<?php echo $p->getImagem(); ?>" alt="<?php echo $p->getNome(); ?>">
                            <?php else: ?>
                                <span class="sem-imagem">Sem foto</span>
                            <?php endif; ?>
                        </td>
                        <td><strong><?php echo $p->getNome(); ?></strong></td>
                        <td><?php echo substr($p->getDescricao(), 0, 60); ?><?php echo strlen($p->getDescricao()) > 60 ? '...' : ''; ?></td>
                        <td class="preco">R$ <?php echo number_format($p->getPreco(), 2, ',', '.'); ?></td>
                        <td class="<?php echo $p->getEstoque() <= 0 ? 'estoque-zerado' : ($p->getEstoque() < 5 ? 'estoque-baixo' : ''); ?>">
                            <?php echo $p->getEstoque(); ?> unid.
                        </td>
                        <td>
                            <a href="?pagina=produtos&acao=form&id=<?php echo $p->getId(); ?>" class="btn btn-edit">✏️ Editar</a>
                            <a href="?pagina=produtos&acao=deletar&id=<?php echo $p->getId(); ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir <?php echo addslashes($p->getNome()); ?>?')">🗑️ Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 20px; text-align: center; color: #666;">
            📊 Total de produtos: <?php echo count($produtos); ?>
        </div>
        
        <?php else: ?>
        <div class="vazio">
            🚀 Nenhum produto cadastrado<br>
            <a href="?pagina=produtos&acao=form" style="color: #28a745;">Clique aqui para adicionar seu primeiro produto</a>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>