import java.awt.BorderLayout;
import java.awt.EventQueue;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;

import javax.swing.*;

public class ApiClientFrame extends JFrame {
    private static final long serialVersionUID = 1L;
    
    // URL base da API (ajuste conforme necessário)
    private static final String BASE_URL = "http://wagnerweinert.com.br/api/api_banco.php";

    // Componentes da interface
    private JTextArea textArea;
    private JButton getButton, postButton, putButton, deleteButton;
    private JTextField idField, nameField, emailField;

    public ApiClientFrame() {
        super("Front End Java para API REST PHP");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(600, 400);
        initComponents();
    }

    private void initComponents() {
        // Área para exibição dos resultados e mensagens
        textArea = new JTextArea();
        textArea.setEditable(false);
        JScrollPane scrollPane = new JScrollPane(textArea);

        // Painel para entrada de dados
        JPanel inputPanel = new JPanel(new FlowLayout(FlowLayout.LEFT));
        inputPanel.add(new JLabel("ID:"));
        idField = new JTextField(5);
        inputPanel.add(idField);
        inputPanel.add(new JLabel("Nome:"));
        nameField = new JTextField(15);
        inputPanel.add(nameField);
        inputPanel.add(new JLabel("Email:"));
        emailField = new JTextField(15);
        inputPanel.add(emailField);

        // Painel para os botões com os métodos HTTP
        JPanel buttonPanel = new JPanel(new FlowLayout(FlowLayout.CENTER));
        getButton = new JButton("GET");
        postButton = new JButton("POST");
        putButton = new JButton("PUT");
        deleteButton = new JButton("DELETE");
        
        buttonPanel.add(getButton);
        buttonPanel.add(postButton);
        buttonPanel.add(putButton);
        buttonPanel.add(deleteButton);

        // Adiciona os painéis na janela principal
        add(inputPanel, BorderLayout.NORTH);
        add(scrollPane, BorderLayout.CENTER);
        add(buttonPanel, BorderLayout.SOUTH);

        // Cria uma instância do HttpClient
        HttpClient client = HttpClient.newHttpClient();

        // Ações dos botões:
        getButton.addActionListener((ActionEvent e) -> {
            // Requisição GET para recuperar todos os registros
            executeRequest(client, "GET", BASE_URL, "");
        });

        postButton.addActionListener((ActionEvent e) -> {
            // Recupera os valores dos campos
            String nome = nameField.getText().trim();
            String email = emailField.getText().trim();
            // Monta o JSON conforme a API espera (nome e email)
            String jsonBody = String.format("{\"nome\":\"%s\", \"email\":\"%s\"}", nome, email);
            executeRequest(client, "POST", BASE_URL, jsonBody);
        });

        putButton.addActionListener((ActionEvent e) -> {
            String id = idField.getText().trim();
            String nome = nameField.getText().trim();
            String email = emailField.getText().trim();
            // Monta o JSON para atualizar o registro com id informado
            String jsonBody = String.format("{\"id\": %s, \"nome\":\"%s\", \"email\":\"%s\"}", id, nome, email);
            executeRequest(client, "PUT", BASE_URL, jsonBody);
        });

        deleteButton.addActionListener((ActionEvent e) -> {
            String id = idField.getText().trim();
            // Monta o JSON para exclusão (apenas id é necessário)
            String jsonBody = String.format("{\"id\": %s}", id);
            executeRequest(client, "DELETE", BASE_URL, jsonBody);
        });
    }

    /**
     * Método que executa a requisição HTTP de forma assíncrona e atualiza a área de texto com o resultado.
     *
     * @param client   Instância do HttpClient.
     * @param method   Método HTTP a ser utilizado (GET, POST, PUT, DELETE).
     * @param url      URL da API.
     * @param jsonBody Corpo da requisição (para POST, PUT e DELETE).
     */
    private void executeRequest(HttpClient client, String method, String url, String jsonBody) {
        // Dispara a execução em uma nova thread para não bloquear a interface gráfica
        new Thread(() -> {
            try {
                HttpRequest.Builder requestBuilder = HttpRequest.newBuilder()
                        .uri(URI.create(url))
                        .header("Content-Type", "application/json");

                // Configura o método da requisição conforme o valor recebido
                switch (method) {
                    case "GET":
                        requestBuilder.GET();
                        break;
                    case "POST":
                        requestBuilder.POST(HttpRequest.BodyPublishers.ofString(jsonBody));
                        break;
                    case "PUT":
                        requestBuilder.PUT(HttpRequest.BodyPublishers.ofString(jsonBody));
                        break;
                    case "DELETE":
                        // Alguns servidores aceitam DELETE com corpo utilizando o método customizado
                        requestBuilder.method("DELETE", HttpRequest.BodyPublishers.ofString(jsonBody));
                        break;
                    default:
                        throw new IllegalArgumentException("Método HTTP desconhecido: " + method);
                }

                HttpRequest request = requestBuilder.build();
                HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());
                
                // Monta a mensagem de resposta com o status HTTP e o corpo
                String result = "Status Code: " + response.statusCode() + "\nResposta:\n" + response.body();
                // Atualiza a interface na thread de eventos
                SwingUtilities.invokeLater(() -> textArea.setText(result));

            } catch (Exception ex) {
                SwingUtilities.invokeLater(() -> textArea.setText("Erro: " + ex.getMessage()));
            }
        }).start();
    }

    public static void main(String[] args) {
        EventQueue.invokeLater(() -> {
            ApiClientFrame frame = new ApiClientFrame();
            frame.setLocationRelativeTo(null);
            frame.setVisible(true);
        });
    }
}