<?php
// /includes/conexao.php

$host = 'localhost';
$db = 'projeto_php';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('Erro na conexão: ' . $mysqli->connect_error);
}
?>
