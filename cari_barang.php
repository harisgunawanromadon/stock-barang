<?php
$kataKunci = trim($_GET['kata_kunci'] ?? '');
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Demo GET</title>
</head>

<body>
  <h1>Pencarian Barang (Demo GET)</h1>

  <form action="cari_barang.php" method="get">
    <label for="kata_kunci">Kata kunci</label>
    <input id="kata_kunci" name="kata_kunci" type="text" required>
    <button type="submit">Cari</button>
  </form>

  <?php if ($kataKunci !== ''): ?>
    <p>Kata kunci pencarian: <?= htmlspecialchars($kataKunci, ENT_QUOTES, 'UTF-8') ?></p>
  <?php endif; ?>
</body>

</html>