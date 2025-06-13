<?php
// /includes/funcoes.php

function campoVazio($campo) {
    return trim($campo) === '';
}

function exibirMensagem($tipo, $mensagem) {
    if ($tipo === 'erro') {
        echo "<div class='alert alert-danger'>$mensagem</div>";
    } else {
        echo "<div class='alert alert-success'>$mensagem</div>";
    }
}

function protegerPagina() {
    session_start();
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php');
        exit();
    }
}
?>
