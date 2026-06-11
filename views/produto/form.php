<?php
// views/produtos/form.php
require_once 'models/produto.php';
require_once 'models/produtoDAO.php';

$produtoDAO = new ProdutosDAO($conn);
$produto = null;

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $produto = $produtoDAO->buscarPorId($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $produto ? 'Editar' : 'Novo'; ?> Produto</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
        }
        h1 {
            text-align: center;
            color: #667eea;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea {
            height: 80px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
            width: 100%;
        }
        .cancelar {
            background: #6c757d;
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            margin-top: 10px;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $produto ? '✏️ Editar Produto' : '➕ Novo Produto'; ?></h1>
        
        <form method="POST" action="?pagina=produtos&acao=salvar">
            <?php if($produto): ?>
                <input type="hidden" name="id" value="<?php echo $produto->getId(); ?>">
            <?php endif; ?>
            
            <label>Nome:</label>
            <input type="text" name="nome" required value="<?php echo $produto ? $produto->getNome() : ''; ?>">
            
            <label>Descrição:</label>
            <textarea name="descricao" required><?php echo $produto ? $produto->getDescricao() : ''; ?></textarea>
            
            <label>Preço:</label>
            <input type="number" step="0.01" name="preco" required value="<?php echo $produto ? $produto->getPreco() : ''; ?>">
            
            <label>Estoque:</label>
            <input type="number" name="estoque" required value="<?php echo $produto ? $produto->getEstoque() : ''; ?>">
            
            <label>Imagem URL:</label>
            <input type="text" name="imagem" value="<?php echo $produto ? $produto->getImagem() : ''; ?>">
            
            <button type="submit">💾 Salvar</button>
            
            <a href="?pagina=produtos" class="cancelar">❌ Cancelar</a>
        </form>
    </div>
</body>
</html>