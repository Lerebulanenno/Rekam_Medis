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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            border-radius: 3px;
        }
        .btn-edit {
            background-color: #FFC107;
        }
        .btn-delete {
            background-color: #DC3545;
        }
    </style>
</head>
<body>

<h2>Tambah Rekam Medis</h2>
<a href="tambah_pasien.php" class="btn"><i class="fas fa-plus"></i>Tambah Data Pasien</a>
    <table>
        <thead>
            <tr>
                <th>Id Rekam Medis</th>
                <th>Id Kunjungan</th>
                <th>Diagnosa</th>
                <th>Perawatan</th>
                <th>Resep</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nama"] . "</td>";
                    echo "<td>" . $row["tanggal_lahir"] . "</td>"; // Kolom ini harus diubah menjadi 'tanggal_lahir'
                    echo "<td>" . $row["jenis_kelamin"] . "</td>";
                    echo "<td>" . $row["alamat"] . "</td>";
                    echo "<td>" . $row["telepon"] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_pasien.php?id=" . $row["id_pasien"] . "' class='btn btn-edit'>Edit</a> ";
                    echo "<a href='hapus_pasien.php?id=" . $row["id_pasien"] . "' class='btn btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pasien ini?\")'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php $conn->close(); ?>
</body>
</html>
