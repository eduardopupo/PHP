<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
require_once 'includes/conexao.php';

$usuario_id = $_SESSION['usuario_id'];
$stmt = $mysqli->prepare("SELECT id, titulo, descricao FROM filmes WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$filmes = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Meus Filmes</title>
    <link rel="stylesheet" href="css/estilo.css" />
</head>
<body>
    <h2>Filmes Cadastrados</h2>
    <a href="novo_item.php">Cadastrar Novo Filme</a> 

    <a href="logout.php">Sair</a><br><br>

    <?php if ($filmes->num_rows > 0): ?>
        <?php while ($f = $filmes->fetch_assoc()): ?>
            <div class="item">
                <h3><?= htmlspecialchars($f['titulo']) ?></h3>
                <p><?= nl2br(htmlspecialchars($f['descricao'])) ?></p>
                <a href="editar_item.php?id=<?= $f['id'] ?>">Editar</a>
            </div>
            <hr>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nenhum filme cadastrado ainda.</p>
    <?php endif; ?>
</body>
</html>
