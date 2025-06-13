<?php
// index.php
session_start();
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $senha = $_POST['senha'];

    if (campoVazio($login) || campoVazio($senha)) {
        $erro = 'Preencha todos os campos.';
    } else {
        $stmt = $mysqli->prepare("SELECT id, senha FROM usuarios WHERE login = ?");
        $stmt->bind_param('s', $login);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $hash);
            $stmt->fetch();

            if (password_verify($senha, $hash)) {
                $_SESSION['usuario_id'] = $id;
                header('Location: dashboard.php');
                exit();
            } else {
                $erro = 'Senha incorreta, tente novamente.';
            }
        } else {
            $erro = 'Usuário não encontrado, tente novamente.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="css/estilo.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Login</h2>
    <?php if ($erro) exibirMensagem('erro', $erro); ?>

    <form method="POST">
        <div class="mb-3">
            <label>Login</label>
            <input type="text" name="login" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
        <a href="cadastro.php" class="btn btn-link">Criar conta</a>
    </form>
</body>
</html>
