<?php
require_once "bd.php";

$conn = bd::getConexao();

$email = "abhostel@gmail.com";
$senha = password_hash("123456", PASSWORD_DEFAULT);

$sql = $conn->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
$sql->bindValue(":email", $email);
$sql->bindValue(":senha", $senha);
$sql->execute();

echo "Usuário admin criado com sucesso!";