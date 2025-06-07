<?php

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validar e sanitizar campos
    $nome = htmlspecialchars(trim($_POST['nome'] ?? '')); // Protege contra XSS
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $celular = htmlspecialchars(trim($_POST['celular'] ?? ''));
    $mensagem = htmlspecialchars(trim($_POST['mensagem'] ?? '')); // Adicionado campo de mensagem

    // Verifica se os campos obrigatórios estão preenchidos e o e-mail é válido
    if (empty($nome) || empty($email) || empty($celular) || empty($mensagem) || !$email) {
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    // Dados do e-mail
    $para = "SEU_EMAIL_AQUI@EXEMPLO.COM"; // *** SUBSTITUA PELO SEU ENDEREÇO DE E-MAIL ***
    $assunto = "Nova Mensagem do Portfólio - Contato de " . $nome;

    // Corpo do e-mail
    $corpo = "Nome: {$nome}\n";
    $corpo .= "E-mail: {$email}\n";
    $corpo .= "Celular: {$celular}\n";
    $corpo .= "Mensagem:\n{$mensagem}\n";

    // Cabeçalho do e-mail
    $cabecalho = "MIME-Version: 1.0\r\n";
    $cabecalho .= "Content-type: text/plain; charset=UTF-8\r\n";
    $cabecalho .= "From: Seu Portfólio <nao-responda@SEUDOMINIO.COM>\r\n"; // *** SUBSTITUA PELO E-MAIL DO SEU DOMÍNIO ***
    $cabecalho .= "Reply-To: {$email}\r\n";
    $cabecalho .= "X-Mailer: PHP/" . phpversion() . "\r\n";

    // Envio do e-mail
    if (mail($para, $assunto, $corpo, $cabecalho)) {
        echo "Mensagem enviada com sucesso! Em breve entraremos em contato.";
    } else {
        echo "Houve um erro ao enviar sua mensagem. Por favor, tente novamente mais tarde.";
    }
} else {
    echo "Método de requisição inválido!";
}

?>