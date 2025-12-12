<?php
require_once "../php/bd.php";
session_start();

// VERIFICA LOGIN
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$conn = bd::getConexao();
$mensagem = "";

// QUANDO O FORM É ENVIADO
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Dados básicos
    $tipo = $_POST['propertyType'];
    $titulo = $_POST['title'];
    $descricao = $_POST['description'];

    // Localização
    $cidade = $_POST['cidade'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $estado = $_POST['estado'];

    // Estrutura
    $quartos = $_POST['quartos'];
    $suites = $_POST['suites'];
    $banheiros = $_POST['banheiros'];
    $capacidade = $_POST['capacidade'];

    // Facilidades (checkboxes)
    $wifi = isset($_POST['wifi']) ? 1 : 0;
    $ar_condicionado = isset($_POST['ar-condicionado']) ? 1 : 0;
    $estacionamento = isset($_POST['estacionamento']) ? 1 : 0;
    $pet_friendly = isset($_POST['pet_friendly']) ? 1 : 0;
    $piscina = isset($_POST['piscina']) ? 1 : 0;
    $cozinha = isset($_POST['cozinha']) ? 1 : 0;
    $tv = isset($_POST['tv']) ? 1 : 0;
    $area_trabalho = isset($_POST['area_trabalho']) ? 1 : 0;
    $cafe_manha = isset($_POST['cafe']) ? 1 : 0;
    $maquina_lavar = isset($_POST['maquina']) ? 1 : 0;

    // Preço e período
    $valor = $_POST['valor'];
    $tipo_preco = $_POST['tipo_preço'];
    $data_inicio = $_POST['data_inicio'];
    $data_termino = $_POST['data_termino'];

    // Contato
    $whatsapp = $_POST['whatsapp'];
    $email_prop = $_POST['email_proprietario'];

    // UPLOAD DAS FOTOS
    $listaFotos = [];

    if (!empty($_FILES['fotos']['name'][0])) {

    // Caminho físico da pasta uploads
    $pastaDestino = __DIR__ . "/../uploads/";

    foreach ($_FILES['fotos']['name'] as $i => $nomeFoto) {
        $tmp = $_FILES['fotos']['tmp_name'][$i];

        // Nome único pra evitar conflito
        $novoNome = uniqid() . "_" . basename($nomeFoto);

        // Move o arquivo
        if (move_uploaded_file($tmp, $pastaDestino . $novoNome)) {
            $listaFotos[] = $novoNome;
        } else {
            echo "Erro ao enviar a foto: $nomeFoto<br>";
        }
    }
}

// Transforma numa string JSON
$fotosJSON = json_encode($listaFotos);

    // INSERE NO BANCO
    $sql = $conn->prepare("
        INSERT INTO imoveis (
            tipo, titulo, descricao, cidade, logradouro, numero, complemento, bairro, estado,
            quartos, suites, banheiros, capacidade,
            wifi, piscina, estacionamento, ar_condicionado, tv, pet_friendly, cozinha, area_trabalho,
            cafe_manha, maquina_lavar,
            valor, tipo_preco, data_inicio, data_termino,
            whatsapp, email_proprietario, fotos
        )
        VALUES (
            :tipo, :titulo, :descricao, :cidade, :logradouro, :numero, :complemento, :bairro, :estado,
            :quartos, :suites, :banheiros, :capacidade,
            :wifi, :piscina, :estacionamento, :ar_condicionado, :tv, :pet_friendly, :cozinha, :area_trabalho,
            :cafe_manha, :maquina_lavar,
            :valor, :tipo_preco, :data_inicio, :data_termino,
            :whatsapp, :email_prop, :fotos
        )
    ");

    $sql->execute([
        ':tipo' => $tipo,
        ':titulo' => $titulo,
        ':descricao' => $descricao,
        ':cidade' => $cidade,
        ':logradouro' => $logradouro,
        ':numero' => $numero,
        ':complemento' => $complemento,
        ':bairro' => $bairro,
        ':estado' => $estado,
        ':quartos' => $quartos,
        ':suites' => $suites,
        ':banheiros' => $banheiros,
        ':capacidade' => $capacidade,
        ':wifi' => $wifi,
        ':piscina' => $piscina,
        ':estacionamento' => $estacionamento,
        ':ar_condicionado' => $ar_condicionado,
        ':tv' => $tv,
        ':pet_friendly' => $pet_friendly,
        ':cozinha' => $cozinha,
        ':area_trabalho' => $area_trabalho,
        ':cafe_manha' => $cafe_manha,
        ':maquina_lavar' => $maquina_lavar,
        ':valor' => $valor,
        ':tipo_preco' => $tipo_preco,
        ':data_inicio' => $data_inicio,
        ':data_termino' => $data_termino,
        ':whatsapp' => $whatsapp,
        ':email_prop' => $email_prop,
        ':fotos' => $fotosJSON
    ]);

    $mensagem = "Imóvel cadastrado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABhostel - Cadastrar Imóvel</title>
    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Nunito&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/cadastro_imovel.css">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>

<header>
    <div class="logo">
        <a href="/index.php"><img src="../assets/imagens/logo.png" alt="Logo ABhostel"></a>
    </div>

    <nav class="menu-desktop">
        <ul class="menu-links">
            <li><a href="/index.php">Início</a></li>
            <li><a href="listar_imoveis_admin.php">Imóveis</a></li>
            <li><a href="#" class="active">Anuncie seu imóvel</a></li>
        </ul>
        <a href="painel.php" class="btn-login">Voltar ao painel</a>
    </nav>

     <!-- ÍCONE MENU MOBILE -->
    <button class="btn open" aria-label="Abrir menu"><i class="fas fa-bars"></i></button>

</header>

 <!-- OVERLAY E MENU MOBILE -->
  <div class="menu-overlay" aria-hidden="true"></div>
  <div class="mobile-menu" aria-hidden="true">
    <div class="mobile-links">
      <a href="index.php"> Início</a>
      <hr class="divider">
      <a href="/php/listar_imoveis.php">Imóveis</a>
      <a href="/php/anunciar.php">Anuncie seu imóvel</a>
      <hr class="divider">
      <a href="/php/sobre.php">Sobre</a>
      <a href="/php/contato.php">Contato</a>
      <hr class="divider">
      <a href="painel.php" class="login-mobile">Voltar ao painel</a>
    </div>

    <div class="mobile-social">
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
    </div>
  </div>

<br><br>

<div class="page-wrapper">
<main class="card">

    <h1>Anuncie seu Imóvel</h1>

    <?php if ($mensagem): ?>
        <p class="msg-sucesso">
            <?= $mensagem ?>
        </p>
    <?php endif; ?>

    <!-- FORMULÁRIO -->
    <form method="POST" enctype="multipart/form-data">

        <h2 class="section-title">Informações básicas do imóvel</h2>

        <div class="form-group">
            <label for="propertyType">Tipo de imóvel</label>
            <select name="propertyType" id="propertyType" required>
                <option value="">Selecione</option>
                <option value="Casa">Casa</option>
                <option value="Apartamento">Apartamento</option>
                <option value="Kitnet">Kitnet</option>
                <option value="Suíte">Suíte</option>
                <option value="Hotel">Hotel</option>
                <option value="Pousada">Pousada</option>
                <option value="Chalé">Chalé</option>
            </select>
        </div>

        <div class="form-group">
            <label for="title">Título do anúncio</label>
            <input type="text" id="title" name="title" maxlength="150" required>
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea id="description" name="description" maxlength="500" rows="4" required></textarea>
        </div>

        <h2 class="section-title">Localização do imóvel</h2>

        <div class="form-group">
            <label>Cidade</label>
            <input type="text" name="cidade" required>
        </div>

        <div class="form-group">
            <label>Logradouro (rua/avenida)</label>
            <input type="text" name="logradouro" required>
        </div>

        <div class="form-group">
            <label>Número</label>
            <input type="text" name="numero" required>
        </div>

        <div class="form-group">
            <label>Complemento (opcional)</label>
            <input type="text" name="complemento">
        </div>

        <div class="form-group">
            <label>Bairro</label>
            <input type="text" name="bairro" required>
        </div>

        <div class="form-group">
            <label>Estado</label>
            <select name="estado" required>
                <option value="">Selecione</option>
                <option value="Acre (AC)">Acre (AC)</option>
                    <option value="Alagoas (AL)">Alagoas (AL)</option>
                    <option value="Amapá (AP)">Amapá (AP)</option>
                    <option value="Amazonas (AM)">Amazonas (AM)</option>
                    <option value="Bahia (BA)">Bahia (BA)</option>
                    <option value="Ceará (CE)">Ceará (CE)</option>
                    <option value="Espírito Santo (ES)">Espírito Santo (ES)</option>
                    <option value="Goiás (GO)">Goiás (GO)</option>
                    <option value="Maranhão (MA)">Maranhão (MA)</option>
                    <option value="Mato Grosso (MT)">Mato Grosso (MT)</option>
                    <option value="Mato Grosso do Sul (MS)">Mato Grosso do Sul (MS)</option>
                    <option value="Minas Gerais (MG)">Minas Gerais (MG)</option>
                    <option value="Pará (PA)">Pará (PA)</option>
                    <option value="Paraíba (PB)">Paraíba (PB)</option>
                    <option value="Paraná (PR)">Paraná (PR)</option>
                    <option value="Pernambuco (PE)">Pernambuco (PE)</option>
                    <option value="Piauí (PI)">Piauí (PI)</option>
                    <option value="Rio de Janeiro (RJ)">Rio de Janeiro (RJ)</option>
                    <option value="Rio Grande do Norte (RN)">Rio Grande do Norte (RN)</option>
                    <option value="Rio Grande do Sul (RS)">Rio Grande do Sul (RS)</option>
                    <option value="Rondônia (RO)">Rondônia (RO)</option>
                    <option value="Roraima (RR)">Roraima (RR)</option>
                    <option value="Santa Catarina (SC)">Santa Catarina (SC)</option>
                    <option value="São Paulo (SP)">São Paulo (SP)</option>
                    <option value="Sergipe (SE)">Sergipe (SE)</option>
                    <option value="Tocantins (TO)">Tocantins (TO)</option>
                    <option value="Distrito Federal (DF)">Distrito Federal (DF)</option>
            </select>
        </div>

        <h2 class="section-title">Estrutura do imóvel</h2>

        <div class="form-group">
            <label>Quartos</label>
            <input type="number" name="quartos" min="1" required>
        </div>

        <div class="form-group">
            <label>Suítes</label>
            <input type="number" name="suites" min="0">
        </div>

        <div class="form-group">
            <label>Banheiros</label>
            <input type="number" name="banheiros" min="1" required>
        </div>

        <div class="form-group">
            <label>Capacidade</label>
            <input type="number" name="capacidade" min="1" required>
        </div>

        <h2 class="section-title">O que o imóvel oferece</h2>

        <label><input type="checkbox" name="wifi"> Wi-fi</label>
        <label><input type="checkbox" name="ar-condicionado"> Ar-condicionado</label>
        <label><input type="checkbox" name="estacionamento"> Estacionamento</label>
        <label><input type="checkbox" name="pet_friendly"> Pet-friendly</label>
        <label><input type="checkbox" name="piscina"> Piscina</label>
        <label><input type="checkbox" name="cozinha"> Cozinha</label>
        <label><input type="checkbox" name="tv"> TV</label>
        <label><input type="checkbox" name="area_trabalho"> Área de trabalho</label>
        <label><input type="checkbox" name="cafe_manha"> Café da manhã</label>
        <label><input type="checkbox" name="maquina_lavar"> Máquina de lavar</label>

        <h2 class="section-title">Preço e período</h2>

        <div class="form-group">
            <label>Valor (R$)</label>
            <input type="number" name="valor" required>
        </div>

        <div class="form-group">
            <label>Tipo de preço</label>
            <select name="tipo_preço" required>
                <option value="noite">Por noite</option>
                <option value="semana">Por semana</option>
                <option value="mes">Por mês</option>
            </select>
        </div>

        <div class="form-group">
            <label>Data de início</label>
            <input type="date" name="data_inicio" required>
        </div>

        <div class="form-group">
            <label>Data de término</label>
            <input type="date" name="data_termino" required>
        </div>

        <h2 class="section-title">Contato do proprietário</h2>

        <div class="form-group">
            <label>WhatsApp</label>
            <input type="tel" name="whatsapp" required>
        </div>

        <div class="form-group">
            <label>Email (opcional)</label>
            <input type="email" name="email_proprietario">
        </div>

        <h2 class="section-title">Fotos do imóvel</h2>

        <div class="form-group">
            <label>Adicionar fotos</label>
            <input type="file" name="fotos[]" multiple accept="image/*">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Publicar anúncio</button>
        </div>

    </form>

</main>
<script src="../assets/js/menu.js"></script>
</div>
</body>
</html>