<?php
require 'conexao.php';

$id = $_GET['id'] ?? null;
$editando = false;
$anime = ['imagem' => '', 'nome' => '', 'generos' => '', 'nota' => ''];

if ($id) {
  $stmt = $pdo->prepare("SELECT * FROM animes WHERE id = ?");
  $stmt->execute([$id]);
  $anime = $stmt->fetch();
  if ($anime) $editando = true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title><?= $editando ? 'Editar' : 'Novo' ?> Anime</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <style>
    /* mini ajuste para o form */
    .form-box {
      max-width: 600px;
      margin: 40px auto;
      background: #111;
      padding: 30px;
      border-radius: 10px;
      color: #fff
    }

    label {
      display: block;
      margin-bottom: 10px
    }

    input,
    textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #555;
      border-radius: 4px;
      margin-top: 4px
    }

    .btn {
      background: #ff9f00;
      border: none;
      padding: 10px 20px;
      margin-top: 20px;
      cursor: pointer
    }
  </style>
</head>

<body>
  <div class="form-box">
    <h2><?= $editando ? 'Editar' : 'Cadastrar' ?> Anime</h2>
    <form action="anime_save.php" method="post">
      <input type="hidden" name="id" value="<?= $anime['id'] ?? '' ?>">

      <label>Arquivo da imagem (ex: naruto.jpeg)
        <input type="text" name="imagem" required value="<?= htmlspecialchars($anime['imagem']) ?>">
      </label>

      <label>Nome
        <input type="text" name="nome" required value="<?= htmlspecialchars($anime['nome']) ?>">
      </label>

      <label>Gêneros (separados por vírgula)
        <input type="text" name="generos" required value="<?= htmlspecialchars($anime['generos']) ?>">
      </label>

      <label>Nota (0-10, ex: 8.7)
        <input type="number" step="0.1" name="nota" min="0" max="10" required value="<?= htmlspecialchars($anime['nota']) ?>">
      </label>

      <button type="submit" class="btn"><?= $editando ? 'Atualizar' : 'Salvar' ?></button>
      <a href="anime_list.php" class="btn" style="background:#555">Cancelar</a>
    </form>
  </div>
</body>

</html>