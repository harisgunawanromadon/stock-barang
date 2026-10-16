<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit('Metode request tidak diizinkan. Silakan kirim data melalui form.');
}

$errors = [];
$nama = trim($_POST['nama_barang'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$jumlahInput = $_POST['jumlah'] ?? '';
$hargaInput = $_POST['harga'] ?? '';

$kategoriDiizinkan = ['Elektronik', 'ATK', 'Perlengkapan'];

if ($nama === '') {
  $errors[] = 'Nama barang wajib diisi.';
} elseif (mb_strlen($nama) > 100) {
  $errors[] = 'Nama barang maksimal 100 karakter.';
}

if (!in_array($kategori, $kategoriDiizinkan, true)) {
  $errors[] = 'Kategori tidak valid. Pilih kategori dari daftar.';
}

$jumlah = filter_var($jumlahInput, FILTER_VALIDATE_INT);
if ($jumlah === false || $jumlah < 1) {
  $errors[] = 'Jumlah harus berupa bilangan bulat minimal 1.';
}

if ($hargaInput === '' || !is_numeric($hargaInput) || (float)$hargaInput < 0) {
  $errors[] = 'Harga harus berupa angka dan tidak boleh negatif.';
} else {
  $harga = (float)$hargaInput;
}


function e($value)
{
  return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Input Barang</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 32px 16px;
      font-family: Arial, sans-serif;
      background: #eef3f8;
      color: #203040;
    }

    main {
      max-width: 760px;
      margin: auto;
      padding: 28px;
      background: white;
      border-radius: 14px;
    }

    h1 {
      color: #17324d;
    }

    .error {
      background: #fff0f0;
      border-left: 4px solid #bd3434;
      padding: 14px;
    }

    .success {
      background: #edf8f0;
      border-left: 4px solid #25804b;
      padding: 14px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 18px;
    }

    th,
    td {
      border: 1px solid #d5dfe7;
      padding: 11px;
      text-align: left;
    }

    th {
      background: #eaf1f7;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      color: #24527a;
    }
  </style>
</head>

<body>
  <main>
    <h1>Hasil Pengolahan Data Barang</h1>

    <?php if ($errors): ?>
      <div class="error">
        <strong>Data belum dapat diproses:</strong>
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?= e($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php else: ?>
      <?php $subtotal = $jumlah * $harga; ?>
      <div class="success">
        <strong>Data berhasil divalidasi.</strong>
        Ringkasan berikut dibuat dari request saat ini.
      </div>
      <table>
        <tr>
          <th>Nama barang</th>
          <td><?= e($nama) ?></td>
        </tr>
        <tr>
          <th>Kategori</th>
          <td><?= e($kategori) ?></td>
        </tr>
        <tr>
          <th>Jumlah stok</th>
          <td><?= number_format($jumlah, 0, ',', '.') ?> unit</td>
        </tr>
        <tr>
          <th>Harga satuan</th>
          <td>Rp <?= number_format($harga, 0, ',', '.') ?></td>
        </tr>
        <tr>
          <th>Subtotal nilai stok</th>
          <td><strong>Rp <?= number_format($subtotal, 0, ',', '.') ?></strong></td>
        </tr>
      </table>
    <?php endif; ?>

    <a href="index.php">Kembali ke form input</a>
  </main>
</body>

</html>