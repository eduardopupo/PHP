<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
require_once 'includes/conexao.php';

$msg = '';
$id = $_GET['id'] ?? null;
$usuario_id = $_SESSION['usuario_id'];

if (!$id) {
    header("Location: itens.php");
    exit;
}

// Buscar o filme
$stmt = $mysqli->prepare("SELECT * FROM filmes WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $id, $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$filme = $result->fetch_assoc();

if (!$filme) {
    die("Filme não encontrado ou acesso não autorizado.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);

    if ($titulo && $descricao) {
        $update = $mysqli->prepare("UPDATE filmes SET titulo = ?, descricao = ? WHERE id = ? AND usuario_id = ?");
        $update->bind_param("ssii", $titulo, $descricao, $id, $usuario_id);
        if ($update->execute()) {
            header("Location: itens.php");
            exit;
        } else {
            $msg = "Erro ao atualizar filme.";
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
    <title>Editar Filme</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h2>Editar Filme</h2>
    <?php if ($msg): ?>
        <p style="color:red;"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?= htmlspecialchars($filme['titulo']) ?>" required><br>
        <label>Descrição:</label><br>
        <textarea name="descricao" required><?= htmlspecialchars($filme['descricao']) ?></textarea><br>
        <input type="submit" value="Atualizar">
        <a href="itens.php">Cancelar</a>
    </form>
</body>
</html>
