<?php
require 'conexao.php';
$id = $_GET['id'] ?? 0;
$pdo->prepare("DELETE FROM animes WHERE id = ?")->execute([$id]);
header('Location: anime_list.php');
exit;
