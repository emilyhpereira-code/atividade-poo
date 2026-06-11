<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CONEXÃO
$host = 'localhost';
$dbname = 'agenda';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // INCLUIR CLASSES
    require_once 'models/cliente.php';
    require_once 'models/clienteDAO.php';
    require_once 'models/contatos.php';
    require_once 'models/contatosDAO.php';
    require_once 'models/produto.php';
    require_once 'models/produtoDAO.php';
    
    // CRIAR DAOS
    $clienteDAO = new ClienteDAO($conn);
    $contatoDAO = new ContatosDAO($conn);
    $produtoDAO = new ProdutosDAO($conn);
    
    // PROCESSAR FORMULÁRIOS
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // CLIENTE
        if (isset($_POST['adicionar_cliente'])) {
            $cliente = new Cliente(null, $_POST['nome'], $_POST['cpf'], $_POST['email'], $_POST['telefone'], $_POST['endereco']);
            if($clienteDAO->criar($cliente)) {
                header("Location: index.php?msg=cliente_adicionado");
                exit();
            }
        }
        
        if (isset($_POST['editar_cliente'])) {
            $cliente = new Cliente($_POST['id'], $_POST['nome'], $_POST['cpf'], $_POST['email'], $_POST['telefone'], $_POST['endereco']);
            $clienteDAO->atualizar($cliente);
            header("Location: index.php?msg=cliente_editado");
            exit();
        }
        
        // CONTATO - CORRIGIDO
        if (isset($_POST['adicionar_contato'])) {
            $contato = new ObterContato(null, $_POST['nome'], $_POST['email'], $_POST['telefone']);
            $contatoDAO->criar($contato);
            header("Location: index.php?msg=contato_adicionado");
            exit();
        }
        
        if (isset($_POST['editar_contato'])) {
            $contato = new ObterContato($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
            $contatoDAO->atualizar($contato);
            header("Location: index.php?msg=contato_editado");
            exit();
        }
        
// PRODUTO - deve estar exatamente assim
    if (isset($_POST['adicionar_produto'])) {
    $produto = new Produtos(null, $_POST['nome'], $_POST['descricao'], $_POST['preco'], $_POST['estoque'], $_POST['imagem']);
    if($produtoDAO->criar($produto)) {
        header("Location: index.php?msg=produto_adicionado");
        exit();
    } else {
        echo "Erro ao adicionar produto: " . $conn->errorInfo()[2];
    }
    }
    
    }
    // DELETAR
    if (isset($_GET['deletar_cliente'])) {
        $clienteDAO->deletar($_GET['deletar_cliente']);
        header("Location: index.php");
        exit();
    }
    
    if (isset($_GET['deletar_contato'])) {
        $contatoDAO->deletar($_GET['deletar_contato']);
        header("Location: index.php");
        exit();
    }
    
    if (isset($_GET['deletar_produto'])) {
        $produtoDAO->deletar($_GET['deletar_produto']);
        header("Location: index.php");
        exit();
    }
    
    // BUSCAR DADOS
    $clientes = $clienteDAO->buscarTodos();
    $contatos = $contatoDAO->buscarTodos();
    $produtos = $produtoDAO->buscarTodos();
    
    // PRA EDITAR
    $clienteEditar = isset($_GET['editar_cliente']) ? $clienteDAO->buscarPorId($_GET['editar_cliente']) : null;
    $contatoEditar = isset($_GET['editar_contato']) ? $contatoDAO->buscarPorId($_GET['editar_contato']) : null;
    $produtoEditar = isset($_GET['editar_produto']) ? $produtoDAO->buscarPorId($_GET['editar_produto']) : null;
    
} catch(PDOException $e) {
    $erro = $e->getMessage();
    $clientes = [];
    $contatos = [];
    $produtos = [];
}

