 <!-- HEADER -->
  <header>
    <div class="logo">
      <a href="/index.php"><img src="../assets/Imagens/logo.png" alt="Logo ABhostel"></a>
    </div>

    <!-- MENU DESKTOP -->
    <nav class="menu-desktop">
      <ul class="menu-links">
        <li><a href="../index.php" class="active">Início</a></li>
        <li><a href="/php/listar_imoveis.php">Imóveis</a></li>
        <li><a href="">Anuncie seu imóvel</a></li>
      </ul>
      <a href="/php/login.php" class="btn-login">Entrar / Cadastre-se</a> 
    </nav>

     <!-- ÍCONE MENU MOBILE -->
    <button class="btn open" aria-label="Abrir menu"><i class="fas fa-bars"></i></button>
  </header>

  <!-- OVERLAY E MENU MOBILE -->
  <div class="menu-overlay" aria-hidden="true"></div>
  <div class="mobile-menu" aria-hidden="true">
    <div class="mobile-links">
      <a href="/index.php">Início</a>
      <hr class="divider">
      <a href="/php/listar_imoveis.php">Imóveis</a>
      <a href="">Anuncie seu imóvel</a>
      <hr class="divider">
      <a href="/sobre.php">Sobre</a>
      <a href="/contato.php">Contato</a>
      <hr class="divider">
      <a href="/php/login.php" class="login-mobile">Entrar / Cadastre-se</a>
    </div>

    <div class="mobile-social">
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
    </div>
  </div>