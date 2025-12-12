<?php
session_start();

// Proteção do painel (somente logado)
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - ABhostel</title>

    <link rel="stylesheet" href="/assets/css/painel.css">
</head>
<body>

    <!-- MENU LATERAL -->
    <div class="sidebar">
        <div class="logo-area">
            <img src="/assets/Imagens/logo.png" alt="Logo ABhostel" class="logo-sidebar">
        </div>

        <a href="painel.php">Painel</a>
        <a href="listar_imoveis_admin.php">Imóveis</a>
        <a href="cadastro_imovel.php">Cadastrar Imóvel</a>
        <a href="logout.php">Sair</a>
    </div>

    <div class="main">
        <div class="title">Bem-vindo ao Painel Administrativo</div>

        <div class="cards">
            <div class="card">
                <h3>Total de Imóveis</h3>
                <p>Acompanhe todos os seus cadastros.</p>
                <a href="listar_imoveis_admin.php" class="btn-marrom">Ver imóveis</a>
            </div>

            <div class="card">
                <h3>Cadastrar Imóvel</h3>
                <p>Adicione novos imóveis ao catálogo.</p>
                <a href="cadastro_imovel.php" class="btn-marrom">Cadastrar</a>
            </div>

            <div class="card">
                <h3>Configurações</h3>
                <p>Gerencie detalhes do sistema.</p>
                <a href="#" class="btn-marrom">Abrir</a>
            </div>
        </div>
    </div>

</body>
</html>