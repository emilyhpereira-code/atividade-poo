<?php
// views/clientes/form.php
require_once 'models/cliente.php';
require_once 'models/clienteDAO.php';

$clienteDAO = new ClienteDAO($conn);
$cliente = null;

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $cliente = $clienteDAO->buscarPorId($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $cliente ? 'Editar' : 'Novo'; ?> Cliente</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 5px; }
        h1 { color: #667eea; text-align: center; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #28a745; color: white; border: none; padding: 10px 20px; margin-top: 20px; cursor: pointer; width: 100%; }
        .btn-back { background: #6c757d; text-decoration: none; color: white; padding: 10px 20px; display: block; text-align: center; margin-top: 10px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $cliente ? '✏️ Editar Cliente' : '➕ Novo Cliente'; ?></h1>
        
        <form method="POST" action="?pagina=clientes&acao=salvar">
            <?php if($cliente): ?>
                <input type="hidden" name="id" value="<?php echo $cliente->getId(); ?>">
            <?php endif; ?>
            
            <label>Nome:</label>
            <input type="text" name="nome" required value="<?php echo $cliente ? $cliente->getNome() : ''; ?>">
            
            <label>CPF:</label>
            <input type="text" name="cpf" required value="<?php echo $cliente ? $cliente->getCpf() : ''; ?>">
            
            <label>Email:</label>
            <input type="email" name="email" required value="<?php echo $cliente ? $cliente->getEmail() : ''; ?>">
            
            <label>Telefone:</label>
            <input type="text" name="telefone" value="<?php echo $cliente ? $cliente->getTelefone() : ''; ?>">
            
            <label>Endereço:</label>
            <textarea name="endereco"><?php echo $cliente ? $cliente->getEndereco() : ''; ?></textarea>
            
            <button type="submit">💾 Salvar</button>
            
            <a href="?pagina=clientes" class="btn-back">❌ Cancelar</a>
        </form>
    </div>
</body>
</html>