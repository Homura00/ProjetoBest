# 🚀 Gerenciador de Usuários Moderno

Uma aplicação web moderna para gerenciar usuários com interface responsiva e containerizada com Docker.

## ✨ Características

- **Interface Moderna**: Design responsivo com gradientes e animações suaves
- **CRUD Completo**: Criar, ler, atualizar e excluir usuários
- **API REST**: Backend PHP com endpoints RESTful
- **Containerizado**: Pronto para rodar com Docker
- **Banco de Dados**: MySQL com dados de exemplo
- **phpMyAdmin**: Interface web para gerenciar o banco

## 🛠️ Tecnologias Utilizadas

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Backend**: PHP 8.2 com PDO
- **Banco de Dados**: MySQL 8.0
- **Containerização**: Docker & Docker Compose
- **Servidor Web**: Apache
- **Ícones**: Font Awesome

## 🚀 Como Executar

### Pré-requisitos
- Docker
- Docker Compose

### Passos para execução

1. **Clone ou baixe o projeto**
   ```bash
   cd /caminho/para/o/projeto
   ```

2. **Execute com Docker Compose**
   ```bash
   docker-compose up -d
   ```

3. **Acesse a aplicação**
   - **Aplicação Principal**: http://localhost:8080
   - **phpMyAdmin**: http://localhost:8081
     - Usuário: `usuario`
     - Senha: `senha`

## 📱 Funcionalidades

### Interface Principal
- ✅ Adicionar novos usuários
- ✅ Listar todos os usuários
- ✅ Editar usuários existentes
- ✅ Excluir usuários
- ✅ Interface responsiva para mobile
- ✅ Alertas visuais para feedback
- ✅ Estados de carregamento

### API Endpoints

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| GET    | `/api_banco.php` | Listar todos os usuários |
| POST   | `/api_banco.php` | Criar novo usuário |
| PUT    | `/api_banco.php` | Atualizar usuário existente |
| DELETE | `/api_banco.php` | Excluir usuário |

## 🗄️ Estrutura do Banco de Dados

```sql
CREATE TABLE minha_tabela (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## 📁 Estrutura do Projeto

```
.
├── index.php              # Interface principal
├── api_banco.php          # API REST
├── Dockerfile             # Configuração do container da aplicação
├── docker-compose.yml     # Orquestração dos containers
├── init.sql              # Script de inicialização do banco
├── README.md             # Este arquivo
└── ApiClientFrame.java   # Cliente Java (opcional)
```

## 🔧 Configuração

### Variáveis de Ambiente

O projeto usa as seguintes variáveis de ambiente (já configuradas no docker-compose.yml):

- `DB_HOST`: Host do banco de dados (padrão: `db`)
- `DB_NAME`: Nome do banco (padrão: `meu_banco`)
- `DB_USER`: Usuário do banco (padrão: `usuario`)
- `DB_PASS`: Senha do banco (padrão: `senha`)

### Portas Utilizadas

- **8080**: Aplicação web principal
- **8081**: phpMyAdmin
- **3306**: MySQL (apenas para conexões externas)

## 🛑 Parar a Aplicação

```bash
docker-compose down
```

Para remover também os volumes (dados do banco):
```bash
docker-compose down -v
```

## 🎨 Capturas de Tela

A interface apresenta:
- Header com gradiente azul
- Formulário moderno para adicionar/editar usuários
- Tabela responsiva com ações de editar/excluir
- Alertas visuais para feedback
- Estados de carregamento e vazio
- Design mobile-first

## 📝 Notas de Desenvolvimento

- A aplicação usa PDO para conexão segura com o banco
- Todas as consultas são preparadas para evitar SQL injection
- A interface é totalmente responsiva
- Os containers são configurados para reiniciar automaticamente
- O banco de dados persiste os dados em volumes Docker

## 🤝 Contribuição

Sinta-se à vontade para contribuir com melhorias, correções de bugs ou novas funcionalidades!

## 📄 Licença

Este projeto é de código aberto e está disponível sob a licença MIT.
