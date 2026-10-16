<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Input Barang</title>
</head>

<body>
  <main>
    <h1>Form Input Barang</h1>
    <p>Masukkan data barang yang akan diterima oleh toko.</p>

    <form action="proses_barang.php" method="post">
      <label for="nama_barang">Nama barang</label>
      <input type="text" id="nama_barang" name="nama_barang"
        maxlength="100" required>

      <label for="kategori">Kategori</label>
      <select id="kategori" name="kategori" required>
        <option value="">-- Pilih kategori --</option>
        <option value="Elektronik">Elektronik</option>
        <option value="ATK">ATK</option>
        <option value="Perlengkapan">Perlengkapan</option>
      </select>

      <label for="jumlah">Jumlah stok</label>
      <input type="number" id="jumlah" name="jumlah"
        min="1" step="1" required>

      <label for="harga">Harga satuan (rupiah)</label>
      <input type="number" id="harga" name="harga"
        min="0" step="1" required>

      <button type="submit">Simpan Data</button>
    </form>
  </main>
</body>

</html>