<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'agenda');
 
try {
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4';
	$pdo = new PDO($dsn, DB_USER, DB_PASS, [
    	PDO::ATTR_ERRMODE        	=> PDO::ERRMODE_EXCEPTION,
    	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    	PDO::ATTR_EMULATE_PREPARES   => false,
	]);
    echo ("Banco conectado");
} catch (PDOException $e) {
	die('Erro de conexão: ' . $e->getMessage());
}

//RESPOSTAS 
//o PDO::ERRMODE_EXCEPTION facilita a identificação de erros porque sempre que houver um problema ela vai acionar exeções (do tipo PDOExemption)
//já o PDO::ERRMODE_SILENT define o comportamento do sistema quando encontra um erro, no modo silencioso, não avisa se tiver algum problema, o código vai continuar rodando e as operações vão retornar falso

?>

