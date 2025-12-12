<?php

if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
}

// Remove todas as variáveis da sessão
session_unset();

// Destrói a sessão completamente
session_destroy();

// Remove o cookie de sessão, se existir
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redireciona para a página inicial ou de login após o logout
// Mensagem simples de confirmação
//echo "Logout efetuado com sucesso.<br>";
//echo "<a href='index.php'>Voltar o inicio</a>";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - ABhostel</title>
    <link rel="stylesheet" href="/assets/css/logout.css">
</head>
<body>

<div class="logout-container">
    <img src="/assets/Imagens/logo.png" alt="Logo ABhostel">

    <h2>Logout efetuado com sucesso!</h2>
    <p>Você saiu da sua conta com segurança.</p>

    <a href="/index.php" class="btn-voltar">Voltar ao início</a>
</div>

</body>
</html>