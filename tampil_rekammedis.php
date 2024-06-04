<?php
include 'config.php'; // Pastikan file config.php berisi informasi koneksi database

// Mengecek apakah terdapat request POST untuk menambahkan data rekam medis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_rekammedis = $_POST["id_rekammedis"];
    $id_kunjungan = $_POST["id_kunjungan"];
    $diagnosa = $_POST["diagnosa"];
    $perawatan = $_POST["perawatan"];
    $resep = $_POST["resep"];
    $catatan = $_POST["catatan"];

    // Menggunakan prepared statement untuk menambahkan data rekam medis
    $sql = "INSERT INTO rekammedis (id_rekammedis, id_kunjungan, diagnosa, perawatan, resep, catatan) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissss", $id_rekammedis, $id_kunjungan, $diagnosa, $perawatan, $resep, $catatan);

    if ($stmt->execute()) {
        echo "Rekam medis berhasil ditambahkan";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Menampilkan formulir tambah rekam medis dalam bentuk tabel samping
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Rekam Medis</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Tambah Rekam Medis</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <table>
        <tr>
            <td>ID Rekam Medis:</td>
            <td><input type="number" name="id_rekammedis" required></td>
        </tr>
        <tr>
            <td>ID Kunjungan:</td>
            <td><input type="number" name="id_kunjungan" required></td>
        </tr>
        <tr>
            <td>Diagnosa:</td>
            <td><textarea name="diagnosa" required></textarea></td>
        </tr>
        <tr>
            <td>Perawatan:</td>
            <td><textarea name="perawatan" required></textarea></td>
        </tr>
        <tr>
            <td>Resep:</td>
            <td><textarea name="resep" required></textarea></td>
        </tr>
        <tr>
            <td>Catatan:</td>
            <td><textarea name="catatan" required></textarea></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;"><input type="submit" value="Submit"></td>
        </tr>
    </table>
</form>

</body>
</html>
