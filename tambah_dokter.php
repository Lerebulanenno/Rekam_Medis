<!-- menampilkan form manambah data dokter -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Dokter</title>
</head>
<body>
    <div class="container">
        <h2>Tambah Data Dokter</h2>
        <form action="tambah_dokter.php" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="spesialisasi">Spesialisasi:</label>
            <input type="text" id="spesialisasi" name="spesialisasi" required>

            <label for="telepon">Telepon:</label>
            <input type="tel" id="telepon" name="telepon" required>

            <input type="submit" value="Tambah Data Dokter">
        </form>
    </div>
</body>
</html>