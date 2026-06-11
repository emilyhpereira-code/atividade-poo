<!-- cabecalho.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cadastros</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient( #909dd8, #a9e9ee);
            padding: 20px;
        }
        
        /* Container principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Cabeçalho */
        .header {
            background: #2c3e50;
            border-radius: 8px;
            padding: 15px 25px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .header h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: normal;
        }
        
        /* Menu de navegação */
        .nav-menu {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .nav-link {
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.2s;
            color: white;
        }
        
        .nav-link.contatos {
            background: #3498db;
        }
        
        .nav-link.contatos:hover {
            background: #2980b9;
        }
        
        .nav-link.produtos {
            background: #9b59b6;
        }
        
        .nav-link.produtos:hover {
            background: #8e44ad;
        }
        
        .nav-link.clientes {
            background: #e67e22;
        }
        
        .nav-link.clientes:hover {
            background: #d35400;
        }
        
        /* Cards e conteúdo */
        .content-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        /* Tabelas */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background: #f8f9fa;
            font-weight: 600;
        }
        
        /* Responsivo */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
            }
            
            th, td {
                padding: 8px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Sistema de Cadastros</h1>
            <div class="nav-menu">
                <a href="index.php" class="nav-link contatos">Contatos</a>
                <a href="produtos.php" class="nav-link produtos">Produtos</a>
                <a href="clientes.php" class="nav-link clientes">Clientes</a>
            </div>
        </div>