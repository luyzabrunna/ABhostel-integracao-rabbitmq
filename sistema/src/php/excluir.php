<?php
require_once "../php/bd.php";
session_start();

// VERIFICA LOGIN
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$conn = bd::getConexao();

$id = $_GET['id'];

// Busca imóvel
$sql_select = $conn->prepare("SELECT * FROM imoveis WHERE id = :id");
$sql_select->bindValue(":id", $id);
$sql_select->execute();

$imovel = $sql_select->fetch(PDO::FETCH_OBJ);

if(!$imovel){
    die("Imovel não encontrado");
}

// Delete fotos
if (!empty($imovel->fotos)){
    $lista = json_decode($imovel->fotos, true);

    foreach ($lista as $foto) {
        $arquivo = "../uploads/" . $foto;
        if (file_exists($arquivo)) {
            unlink($arquivo);
        }
    }
}

// Deleta registro do BD
$sql = $conn->prepare("DELETE FROM imoveis WHERE id = :id");
$sql->bindValue(":id", $id);
$sql->execute();

header("Location: /php/listar_imoveis_admin.php");