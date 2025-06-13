<?php
// dashboard.php
require_once 'includes/funcoes.php';
protegerPagina();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Meus Filmes</title>
    <link href="css/estilo.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Bem-vindo ao Gerenciador de Filmes!</h2>
    <p>Escolha uma das opções abaixo:</p>

    <div class="mb-3">
        <a href="novo_item.php" class="btn btn-success">Cadastrar Novo Filme</a>
        <a href="itens.php" class="btn btn-primary">Ver Meus Filmes</a>
        <a href="logout.php" class="btn btn-danger">Sair</a>
    </div>
</body>
</html>
