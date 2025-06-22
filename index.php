<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Usuários</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .header p {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .content {
            padding: 40px;
        }

        .form-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 40px;
            border: 1px solid #e9ecef;
        }

        .form-section h2 {
            color: #495057;
            margin-bottom: 20px;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: end;
        }

        .input-group {
            flex: 1;
            min-width: 200px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
            font-weight: 500;
        }

        .input-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .input-group input:focus {
            outline: none;
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
            transform: translateY(-2px);
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 172, 254, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
            padding: 8px 12px;
            font-size: 14px;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, #feca57 0%, #ff9ff3 100%);
            color: white;
            padding: 8px 12px;
            font-size: 14px;
        }

        .btn-warning:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(254, 202, 87, 0.3);
        }

        .table-section {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .table-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 30px;
        }

        .table-header h2 {
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            color: #6c757d;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: #f8f9fa;
            transform: scale(1.01);
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }

        .loading i {
            font-size: 2rem;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .content {
                padding: 20px;
            }

            .form-group {
                flex-direction: column;
            }

            .input-group {
                min-width: 100%;
            }

            .header h1 {
                font-size: 2rem;
            }

            th, td {
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-users"></i> Gerenciador de Usuários</h1>
            <p>Sistema moderno para gerenciar usuários com interface intuitiva</p>
        </div>

        <div class="content">
            <div id="alertContainer"></div>

            <div class="form-section">
                <h2><i class="fas fa-user-plus"></i> Adicionar Novo Usuário</h2>
                <form id="userForm">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="nome">Nome Completo</label>
                            <input type="text" id="nome" name="nome" placeholder="Digite o nome completo" required>
                        </div>
                        <div class="input-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" placeholder="Digite o e-mail" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Adicionar Usuário
                        </button>
                    </div>
                </form>
            </div>

            <div class="table-section">
                <div class="table-header">
                    <h2><i class="fas fa-list"></i> Lista de Usuários</h2>
                </div>
                <div class="table-container">
                    <div id="loadingState" class="loading">
                        <i class="fas fa-spinner"></i>
                        <p>Carregando usuários...</p>
                    </div>
                    <div id="emptyState" class="empty-state" style="display: none;">
                        <i class="fas fa-user-slash"></i>
                        <h3>Nenhum usuário encontrado</h3>
                        <p>Adicione o primeiro usuário usando o formulário acima</p>
                    </div>
                    <table id="userTable" style="display: none;">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i> ID</th>
                                <th><i class="fas fa-user"></i> Nome</th>
                                <th><i class="fas fa-envelope"></i> E-mail</th>
                                <th><i class="fas fa-cogs"></i> Ações</th>
                            </tr>
                        </thead>
                        <tbody id="userList">
                            <!-- Os usuários serão preenchidos via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const apiUrl = "api_banco.php"; // Caminho para a API
            let editingUserId = null;

            // Elementos do DOM
            const userForm = document.getElementById("userForm");
            const userList = document.getElementById("userList");
            const userTable = document.getElementById("userTable");
            const loadingState = document.getElementById("loadingState");
            const emptyState = document.getElementById("emptyState");
            const alertContainer = document.getElementById("alertContainer");

            // Função para mostrar alertas
            function showAlert(message, type = 'success') {
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type}`;
                alertDiv.innerHTML = `
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
                    ${message}
                `;
                alertContainer.innerHTML = '';
                alertContainer.appendChild(alertDiv);

                setTimeout(() => {
                    alertDiv.remove();
                }, 5000);
            }

            // Carregar usuários
            function carregarUsuarios() {
                loadingState.style.display = 'block';
                userTable.style.display = 'none';
                emptyState.style.display = 'none';

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        loadingState.style.display = 'none';

                        if (data.length === 0) {
                            emptyState.style.display = 'block';
                        } else {
                            userTable.style.display = 'table';
                            userList.innerHTML = "";
                            data.forEach(usuario => {
                                userList.innerHTML += `
                                    <tr>
                                        <td>${usuario.id}</td>
                                        <td>${usuario.nome}</td>
                                        <td>${usuario.email}</td>
                                        <td class="actions">
                                            <button class="btn btn-warning" onclick="editarUsuario(${usuario.id}, '${usuario.nome}', '${usuario.email}')">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                            <button class="btn btn-danger" onclick="excluirUsuario(${usuario.id})">
                                                <i class="fas fa-trash"></i> Excluir
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            });
                        }
                    })
                    .catch(error => {
                        loadingState.style.display = 'none';
                        console.error("Erro ao buscar usuários:", error);
                        showAlert("Erro ao carregar usuários", "error");
                    });
            }

            // Adicionar/Editar usuário
            userForm.addEventListener("submit", function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                const jsonData = Object.fromEntries(formData.entries());

                if (editingUserId) {
                    jsonData.id = editingUserId;
                }

                const method = editingUserId ? "PUT" : "POST";
                const action = editingUserId ? "atualizado" : "adicionado";

                fetch(apiUrl, {
                    method: method,
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(jsonData)
                })
                .then(response => response.json())
                .then(data => {
                    showAlert(`Usuário ${action} com sucesso!`, "success");
                    carregarUsuarios();
                    resetForm();
                })
                .catch(error => {
                    console.error(`Erro ao ${action.slice(0, -1)} usuário:`, error);
                    showAlert(`Erro ao ${action.slice(0, -1)} usuário`, "error");
                });
            });

            // Função para editar usuário
            window.editarUsuario = function(id, nome, email) {
                editingUserId = id;
                document.getElementById("nome").value = nome;
                document.getElementById("email").value = email;

                const submitBtn = userForm.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-save"></i> Atualizar Usuário';
                submitBtn.style.background = 'linear-gradient(135deg, #feca57 0%, #ff9ff3 100%)';

                document.querySelector('.form-section h2').innerHTML = '<i class="fas fa-user-edit"></i> Editar Usuário';

                // Scroll para o formulário
                document.querySelector('.form-section').scrollIntoView({ behavior: 'smooth' });
            };

            // Função para excluir usuário
            window.excluirUsuario = function(id) {
                if (confirm("Tem certeza que deseja excluir este usuário?")) {
                    fetch(apiUrl, {
                        method: "DELETE",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ id: id })
                    })
                    .then(response => response.json())
                    .then(data => {
                        showAlert("Usuário excluído com sucesso!", "success");
                        carregarUsuarios();
                    })
                    .catch(error => {
                        console.error("Erro ao excluir usuário:", error);
                        showAlert("Erro ao excluir usuário", "error");
                    });
                }
            };

            // Função para resetar o formulário
            function resetForm() {
                editingUserId = null;
                userForm.reset();

                const submitBtn = userForm.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-plus"></i> Adicionar Usuário';
                submitBtn.style.background = 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)';

                document.querySelector('.form-section h2').innerHTML = '<i class="fas fa-user-plus"></i> Adicionar Novo Usuário';
            }

            // Inicializar a lista
            carregarUsuarios();
        });
    </script>
</body>
</html>