<?php
require_once "../php/bd.php";

$conn = bd::getConexao();

// RECEBE OS FILTROS DA BUSCA DO BANNER
$localizacao = $_GET['localizacao'] ?? "";
$data_inicial = $_GET['data_inicial'] ?? "";
$data_final = $_GET['data_final'] ?? "";
$hospedes = $_GET['hospedes'] ?? "";

// QUERY BASE
$sql = "SELECT * FROM imoveis WHERE 1=1";

// FILTRA POR CIDADE (localização)
if (!empty($localizacao)) {
    $sql .= " AND cidade LIKE :localizacao";
}

// FILTRA POR CAPACIDADE (hóspedes)
if (!empty($hospedes)) {
    $sql .= " AND capacidade >= :hospedes";
}

$stmt = $conn->prepare($sql);

// BIND DOS FILTROS
if (!empty($localizacao)) {
    $stmt->bindValue(":localizacao", "%$localizacao%");
}
if (!empty($hospedes)) {
    $stmt->bindValue(":hospedes", $hospedes);
}

$stmt->execute();
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Imoveis - ABhostel</title>

    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Nunito&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/listar_imoveis.css">

    <!-- Ícones -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

  <?php

  include "header.php";
  
  ?>

  <!-- Conteúdo da página -->
  <div class="container">
      
      <div class="lista-imoveis">

          <!-- ============================
                COLUNA ESQUERDA (IMÓVEIS)
          ============================== -->
          <div class="coluna-esquerda">
              <p><?php echo count($imoveis); ?> opções encontradas</p>
              <h1>Lista de Imóveis</h1>

              <?php if (count($imoveis) == 0): ?>
                  <p ">Nenhum imóvel encontrado </p>
              <?php endif; ?>

              <?php foreach ($imoveis as $imovel): ?>
              <div class="imovel">
                  
                  <div class="imovel-img">
                      <img src="../uploads/<?php echo $imovel['fotos']; ?>" alt="">
                  </div>

                  <div class="imovel-info">

                      <p><?php echo $imovel['descricao']; ?></p>

                      <h3><?php echo $imovel['titulo']; ?></h3>

                      <p>
                        <?php echo $imovel['quartos']; ?> quartos / 
                        <?php echo $imovel['banheiros']; ?> banheiros /
                        wifi
                      </p>

                      <!-- Estrelas fixas só para estética -->
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star-half-stroke"></i>
                      <i class="fa-regular fa-star"></i>

                      <div class="imovel-valor">
                          <p><?php echo $imovel['capacidade']; ?> Hóspedes</p>
                          <h4>
                              R$ <?= number_format($imovel['valor'], 2, ',', '.'); ?>
                              <span>/ <?= $imovel['tipo_preco']; ?> mês</span>
                          </h4>
                      </div>
                  </div>
              </div>
              <?php endforeach; ?>
          </div>

          <!-- COLUNA DIREITA -->
          <div class="coluna-direita">
              <div class="barra-lateral">
                  <h2>Filtro de Busca</h2>

                  <!-- (FILTROS DECORATIVOS - NÃO FUNCIONAIS AINDA) -->

                  <h3>Tipo de Imóvel</h3>
                  <form action="" method="post">

                    <div class="filtro"><input type="checkbox"> <p>Casa</p></div>
                    <div class="filtro"><input type="checkbox"> <p>Apartamento</p></div>
                    <div class="filtro"><input type="checkbox"> <p>Kitnet</p></div>
                    <div class="filtro"><input type="checkbox"> <p>Suíte</p></div>
                    <div class="filtro"><input type="checkbox"> <p>Hotel</p></div>
                    <div class="filtro"><input type="checkbox"> <p>Pousada</p></div>
                    <div class="filtro"><input type="checkbox"> <p>Chalé</p></div>

                    <h3>Facilidades</h3>
                    
                    <div class="filtro">
                      <input type="checkbox" name="" id=""> 
                      <p>Wi-fi</p> <span>(0)</span>
                    </div>

                    <div class="filtro">
                      <input type="checkbox" name="" id=""> 
                      <p>Ar-condicionado</p> <span>(0)</span>
                    </div>

                    <div class="filtro">
                      <input type="checkbox" name="" id=""> 
                      <p>Estacionamento</p> <span>(0)</span>
                    </div>

                    <div class="filtro">
                      <input type="checkbox" name="" id=""> 
                      <p>Pet-friendly</p> <span>(0)</span>
                    </div>

                    <div class="filtro">
                      <input type="checkbox" name="" id=""> 
                      <p>Piscina</p> <span>(0)</span>
                    </div>

                    <div class="filtro">
                      <input type="checkbox" name="" id=""> 
                      <p>Cozinha</p> <span>(0)</span>
                    </div>

                    <div class="filtro">
                      <input type="checkbox" name="" id=""> 
                      <p>TV</p> <span>(0)</span>
                    </div>

                    <div class="filtro">
                      <input type="checkbox" name="" id=""> 
                      <p>Área de trabalho</p> <span>(0)</span>
                    </div> 

                    <div class="filtro">
                      <input type="checkbox" name="" id=""> 
                      <p>Acessível</p> <span>(0)</span>
                    </div>

                    <div class="filtro">
                      <input type="checkbox" name="" id=""> 
                      <p>Café da manhã</p> <span>(0)</span>
                    </div>

                    <div class="filtro">
                      <input type="checkbox" name="" id=""> 
                      <p>Máquina de lavar</p> <span>(0)</span>
                    </div>

                    <div class="barra-lateral-link">
                        <a href="">Veja Mais</a>
                    </div>

                    <h3>Estado / Cidade</h3>
                    <div class="filtro">
                        <select name="" id="">
                            <option value="">Selecione o Estado</option>
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

                    <div class="filtro">
                        <select name="" id="">
                            <option value="">Selecione a Cidade</option>
                            <option value="">Palmas</option>
                            <option value="">São Paulo</option>
                            <option value="">Rio de Janeiro</option>
                            <option value="">Belo Horizonte</option>
                            <option value="">Salvador</option>
                            <option value="">Fortaleza</option>
                            <option value="">Curitiba</option>
                            <option value="">Florianópolis</option>
                            <option value="">Porto Alegre</option>
                            <option value="">Brasília</option>
                        </select>
                    </div>


                    <button class="cadastro-btn">Buscar</button>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <script src="/assets/js/menu.js"></script>
</body>
</html>