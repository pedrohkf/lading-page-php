<?php
// Configurações do arquivo onde os e-mails serão salvos.
$file = 'emails.txt';

// Verifica se a requisição é do tipo POST e se o campo de e-mail foi enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Valida o e-mail.
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Formata a string para salvar no arquivo (e-mail e data).
        $data = $email . " | " . date('Y-m-d H:i:s') . PHP_EOL;

        // Tenta abrir o arquivo para escrita (modo de apêndice 'a').
        // Se o arquivo não existir, ele será criado.
        if (file_put_contents($file, $data, FILE_APPEND | LOCK_EX) !== false) {
            $response = [
                'success' => true,
                'message' => 'Obrigado por se inscrever! Seu e-mail foi salvo com sucesso.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Erro ao salvar o e-mail. Por favor, tente novamente mais tarde.'
            ];
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'E-mail inválido. Por favor, insira um e-mail válido.'
        ];
    }

    // Retorna a resposta em formato JSON.
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>
