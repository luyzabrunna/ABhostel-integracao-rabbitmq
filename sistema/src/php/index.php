<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ABhostel - Página Inicial</title>

  <!-- Fontes -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Nunito&display=swap" rel="stylesheet" />

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />

  <!-- Ícones -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  
  <?php

  include "php/header.php";
  
  ?>

  <!-- BANNER PRINCIPAL -->
  <div class="banner">
    <img src="assets/Imagens/banner.jpeg" alt="Banner principal">

    <div class="banner-primario">
      <h1>Encontre o lugar perfeito</h1>
      <p>Viaje do seu jeito: curto, médio ou longo prazo</p>

      <form class="busca" action="php/listar_imoveis.php" method="post">
        <div>
          <label>Localização</label>
          <input type="text" placeholder="Onde você está indo?">
        </div>

        <div>
          <label>Data Inicial</label>
          <input type="date"  placeholder="Adicione a data">
        </div>

        <div>
          <label>Data Final</label>
          <input type="date" placeholder="Adicione a data">
        </div>

        <div>
          <label>Quem</label>
          <input type="text" placeholder="Adicionar hóspedes">
        </div>

        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
    </div>
  </div>

  <!-- IMÓVEIS -->
  <section class="imoveis">
    <h2>Imóveis em destaque</h2>
    <div class="imoveis-grid">

      <div class="imovel-card">
        <button class="favorito"><i class="fas fa-heart"></i></button>
        <img src="./assets/Imagens/casa1.jpeg" alt="Casa na cidade">
        <div class="info">
          <h3>Casa na Cidade</h3>
          <p>Palmas - TO</p>
          <p class="price">R$1.500/mês</p>
        </div>
      </div>

      <div class="imovel-card">
         <button class="favorito"><i class="fas fa-heart"></i></button>
        <img src="./assets/Imagens/ap1.jpeg" alt="Apartamento no centro">
        <div class="info">
          <h3>Apartamento no Centro</h3>
          <p>Palmas - TO</p>
          <p class="price">R$2.000/mês</p>
        </div>
      </div>

      <div class="imovel-card">
         <button class="favorito"><i class="fas fa-heart"></i></button>
        <img src="./assets/Imagens/kitnet1.jpeg" alt="Kitnet">
        <div class="info">
          <h3>Kitnet</h3>
          <p>Araguaína - TO</p>
          <p class="price">R$700/mês</p>
        </div>
      </div>

      <div class="imovel-card">
         <button class="favorito"><i class="fas fa-heart"></i></button>
        <img src="./assets/Imagens/suíte1.jpeg" alt="Suíte Clean">
        <div class="info">
          <h3>Suíte Clean</h3>
          <p>Sorriso - MT</p>
          <p class="price">R$150/noite</p>
        </div>
      </div>

      <div class="imovel-card">
         <button class="favorito"><i class="fas fa-heart"></i></button>
        <img src="./assets/Imagens/hotel1.jpeg" alt="Hotel Go">
        <div class="info">
          <h3>Hotel Go</h3>
          <p>Goiânia - GO</p>
          <p class="price">R$150/noite</p>
        </div>
      </div>

      <div class="imovel-card">
        <button class="favorito"><i class="fas fa-heart"></i></button>
        <img src="./assets/Imagens/pousada1.jpeg" alt="Pousada dos Monte">
        <div class="info">
          <h3>Pousada dos Monte</h3>
          <p>Juiz de Fora - MG</p>
          <p class="price">R$250/noite</p>
        </div>
      </div>

      <div class="imovel-card">
        <button class="favorito"><i class="fas fa-heart"></i></button>
        <img src="./assets/Imagens/chalé1.jpeg" alt="Chalé de madeira">
        <div class="info">
          <h3>Chalé de Madeira</h3>
          <p>Miracema - TO</p>
          <p class="price">R$190/noite</p>
        </div>
      </div>

      <div class="imovel-card">
        <button class="favorito"><i class="fas fa-heart"></i></button>
        <img src="./assets/Imagens/casa2.jpeg" alt="Casa colinas">
        <div class="info">
          <h3>Casa Colinas</h3>
          <p>Colinas do Tocantins - TO</p>
          <p class="price">R$1.000/mês</p>
        </div>
      </div>

    </div>
  </section>

  <!-- SEGUNDO BANNER -->
  <section class="banner-segundo">
    <img src="./assets/Imagens/banner2.jpeg" alt="Sala aconchegante" class="banner-img">

    <div class="banner-secundario">
      <div class="texto-esquerda">
        <h2>Conectando viajantes em destinos além do óbvio</h2>
      </div>

      <div class="texto-direita">
        <p>No ABhostel, você encontra pousadas, casas de campo e chalés em regiões menos urbanizadas, com opções de estadia flexíveis.</p>
        <a href="#imoveis" class="btn-banner">Conheça nossos imóveis</a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="footer-footer">
      <div class="footer-logo">
        <img src="./assets/Imagens/logo.png" alt="Logo ABhostel" class="footer-logo-img">
        <p>Hospedagem simples, acessível e acolhedora.</p>
      </div>

      <div class="footer-links">
        <h4>Menu</h4>
        <ul>
          <li><a href="/index.php">Início</a></li>
          <li><a href="/pages/listar_imoveis.php">Imóveis</a></li>
          <li><a href="#">Experiências</a></li>
          <li><a href="/pages/sobre.php">Sobre</a></li>
          <li><a href="/pages/contato.php">Contato</a></li>
        </ul>
      </div>

      <div class="footer-social">
        <h4>Siga-nos</h4>
        <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a><br>
        <a href="#"><i class="fab fa-instagram"></i> Instagram</a><br>
        <a href="#"><i class="fab fa-twitter"></i> Twitter</a><br>
        <a href="#"><i class="fab fa-youtube"></i> YouTube</a><br>
        <a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a><br>
      </div>

      <div class="footer-newsletter">
        <h4>Receba novidades</h4>
        <form>
          <input type="email" placeholder="Digite seu e-mail">
          <button type="submit">Inscrever</button>
        </form>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2025 ABhostel - Todos os direitos reservados.</p>
    </div>
  </footer>

  <script src="/assets/js/menu.js"></script>
</body>
</html>