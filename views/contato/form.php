<?php
// views/contatos/form.php
require_once 'models/contatos.php';
require_once 'models/contatosDAO.php';

$contatoDAO = new ContatosDAO($conn);
$contato = null;

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $contato = $contatoDAO->buscarPorId($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $contato ? 'Editar' : 'Novo'; ?> Contato</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 5px; }
        h1 { color: #667eea; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #28a745; color: white; border: none; padding: 10px 20px; cursor: pointer; }
        .btn-back { background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; display: inline-block; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $contato ? '✏️ Editar Contato' : '➕ Novo Contato'; ?></h1>
        
        <form method="POST" action="?pagina=contatos&acao=salvar">
            <?php if($contato): ?>
                <input type="hidden" name="id" value="<?php echo $contato->getId(); ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" required value="<?php echo $contato ? $contato->getNome() : ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required value="<?php echo $contato ? $contato->getEmail() : ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Telefone:</label>
                <input type="text" name="telefone" value="<?php echo $contato ? $contato->getTelefone() : ''; ?>">
            </div>
            
            <button type="submit">Salvar</button>
            <a href="?pagina=contatos" class="btn-back">Cancelar</a>
        </form>
    </div>
</body>
</html>