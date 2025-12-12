<?php
session_set_cookie_params(['path' => '/']);
session_start();

require_once "bd.php";

// Se o formulário foi enviado
if(isset($_POST['email']) && isset($_POST['senha'])){

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Conexão PDO
    $conn = bd::getConexao();

    $sql = $conn->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
    $sql->bindValue(":email", $email);
    $sql->execute();

    $usuario = $sql->fetch(PDO::FETCH_OBJ);

    if(!$usuario){
        die("Email ou senha inválidos!");
    }

    // Verifica senha com password_verify
    if(password_verify($senha, $usuario->senha)){

        $_SESSION['usuario_id'] = $usuario->id;
        $_SESSION['logado'] = true;

    // --- Envia notificação para RabbitMQ sobre login --- //
    require_once __DIR__ . '/vendor/autoload.php';

    use PhpAmqpLib\Connection\AMQPStreamConnection;
    use PhpAmqpLib\Message\AMQPMessage;

    try {
    // conexão com o container RabbitMQ
    $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
    $channel = $connection->channel();

    // nome da fila usada pelo professor
    $channel->queue_declare('fila_emails', false, true, false, false);

    // dados enviados
    $dados = [
        "to" => $email,  
        "subject" => "Login realizado",
        "body" => "O usuário $email acabou de fazer login no sistema ABHostel."
    ];

    $msg = new AMQPMessage(json_encode($dados));
    $channel->basic_publish($msg, '', 'fila_emails');

    $channel->close();
    $connection->close();

    } catch (Exception $e) {
    error_log("Erro ao enviar mensagem RabbitMQ: " . $e->getMessage());
    }

        header("Location: painel.php");
        exit;
    } 
    else {
        die("Email ou senha inválidos!");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABhostel - Entrar</title>

    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>
     <div class="page-wrapper">

        <main class="card" aria-labelledby="titulo-login">

            <div class="logo-container">
                <img src="/assets/Imagens/logo.png" alt="logo do site" id="logo">
            </div>

            <h1 id="titulo-login" class="title">Login</h1>

            <!-- FORM envia para o próprio login.php -->
            <form id="loginForm" class="form" action="login.php" method="POST">

                 <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="seu@email.com" required/>
                 </div>

                  <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Sua senha" required/>
                  </div>

                  <div class="forgot-password">
                    <a href="#" class="link-termos">Esqueceu a senha?</a>
                  </div>

                  <button type="submit" class="btn btn-submit">ENTRAR</button>
             </form>

             <div class="card-footer">
                <p class="have-account">Não tem conta? >
                    <a href="cadastro.php" class="link-entrar">Crie sua conta</a>
                </p>
             </div>

        </main>

     </div>
</body>
</html>