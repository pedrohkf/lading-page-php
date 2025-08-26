<?php
// Define o nome do arquivo para salvar os e-mails
$file = 'emails.txt';

// Verifica se a requisição é um POST e se o e-mail foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Valida o formato do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        // Formata a linha a ser salva (e-mail e data)
        $data = $email . " | " . date('Y-m-d H:i:s') . "\n";

        // Salva o e-mail no arquivo
        // FILE_APPEND adiciona ao final do arquivo; LOCK_EX evita quebra de concorrência
        if (file_put_contents($file, $data, FILE_APPEND | LOCK_EX) !== false) {
            echo "Obrigado! Seu e-mail foi salvo com sucesso.";
        } else {
            echo "Erro ao salvar o e-mail. Tente novamente mais tarde.";
        }
    } else {
        echo "Formato de e-mail inválido. Por favor, insira um e-mail válido.";
    }
} else {
    echo "Método de requisição inválido ou e-mail não fornecido.";
}
?>
