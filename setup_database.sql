-- Script para criar a tabela no banco existente projeto_java
USE projeto_java;

-- Criar tabela de usuários se não existir
CREATE TABLE IF NOT EXISTS minha_tabela (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Inserir alguns dados de exemplo (opcional)
INSERT INTO minha_tabela (nome, email) VALUES 
('João Silva', 'joao@email.com'),
('Maria Santos', 'maria@email.com'),
('Pedro Oliveira', 'pedro@email.com')
ON DUPLICATE KEY UPDATE nome=VALUES(nome);

-- Verificar se a tabela foi criada
SELECT 'Tabela criada com sucesso!' as status;
SELECT COUNT(*) as total_usuarios FROM minha_tabela;
