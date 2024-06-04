<?php
include 'config.php';

$sql = "SELECT id, nama, `tanggal_lahir`, `jenis_kelamin`, alamat, telepon FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien</title>
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
    <h2>Data Pasien</h2>
    <a href="tambah_pasien.php" class="btn"><i class="fas fa-plus"></i>Tambah Data Pasien</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
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
