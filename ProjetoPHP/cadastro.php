<?php
// cadastro.php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';

$mensagem = '';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $senha = $_POST['senha'];
    $email = trim($_POST['email']);

    if (campoVazio($login) || campoVazio($senha) || campoVazio($email)) {
        $erro = 'Preencha todos os campos obrigatórios.';
    } else {
        // Verifica se login ou email já existem
        $stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE login = ? OR email = ?");
        $stmt->bind_param('ss', $login, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $erro = 'Login ou e-mail já cadastrado.';
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare("INSERT INTO usuarios (login, senha, email) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $login, $hash, $email);

            if ($stmt->execute()) {
                $mensagem = 'Usuário cadastrado com sucesso! <a href="index.php">Clique aqui para entrar</a>';
            } else {
                $erro = 'Erro ao cadastrar. Tente novamente.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link href="css/estilo.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Cadastro de Novo Usuário</h2>
    <?php
        if ($erro) exibirMensagem('erro', $erro);
        if ($mensagem) exibirMensagem('sucesso', $mensagem);
    ?>

    <form method="POST">
        <div class="mb-3">
            <label>Login</label>
            <input type="text" name="login" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
        <a href="index.php" class="btn btn-link">Voltar para o login</a>
    </form>
</body>
</html>
