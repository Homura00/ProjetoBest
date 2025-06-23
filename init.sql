-- Criar banco de dados se não existir
CREATE DATABASE IF NOT EXISTS meu_banco;
USE meu_banco;

-- Criar tabela de usuários
CREATE TABLE IF NOT EXISTS minha_tabela (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Inserir alguns dados de exemplo
INSERT INTO minha_tabela (nome, email) VALUES 
('João Silva', 'joao@email.com'),
('Maria Santos', 'maria@email.com'),
('Pedro Oliveira', 'pedro@email.com')
ON DUPLICATE KEY UPDATE nome=VALUES(nome);