// Mostrar mensagem se tiver
$mensagem = '';
if(isset($_GET['msg'])) {
    if($_GET['msg'] == 'produto_adicionado') $mensagem = '<div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:20px; border-radius:5px;">✅ Produto adicionado com sucesso!</div>';
    if($_GET['msg'] == 'cliente_adicionado') $mensagem = '<div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:20px; border-radius:5px;">✅ Cliente adicionado com sucesso!</div>';
    if($_GET['msg'] == 'contato_adicionado') $mensagem = '<div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:20px; border-radius:5px;">✅ Contato adicionado com sucesso!</div>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gerenciamento</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { max-width: 1400px; margin: auto; }
        .secao { background: white; padding: 20px; margin-bottom: 30px; border-radius: 5px; }
        h1 { text-align: center; color: #667eea; }
        h2 { color: #667eea; margin-top: 0; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px; }
        .form-adicionar { background: #f8f9fa; padding: 15px; margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end; }
        .form-adicionar input, .form-adicionar textarea { padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .form-adicionar button { background: #28a745; color: white; border: none; padding: 8px 15px; cursor: pointer; border-radius: 4px; }
        .form-editar { background: #fff3cd; padding: 15px; margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end; border-left: 4px solid #ffc107; }
        .form-editar button { background: #ffc107; color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #667eea; color: white; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        tr:hover { background: #f5f5f5; }
        .btn-edit { background: #ffc107; padding: 4px 8px; text-decoration: none; color: #333; border-radius: 3px; display: inline-block; margin-right: 5px; }
        .btn-delete { background: #dc3545; padding: 4px 8px; text-decoration: none; color: white; border-radius: 3px; display: inline-block; }
        .btn-cancel { background: #6c757d; padding: 8px 15px; text-decoration: none; color: white; border-radius: 4px; display: inline-block; }
        .vazio { text-align: center; padding: 40px; color: #999; }
        .erro { background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border-radius: 5px; }
        .preco { color: #28a745; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h1>📊 Sistema de Gerenciamento</h1>
    
    <?php echo $mensagem; ?>
    
    <?php if(isset($erro)): ?>
        <div class="erro">❌ Erro: <?php echo $erro; ?></div>
    <?php endif; ?>
    
    <!-- ==================== PRODUTOS ==================== -->
    <div class="secao">
        <h2>🛒 Produtos</h2>
        
        <form method="POST" class="form-adicionar">
            <input type="text" name="nome" placeholder="Nome" required style="min-width: 150px;">
            <input type="text" name="descricao" placeholder="Descrição" required style="min-width: 200px;">
            <input type="number" step="0.01" name="preco" placeholder="Preço" required style="width: 100px;">
            <input type="number" name="estoque" placeholder="Estoque" required style="width: 80px;">
            <input type="text" name="imagem" placeholder="URL da imagem" style="min-width: 150px;">
            <button type="submit" name="adicionar_produto">➕ Adicionar Produto</button>
        </form>
        
        <?php if($produtoEditar): ?>
        <form method="POST" class="form-editar">
            <input type="hidden" name="id" value="<?php echo $produtoEditar->getId(); ?>">
            <input type="text" name="nome" value="<?php echo $produtoEditar->getNome(); ?>" required style="min-width: 150px;">
            <input type="text" name="descricao" value="<?php echo $produtoEditar->getDescricao(); ?>" required style="min-width: 200px;">
            <input type="number" step="0.01" name="preco" value="<?php echo $produtoEditar->getPreco(); ?>" required style="width: 100px;">
            <input type="number" name="estoque" value="<?php echo $produtoEditar->getEstoque(); ?>" required style="width: 80px;">
            <input type="text" name="imagem" value="<?php echo $produtoEditar->getImagem(); ?>" style="min-width: 150px;">
            <button type="submit" name="editar_produto">✏️ Atualizar</button>
            <a href="index.php" class="btn-cancel">Cancelar</a>
        </form>
        <?php endif; ?>
        
        <?php if(count($produtos) > 0): ?>
        <table>
            <thead><tr><th>ID</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Estoque</th><th>Imagem</th><th>Ações</th></tr></thead>
            <tbody>
                <?php foreach($produtos as $p): ?>
                <tr>
                    <td><?php echo $p->getId(); ?></td>
                    <td><strong><?php echo $p->getNome(); ?></strong></td>
                    <td><?php echo substr($p->getDescricao(), 0, 50); ?></td>
                    <td class="preco">R$ <?php echo number_format($p->getPreco(), 2, ',', '.'); ?></td>
                    <td><?php echo $p->getEstoque(); ?> unid.</td>
                    <td><?php echo $p->getImagem() ? substr($p->getImagem(), 0, 30) : 'Sem imagem'; ?></td>
                    <td>
                        <a href="?editar_produto=<?php echo $p->getId(); ?>" class="btn-edit">Editar</a>
                        <a href="?deletar_produto=<?php echo $p->getId(); ?>" class="btn-delete" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="vazio">📦 Nenhum produto cadastrado.</div>
        <?php endif; ?>
    </div>
    
    <!-- ==================== CLIENTES ==================== -->
    <div class="secao">
        <h2>👥 Clientes</h2>
        
        <form method="POST" class="form-adicionar">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="text" name="cpf" placeholder="CPF" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="telefone" placeholder="Telefone">
            <input type="text" name="endereco" placeholder="Endereço">
            <button type="submit" name="adicionar_cliente">➕ Adicionar Cliente</button>
        </form>
        
        <?php if($clienteEditar): ?>
        <form method="POST" class="form-editar">
            <input type="hidden" name="id" value="<?php echo $clienteEditar->getId(); ?>">
            <input type="text" name="nome" value="<?php echo $clienteEditar->getNome(); ?>" required>
            <input type="text" name="cpf" value="<?php echo $clienteEditar->getCpf(); ?>" required>
            <input type="email" name="email" value="<?php echo $clienteEditar->getEmail(); ?>" required>
            <input type="text" name="telefone" value="<?php echo $clienteEditar->getTelefone(); ?>">
            <input type="text" name="endereco" value="<?php echo $clienteEditar->getEndereco(); ?>">
            <button type="submit" name="editar_cliente">✏️ Atualizar</button>
            <a href="index.php" class="btn-cancel">Cancelar</a>
        </form>
        <?php endif; ?>
        
        <?php if(count($clientes) > 0): ?>
        <table>
            <thead><tr><th>ID</th><th>Nome</th><th>CPF</th><th>Email</th><th>Telefone</th><th>Endereço</th><th>Ações</th></tr></thead>
            <tbody>
                <?php foreach($clientes as $c): ?>
                <tr>
                    <td><?php echo $c->getId(); ?></td>
                    <td><?php echo $c->getNome(); ?></td>
                    <td><?php echo $c->getCpf(); ?></td>
                    <td><?php echo $c->getEmail(); ?></td>
                    <td><?php echo $c->getTelefone(); ?></td>
                    <td><?php echo $c->getEndereco(); ?></td>
                    <td>
                        <a href="?editar_cliente=<?php echo $c->getId(); ?>" class="btn-edit">Editar</a>
                        <a href="?deletar_cliente=<?php echo $c->getId(); ?>" class="btn-delete" onclick="return confirm('Deletar?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="vazio">Nenhum cliente cadastrado</div>
        <?php endif; ?>
    </div>
    
    <!-- ==================== CONTATOS ==================== -->
    <div class="secao">
        <h2>📞 Contatos</h2>
        
        <form method="POST" class="form-adicionar">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="telefone" placeholder="Telefone">
            <button type="submit" name="adicionar_contato">➕ Adicionar Contato</button>
        </form>
        
        <?php if($contatoEditar): ?>
        <form method="POST" class="form-editar">
            <input type="hidden" name="id" value="<?php echo $contatoEditar->getId(); ?>">
            <input type="text" name="nome" value="<?php echo $contatoEditar->getNome(); ?>" required>
            <input type="email" name="email" value="<?php echo $contatoEditar->getEmail(); ?>" required>
            <input type="text" name="telefone" value="<?php echo $contatoEditar->getTelefone(); ?>">
            <button type="submit" name="editar_contato">✏️ Atualizar</button>
            <a href="index.php" class="btn-cancel">Cancelar</a>
        </form>
        <?php endif; ?>
        
        <?php if(count($contatos) > 0): ?>
        <table>
            <thead><tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th></tr></thead>
            <tbody>
                <?php foreach($contatos as $c): ?>
                <tr>
                    <td><?php echo $c->getId(); ?></td>
                    <td><?php echo $c->getNome(); ?></td>
                    <td><?php echo $c->getEmail(); ?></td>
                    <td><?php echo $c->getTelefone(); ?></td>
                    <td>
                        <a href="?editar_contato=<?php echo $c->getId(); ?>" class="btn-edit">Editar</a>
                        <a href="?deletar_contato=<?php echo $c->getId(); ?>" class="btn-delete" onclick="return confirm('Deletar?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="vazio">Nenhum contato cadastrado</div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>