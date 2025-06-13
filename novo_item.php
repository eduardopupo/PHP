<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
require_once 'includes/conexao.php';

$msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);

    if ($titulo !== '' && $descricao !== '') {
        $usuario_id = $_SESSION['usuario_id'];

        $stmt = $mysqli->prepare("INSERT INTO filmes (usuario_id, titulo, descricao) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("iss", $usuario_id, $titulo, $descricao);
            if ($stmt->execute()) {
                header("Location: itens.php");
                exit;
            } else {
                $msg = "Erro ao cadastrar filme.";
            }
            $stmt->close();
        } else {
            $msg = "Erro na preparação da consulta.";
        }
    } else {
        $msg = "Preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Filme</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Cadastrar Novo Filme</h2>

    <?php if ($msg): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="dashboard.php" class="btn btn-link">Cancelar</a>
    </form>
</body>
</html>
