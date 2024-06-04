<?php
include 'config.php'; // Pastikan file config.php berisi informasi koneksi database

// Mengecek apakah terdapat request POST untuk menambahkan data rekam medis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $id_kunjungan = $_POST["kunjungan_id"];
    $diagnosa = $_POST["diagnosa"];
    $perawatan = $_POST["perawatan"];
    $resep = $_POST["resep"];
    $catatan = $_POST["catatan"];

    // Menggunakan prepared statement untuk menambahkan data rekam medis
    $sql = "INSERT INTO rekammedis (id, kunjungan_id, diagnosa, perawatan, resep, catatan) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissss", $id, $id_kunjungan, $diagnosa, $perawatan, $resep, $catatan);

    if ($stmt->execute()) {
        echo "Rekam medis berhasil ditambahkan";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Query untuk mengambil data rekam medis
$sql = "SELECT id, kunjungan_id, diagnosa, perawatan, resep, catatan FROM medical_records";
$result = $conn->query($sql);

// Periksa apakah query berhasil dijalankan
if ($result === false) {
    die("Error: " . $conn->error);
}
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
<a href="tambah_rekammedis.php" class="btn"><i class="fas fa-plus"></i>Tambah Rekam</a>
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
                    echo "<td>" . $row["kunjungan_id"] . "</td>";
                    echo "<td>" . $row["diagnosa"] . "</td>"; 
                    echo "<td>" . $row["perawatan"] . "</td>";
                    echo "<td>" . $row["resep"] . "</td>";
                    echo "<td>" . $row["catatan"] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_rekammedis.php?id=" . $row["id"] . "' class='btn btn-edit'>Edit</a> ";
                    echo "<a href='hapus_rekammedis.php?id=" . $row["id"] . "' class='btn btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pasien ini?\")'>Hapus</a>";
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
