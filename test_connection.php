<?php
// Script para testar a conexão com o banco
header("Content-Type: application/json");

$host = "beste_teste_banco_de_dados";
$db_name = "projeto_java";
$username = "mysql";
$password = "3f2bf0430182dae882ed";

try {
    $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Testar se a tabela existe
    $query = "SHOW TABLES LIKE 'minha_tabela'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $table_exists = $stmt->rowCount() > 0;
    
    echo json_encode([
        "status" => "success",
        "message" => "Conexão estabelecida com sucesso!",
        "host" => $host,
        "database" => $db_name,
        "table_exists" => $table_exists,
        "table_message" => $table_exists ? "Tabela 'minha_tabela' encontrada" : "Tabela 'minha_tabela' NÃO encontrada - execute o setup_database.sql"
    ]);
    
} catch(PDOException $exception) {
    echo json_encode([
        "status" => "error",
        "message" => "Erro de conexão: " . $exception->getMessage(),
        "host" => $host,
        "database" => $db_name
    ]);
}
?>
